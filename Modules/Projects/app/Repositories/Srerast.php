<?php

namespace Modules\Projects\Repositories;

use App\Models\Gapres;
use App\Models\Projects;
use App\Models\Trasa;
use App\Models\Zatpol;
use Illuminate\Support\Facades\DB;

class Srerast
{
    public function srerast(int $projectId): int
    {
        return DB::transaction(function () use ($projectId) {

            // PROJECTS =========================================================================================================

            $project = Projects::with(['conductors', 'groundWires',])->findOrFail($projectId);

            $broj_ps = (float) ($project->num_cond_bundle ?? 0);
            $dim_p = (float) (optional($project->conductors)->diameter ?? 0);       // pro_dijam
            $dim_z = (float) (optional($project->groundWires)->diameter ?? 0);      // zaj_dijam
            $pre_p = (float) (optional($project->conductors)->cross_section ?? 0);  // pro_presek
            $pre_z = (float) (optional($project->groundWires)->cross_section ?? 0); // zaj_presek


            // GAPRES =========================================================================================================

            $gapresRows = Gapres::where('id_project', $projectId)
                ->orderBy('stac_t', 'asc')
                ->get();

            if ($gapresRows->isEmpty()) {return 0;}

            // TRASA ========================================================================================================

            $trasaRows = Trasa::with(['tower.towerA'])
                ->where('id_project', $projectId)
                ->where(function ($q) {
                    $q->where('id_tower', '>', 0)
                        ->orWhere('id_trafo', '>', 0);
                })
                ->orderBy('stac_t', 'asc')
                ->get();

            // map по stac_t
            $trasaMap = [];
            foreach ($trasaRows as $t) {
                $key = number_format((float) $t->stac_t, 2, '.', '');
                $trasaMap[$key] = $t;
            }

            // ZATPOL =========================================================================================================

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
            $lastAgolT = 0.0;
            $lastStolAg = 0.0;


            foreach ($gapresRows as $gp) {

                $staKey = number_format((float) $gp->stac_t, 2, '.', '');


                $trasa = $trasaMap[$staKey] ?? null;

                if (!$trasa) {
                    continue;
                }

                // =====================================================
                // Податоци за столб
                // =====================================================

                $ag_t     = (float) ($trasa->agol_tr ?? 0);
                $sto_ag1  = (float) (optional($trasa->tower)->angle ?? 0);
                $tower_specification  = (string) (optional($trasa->tower)->specification ?? '');
                $vx_b = (float) (optional(optional($trasa->tower)->towerA)->vxb ?? 0);
                $zx_b = (float) (optional(optional($trasa->tower)->towerA)->zxb ?? 0);

                $lastAgolT = $ag_t;
                $lastStolAg = $sto_ag1;


                // =====================================================
                // DOS-like SEEK со SOFTSEEK ON
                // наместо exact match по stac_po / stac_kr
                // =====================================================
                $sta = (float) $gp->stac_t;

                $zatStart = $zatpolRows
                    ->filter(fn($z) => (float) $z->stac_po >= $sta)
                    ->sortBy('stac_po')
                    ->first();

                $nap_p1 = (float) ($zatStart->nap_pro ?? 0);
                $nap_z1 = (float) ($zatStart->nap_zaj ?? 0);
                $pri_v1 = (float) ($zatStart->priv ?? 0);

                if ($tower_specification === 'A') {
                    $zatEnd = $zatpolRows
                        ->filter(fn($z) => (float) $z->stac_kr >= $sta)
                        ->sortBy('stac_kr')
                        ->first();

                    $nap_p2 = (float) ($zatEnd->nap_pro ?? 0);
                    $nap_z2 = (float) ($zatEnd->nap_zaj ?? 0);
                    $pri_v2 = (float) ($zatEnd->priv ?? 0);
                } else {
                    $nap_p2 = 0.0;
                    $nap_z2 = 0.0;
                    $pri_v2 = 0.0;
                }


                $pri_v = max($pri_v1, $pri_v2);
                $nap_p = max($nap_p1, $nap_p2);
                $nap_z = max($nap_z1, $nap_z2);


                // Формули

                $sr_p = 0.0;
                $sr_z = 0.0;
                $sr_ra = 0.0;
                $prc_sr = 0.0;



                //Пресметка на
                if ($tower_specification === 'A') {
                    // Аголно-затезен столб

                    if ($pri_v > 0 && $broj_ps > 0 && $dim_p > 0) {
                        $sr_p = 1000 * (
                                $vx_b - 2 * (2 * $broj_ps * $nap_p * $pre_p * sin(deg2rad($ag_t / 2))) / 3
                            ) / ($pri_v * $broj_ps * $dim_p);
                    }

                    if ($pri_v > 0 && $dim_z > 0) {
                        $sr_z = 1000 * (
                                $zx_b - 2 * (2 * $nap_z * $pre_z * sin(deg2rad($ag_t / 2))) / 3
                            ) / ($pri_v * $dim_z);
                    }

                } else {
                    // Носечки столб

                    if ($pri_v > 0 && $broj_ps > 0 && $dim_p > 0) {
                        $sr_p = 1000 * $vx_b / ($pri_v * $broj_ps * $dim_p);
                    }

                    if ($pri_v > 0 && $dim_z > 0) {
                        $sr_z = 1000 * $zx_b / ($pri_v * $dim_z);
                    }
                }

                if ($dim_z == 0 || $pre_z == 0 || $sr_z <= 0) {
                    $sr_ra = $sr_p;
                } else {
                    if ($sr_p > 0 && $sr_z > 0) {
                        $sr_ra = min($sr_p, $sr_z);
                    } else {
                        $sr_ra = max($sr_p, $sr_z);
                    }
                }

                if ($sr_ra > 0) {
                    $prc_sr = ((float) ($gp->sre_ras ?? 0) * 100) / $sr_ra;
                }

                $gp->update([
                    's_ra_st'  => $sr_ra,
                    'proc_sr'  => $prc_sr,
                    'stol_ag1' => $sto_ag1,
                    'agol_t'   => $ag_t,
                ]);

                $updated++;
            }

            // =========================================================
            // Реплика на DOS "GO BOTTOM / REPLACE"
            // ако сакаш буквално исто однесување
            // =========================================================
            $lastGapres = $gapresRows->last();
            if ($lastGapres) {
                $lastGapres->update([
                    'agol_t'   => $lastAgolT,
                    'stol_ag1' => $lastStolAg,
                ]);
            }

            return $updated;
        });
    }
}
