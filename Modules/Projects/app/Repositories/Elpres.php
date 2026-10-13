<?php

namespace Modules\Projects\Repositories;

use App\Models\Gapres;
use App\Models\Projects;
use App\Models\Trasa;
use App\Models\Zatpol;
use Illuminate\Support\Facades\DB;

class Elpres
{
    public function elpres(int $projectId): int
    {
        return DB::transaction(function () use ($projectId) {

            // PROJECTS =========================================================
            $project = Projects::with([
                'voltages',
                'conductors',
                'groundWires',
                'groundWires2',
            ])->findOrFail($projectId);

            $nom_nap = (float) (optional($project->voltages)->title ?? 0);
            [$d_sig, $d_sig1] = $this->resolveSafetyDistances($nom_nap);
            //dd($d_sig, $d_sig1);

            $pro_mod = (float) (optional($project->conductors)->model ?? 0);
            $pro_tem = (float) (optional($project->conductors)->temp_exp_coeff ?? 0);
            $pro_mas = (float) (optional($project->conductors)->mass ?? 0);
            $pro_dij = (float) (optional($project->conductors)->diameter ?? 0);

            $numGroundWires = (int) ($project->num_ground_wires ?? 0);

            $zaj_mod = (float) (optional($project->groundWires)->model ?? 0);
            $zaj_tem = (float) (optional($project->groundWires)->temp_exp_coeff ?? 0);
            $zaj_mas = (float) (optional($project->groundWires)->mass ?? 0);
            $zaj_dij = (float) (optional($project->groundWires)->diameter ?? 0);

            $zaj_mod2 = (float) (optional($project->groundWires2)->model ?? 0);
            $zaj_tem2 = (float) (optional($project->groundWires2)->temp_exp_coeff ?? 0);
            $zaj_mas2 = (float) (optional($project->groundWires2)->mass ?? 0);
            $zaj_dij2 = (float) (optional($project->groundWires2)->diameter ?? 0);

            // GAPRES ===========================================================

            $gapresRows = Gapres::where('id_project', $projectId)
                ->orderBy('stac_t', 'asc')
                ->get();

            if ($gapresRows->isEmpty()) {return 0;}


            // TRASA ============================================================
            $trasaRows = Trasa::with([
                'tower.towerA',
                'trafo',
                'insulator1',
                'insulator2',
            ])
                ->where('id_project', $projectId)
                ->where(function ($q) {
                    $q->where('id_tower', '>', 0)
                        ->orWhere('id_trafo', '>', 0);
                })
                ->orderBy('stac_t', 'asc')
                ->get();

            $trasaMap = [];
            foreach ($trasaRows as $t) {
                $key = number_format((float) $t->stac_t, 2, '.', '');
                $trasaMap[$key] = $t;
            }

            // ZATPOL ===========================================================
            $zatpolRows = Zatpol::where('id_project', $projectId)->get();

            // map по stac_po / stac_kr

            $zatpolStartMap = [];
            $zatpolEndMap   = [];

            foreach ($zatpolRows as $z) {
                $keyPo = number_format((float) $z->stac_po, 2, '.', '');
                $keyKr = number_format((float) $z->stac_kr, 2, '.', '');

                $zatpolStartMap[$keyPo] = $z;
                $zatpolEndMap[$keyKr]   = $z;
            }
//  =======================================================================================================================================================

            $updated = 0;

            // LOOP PO GAPRES ===================================================
            foreach ($gapresRows as $gp) {

                $sta = (float) ($gp->stac_t ?? 0);
                $key = number_format($sta, 2, '.', '');

                // TRASA ============================================================
                $trasa = $trasaMap[$key] ?? null;
                if (!$trasa) {
                    continue;
                }

                $updates = [];

                // =================================================================
                // START (stac_po) -> elr_pro2 / elr_zaj2
                // =================================================================
                if (isset($zatpolStartMap[$key])) {

                    $zatpol = $zatpolStartMap[$key];

                    [$p, $z, $z2] = $this->calcElras(
                        $zatpol,
                        $trasa,
                        $pro_mod,
                        $pro_tem,
                        $pro_mas,
                        $pro_dij,
                        $zaj_mod,
                        $zaj_tem,
                        $zaj_mas,
                        $zaj_dij,
                        $zaj_mod2,
                        $zaj_tem2,
                        $zaj_mas2,
                        $zaj_dij2,
                        $numGroundWires,
                        $d_sig
                    );

                    $updates['elr_pro2'] = $p;
                    $updates['elr_zaj2'] = $z;
                    $updates['elr_zaj22'] = $z2;
                }

                // =================================================================
                // END (stac_kr) -> elr_pro1 / elr_zaj1
                // =================================================================
                if (isset($zatpolEndMap[$key])) {

                    $zatpol = $zatpolEndMap[$key];

                    [$p, $z, $z2] = $this->calcElras(
                        $zatpol,
                        $trasa,
                        $pro_mod,
                        $pro_tem,
                        $pro_mas,
                        $pro_dij,
                        $zaj_mod,
                        $zaj_tem,
                        $zaj_mas,
                        $zaj_dij,
                        $zaj_mod2,
                        $zaj_tem2,
                        $zaj_mas2,
                        $zaj_dij2,
                        $numGroundWires,
                        $d_sig
                    );

                    $updates['elr_pro1'] = $p;
                    $updates['elr_zaj1'] = $z;
                    $updates['elr_zaj12'] = $z2;
                }

                // =================================================================
                // MIDDLE (внатре во поле) -> и двете страни
                // =================================================================
                if (!isset($zatpolStartMap[$key]) && !isset($zatpolEndMap[$key])) {

                    $mid = $zatpolRows->first(function ($z) use ($sta) {
                        return $sta > (float)$z->stac_po && $sta < (float)$z->stac_kr;
                    });

                    if ($mid) {

                        [$p, $z, $z2] = $this->calcElras(
                            $mid,
                            $trasa,
                            $pro_mod,
                            $pro_tem,
                            $pro_mas,
                            $pro_dij,
                            $zaj_mod,
                            $zaj_tem,
                            $zaj_mas,
                            $zaj_dij,
                            $zaj_mod2,
                            $zaj_tem2,
                            $zaj_mas2,
                            $zaj_dij2,
                            $numGroundWires,
                            $d_sig
                        );

                        $updates['elr_pro1'] = $p;
                        $updates['elr_pro2'] = $p;
                        $updates['elr_zaj1'] = $z;
                        $updates['elr_zaj2'] = $z;
                        $updates['elr_zaj12'] = $z2;
                        $updates['elr_zaj22'] = $z2;
                    }
                }

                // =================================================================
                // UPDATE
                // =================================================================
                if (!empty($updates)) {
                    $gp->update($updates);
                    $updated++;
                }
            }

            return $updated;
        });
    }

    private function calcElras(
        $zatpol,
        $trasa,
        $pro_mod,
        $pro_tem,
        $pro_mas,
        $pro_dij,
        $zaj_mod,
        $zaj_tem,
        $zaj_mas,
        $zaj_dij,
        $zaj_mod2,
        $zaj_tem2,
        $zaj_mas2,
        $zaj_dij2,
        $numGroundWires,
        $d_sig
    ): array {

        $tovp   = (float) ($zatpol->tovpro ?? 0);
        $tovp_1 = (float) ($zatpol->tovpro_1 ?? 0);
        $tovz   = (float) ($zatpol->tovzaj ?? 0);
        $tovz_1 = (float) ($zatpol->tovzaj_1 ?? 0);
        $tovz2   = (float) ($zatpol->tovzaj2 ?? 0);
        $tovz_12 = (float) ($zatpol->tovzaj_12 ?? 0);
        $nap_p  = (float) ($zatpol->nap_pro ?? 0);
        $nap_z  = (float) ($zatpol->nap_zaj ?? 0);
        $nap_z2  = (float) ($zatpol->nap_zaj2 ?? 0);
        $pri_v  = (float) ($zatpol->priv ?? 0);

        $stb_nap = (float) (optional($trasa->tower)->voltage ?? 0);
        $stb_ag  = (float) (optional($trasa->tower)->angle ?? 0);
        $stb_dp  = (float) (optional($trasa->tower)->dkp ?? 0);
        $stb_dz  = (float) (optional($trasa->tower)->dkz ?? 0);
        $stb_rap = (string) (optional($trasa->tower)->rap ?? '');
        $stb_raz = (string) (optional($trasa->tower)->raz ?? '');

        $izo_sup = (int) (optional($trasa->insulator1)->support_insulator ?? 0);
        $izo_dol = (float) (optional($trasa->insulator1)->length ?? 0);

        if ($stb_ag > 0 || $izo_sup === 1) {
            $izo_dol = 0;
        }
        // ===================================================================================================================================================
        // Провес за проводник +40
        // ===================================================================================================================================================

        if($trasa->id_trafo){
            $stb_rap='H';
            $stb_dp=(float) (optional($trasa->trafo)->hor_ras ?? 0);

        }
        $pro_kof = $this->resolveRapCoefficient($stb_rap, $pri_v, $pro_dij, $pro_mas);

        $prvs_p4o = 0.0;

        if ($pro_kof > 0) {
            $prvs_p4o = ((100 * $stb_dp - $d_sig) / $pro_kof) ** 2 - (100 * $izo_dol);
        }

        // ===================================================================================================================================================
        // Провес за заштитно јаже 1 +40
        // ===================================================================================================================================================
        $prvs_z4o = $prvs_p4o;

        if (($numGroundWires===1 ||$numGroundWires===2 )&& $zaj_dij > 0 && $zaj_mas > 0) {
            $raz = strtoupper(trim($stb_raz));

            if($trasa->id_trafo){
                $raz='K';
            }

            if ($raz === 'K') {
                $zaj_kof = 2 + $this->arcTgDeg($pri_v * $zaj_dij / $zaj_mas) / 10;
                if ($zaj_kof < 7) {
                    $zaj_kof = 7;
                }
                $prvs_z4o = $prvs_p4o;

            } elseif ($raz === 'H') {
                if ($stb_nap == 0) {
                    $prvs_z4o = $prvs_p4o;
                } else {
                    $zaj_kof = 4 + $this->arcTgDeg($pri_v * $zaj_dij / $zaj_mas) / 25;
                    if ($zaj_kof < 6) {
                        $zaj_kof = 6;
                    }
                    $prvs_z4o = (100 * $stb_dz / $zaj_kof) ** 2;
                }

            } elseif ($raz === 'V') {
                $zaj_kof = 4 + $this->arcTgDeg($pri_v * $zaj_dij / $zaj_mas) / 5;
                if ($zaj_kof < 14) {
                    $zaj_kof = 14;
                }
                $prvs_z4o = (100 * $stb_dz / $zaj_kof) ** 2;
            }
        }

        // ===================================================================================================================================================
        // Провес за заштитно јаже 2 +40
        // ===================================================================================================================================================
        $prvs_z4o2= $prvs_p4o;

        if ($numGroundWires===2&& $zaj_dij2 > 0 && $zaj_mas2 > 0) {
            $raz = strtoupper(trim($stb_raz));

            if($trasa->id_trafo){
                $raz='K';
            }

            if ($raz === 'K') {
                $zaj_kof2 = 2 + $this->arcTgDeg($pri_v * $zaj_dij2 / $zaj_mas2) / 10;
                if ($zaj_kof2 < 7) {
                    $zaj_kof2 = 7;
                }
                $prvs_z4o2 = $prvs_p4o;

            } elseif ($raz === 'H') {
                if ($stb_nap == 0) {
                    $prvs_z4o2 = $prvs_p4o;
                } else {
                    $zaj_kof2 = 4 + $this->arcTgDeg($pri_v * $zaj_dij2 / $zaj_mas2) / 25;
                    if ($zaj_kof2 < 6) {
                        $zaj_kof2 = 6;
                    }
                    $prvs_z4o2 = (100 * $stb_dz / $zaj_kof2) ** 2;
                }

            } elseif ($raz === 'V') {
                $zaj_kof2 = 4 + $this->arcTgDeg($pri_v * $zaj_dij2 / $zaj_mas2) / 5;
                if ($zaj_kof2 < 14) {
                    $zaj_kof2 = 14;
                }
                $prvs_z4o2 = (100 * $stb_dz / $zaj_kof2) ** 2;
            }
        }


        // ===================================================================================================================================================
        // Електричен распон за проводник
        // ===================================================================================================================================================

        $elras_p = 0.0;

        $denP = 3 * ($nap_p ** 2) * $tovp + $pro_mod * ($tovp_1 ** 2) * 0.01 * $prvs_p4o;
        //dd($nap_p);

        if ($denP > 0 && $tovp > 0) {

            $ap_pom = (3 * ($nap_p ** 2) * $tovp * (45 * $pro_tem * $pro_mod - $nap_p)) / $denP;
            $bp_pom = (($tovp ** 2) * ($nap_p ** 2) * $pro_mod * 0.01 * $prvs_p4o) / $denP;

            $inside = $ap_pom ** 2 + 4 * $bp_pom;

            if ($inside >= 0) {
                $root = sqrt($inside);
                $expr = (8 * 0.01 * $prvs_p4o * ($root - $ap_pom)) / (2 * $tovp);

                if ($expr >= 0) {
                    $elras_p = sqrt($expr);
                }
            }
        }



        $elras_z = null;

        if (($numGroundWires >= 1) && $tovz > 0) {
            $denZ = 3 * ($nap_z ** 2) * $tovz + $zaj_mod * ($tovz_1 ** 2) * 0.01 * $prvs_z4o;

            if ($denZ > 0) {
                $az_pom = (3 * ($nap_z ** 2) * $tovz * (45 * $zaj_tem * $zaj_mod - $nap_z)) / $denZ;
                $bz_pom = (($tovz ** 2) * ($nap_z ** 2) * $zaj_mod * 0.01 * $prvs_z4o) / $denZ;

                if ($stb_nap == 0) {
                    $elras_z = $elras_p;
                } else {
                    $inside = $az_pom ** 2 + 4 * $bz_pom;

                    if ($inside >= 0) {
                        $root = sqrt($inside);
                        $expr = (8 * 0.01 * $prvs_z4o * ($root - $az_pom)) / (2 * $tovz);

                        if ($expr >= 0) {
                            $elras_z = sqrt($expr);
                        }
                    }
                }
            }
        }

        $elras_z2 = null;

        if ($numGroundWires===2 && $tovz2 > 0) {
            $denZ2 = 3 * ($nap_z2 ** 2) * $tovz2 + $zaj_mod2 * ($tovz_12 ** 2) * 0.01 * $prvs_z4o2;

            if ($denZ2 > 0) {
                $az_pom = (3 * ($nap_z2 ** 2) * $tovz2 * (45 * $zaj_tem2 * $zaj_mod2 - $nap_z2)) / $denZ2;
                $bz_pom = (($tovz2 ** 2) * ($nap_z2 ** 2) * $zaj_mod2 * 0.01 * $prvs_z4o2) / $denZ2;

                if ($stb_nap == 0) {
                    $elras_z2 = $elras_p;
                } else {
                    $inside = $az_pom ** 2 + 4 * $bz_pom;

                    if ($inside >= 0) {
                        $root = sqrt($inside);
                        $expr = (8 * 0.01 * $prvs_z4o2 * ($root - $az_pom)) / (2 * $tovz2);

                        if ($expr >= 0) {
                            $elras_z2 = sqrt($expr);
                        }
                    }
                }
            }
        }



        return [$elras_p, $elras_z, $elras_z2];
    }

    private function resolveSafetyDistances(float $nomNap): array
    {
        if ($nomNap > 1 && $nomNap <= 10) {
            return [15.0, 12.0];
        }
        if ($nomNap > 10 && $nomNap <= 20) {
            return [25.0, 22.0];
        }
        if ($nomNap > 20 && $nomNap <= 35) {
            return [35.0, 30.0];
        }
        if ($nomNap > 35 && $nomNap <= 110) {
            return [90.0, 80.0];
        }
        if ($nomNap > 110 && $nomNap <= 220) {
            return [175.0, 155.0];
        }
        if ($nomNap > 220 && $nomNap <= 400) {
            return [280.0, 270.0];
        }

        return [0.0, 0.0];
    }

    private function arcTgDeg(float $value): float
    {
        return rad2deg(atan($value));
    }

    private function resolveRapCoefficient(string $rap, float $priV, float $diameter, float $mass): float
    {
        $rap = strtoupper(trim($rap));

        if ($mass <= 0) {
            return 0.0;
        }

        if ($rap === 'K') {
            $coef = 2 + $this->arcTgDeg($priV * $diameter / $mass) / 10;
            return max($coef, 7.0);
        }

        if ($rap === 'H') {
            $coef = 4 + $this->arcTgDeg($priV * $diameter / $mass) / 25;
            return max($coef, 6.0);
        }

        if ($rap === 'V') {
            $coef = 4 + $this->arcTgDeg($priV * $diameter / $mass) / 5;
            return max($coef, 14.0);
        }

        return 0.0;
    }
}
