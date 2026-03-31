<?php

namespace Modules\Projects\Repositories;

use App\Models\Gapres;
use App\Models\Projects;
use App\Models\Trasa;
use App\Models\Zatpol;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Grvrast
{

    public function grvrast(int $projectId): int
    {
        return DB::transaction(function () use ($projectId) {

            // PROJECT =========================================================================================================
            $project = Projects::with([
                'conductors',
                'groundWires',
            ])->findOrFail($projectId);

            $broj_ps = (float) ($project->num_cond_bundle ?? 0); // BR_PRSN
            $dim_p   = (float) (optional($project->conductors)->diameter ?? 0);
            $dim_z   = (float) (optional($project->groundWires)->diameter ?? 0);
            $pre_p   = (float) (optional($project->conductors)->cross_section ?? 0);
            $pre_z   = (float) (optional($project->groundWires)->cross_section ?? 0);

            $hasGround = !($dim_z == 0.0 || $pre_z == 0.0);

            if ($broj_ps <= 0 || $pre_p <= 0) {
                throw new \RuntimeException('GRVRAST: Недостатни параметри за проводник.');
            }

            // GAPRES ==========================================================================================================
            $gapresRows = Gapres::where('id_project', $projectId)
                ->orderBy('stac_t', 'asc')
                ->get();

            if ($gapresRows->isEmpty()) {
                return 0;
            }

            // TRASA ===========================================================================================================
            $trasaRows = Trasa::with([
                'tower.towerA',
                'insulator1',
                'insulator2',
            ])
                ->where('id_project', $projectId)
                ->where('id_tower', '>', 0)
                ->orderBy('stac_t', 'asc')
                ->get();

            $trasaMap = [];
            foreach ($trasaRows as $t) {
                $trasaMap[$this->stKey($t->stac_t)] = $t;
            }

            // ZATPOL ==========================================================================================================
            $zatpolRows = Zatpol::where('id_project', $projectId)
                ->orderBy('stac_po', 'asc')
                ->get();

            $updated = 0;

            foreach ($gapresRows as $gp) {

                $sta = (float) ($gp->stac_t ?? 0);
                $staKey = $this->stKey($sta);

                /** @var Trasa|null $trasa */
                $trasa = $trasaMap[$staKey] ?? null;
                if (!$trasa) {
                    continue;
                }

                // ОСНОВНИ ПОДАТОЦИ ===========================================================================================
                $sto_ag = (float) (optional($trasa->tower)->angle ?? 0);
                $ag_t   = (float) ($trasa->agol_tr ?? 0);

                $tower_specification = strtoupper(trim((string) (optional($trasa->tower)->specification ?? '')));

                $src = optional($trasa->tower)->towerA;

                $vz_a = (float) (optional($src)->vza ?? 0);
                $vz_b = (float) (optional($src)->vzb ?? 0);
                $zz_a = (float) (optional($src)->zza ?? 0);
                $zz_b = (float) (optional($src)->zzb ?? 0);

                // ИЗОЛАТОРИ ================================================================================================
                $izo_m      = (float) (optional($trasa->insulator1)->mass ?? 0);
                $izo_md_raw = (float) (optional($trasa->insulator1)->massd ?? 0);

                $izo_m2      = (float) (optional($trasa->insulator2)->mass ?? 0);
                $izo_md2_raw = (float) (optional($trasa->insulator2)->massd ?? 0);

                $agv_st = 0.0;
                $prc_gv = 0.0;
                $prc_gz = 0.0;

                // =========================================================================================================
                // АГОЛНО-ЗАТЕЗЕН СТОЛБ
                // =========================================================================================================
                if ($tower_specification === 'A') {

                    $zatStart = $this->findZatpolExactOrSoft($zatpolRows, 'stac_po', $sta);
                    $zatEnd   = $this->findZatpolExactOrSoft($zatpolRows, 'stac_kr', $sta);

                    $tov_p   = (float) ($zatEnd->tovpro ?? 0);
                    $tov_z   = (float) ($zatEnd->tovzaj ?? 0);

                    $tov_p1a = (float) ($zatStart->tovpro_1 ?? 0);
                    $tov_z1a = (float) ($zatStart->tovzaj_1 ?? 0);
                    $kn_dta  = (float) ($zatStart->kndt ?? 0);

                    $tov_p1b = (float) ($zatEnd->tovpro_1 ?? 0);
                    $tov_z1b = (float) ($zatEnd->tovzaj_1 ?? 0);
                    $kn_dtb  = (float) ($zatEnd->kndt ?? 0);

                    $kn_dt  = max($kn_dta, $kn_dtb);
                    $tov_p1 = max($tov_p1a, $tov_p1b);
                    $tov_z1 = max($tov_z1a, $tov_z1b);

                    $izo_md  = 0.981 * ($izo_m  + $kn_dt * ($izo_md_raw  - $izo_m));
                    $izo_md2 = 0.981 * ($izo_m2 + $kn_dt * ($izo_md2_raw - $izo_m2));

                    $agv_1 = 0.0;
                    $agv_2 = 0.0;
                    $agv_3 = 0.0;
                    $agv_4 = 0.0;
                    $agv_5 = 0.0;
                    $agv_6 = 0.0;

                    if (($broj_ps * $tov_p1 * $pre_p) != 0.0) {
                        $agv_1 = ($vz_a - $izo_md - $izo_md2) / ($broj_ps * $tov_p1 * $pre_p);
                    }

                    if (($broj_ps * $tov_p * $pre_p) != 0.0) {
                        $agv_2 = ($vz_b - $izo_m - $izo_m2) / ($broj_ps * $tov_p * $pre_p);
                    }

                    if (!$hasGround) {
                        $agv_st = min($agv_1, $agv_2);
                    } else {
                        $agv_3 = min($agv_1, $agv_2);

                        if (($tov_z1 * $pre_z) != 0.0) {
                            $agv_4 = $zz_a / ($tov_z1 * $pre_z);
                        }

                        $agv_5 = min($agv_3, $agv_4);

                        if (($tov_z * $pre_z) != 0.0) {
                            $agv_6 = $zz_b / ($tov_z * $pre_z);
                        }

                        $agv_st = min($agv_5, $agv_6);
                    }

                } else {
                    // =====================================================================================================
                    // НОСЕЧКИ СТОЛБ
                    // =====================================================================================================
                    $zatEnd = $this->findZatpolExactOrSoft($zatpolRows, 'stac_kr', $sta);

                    $tov_p  = (float) ($zatEnd->tovpro ?? 0);
                    $tov_p1 = (float) ($zatEnd->tovpro_1 ?? 0);
                    $tov_z  = (float) ($zatEnd->tovzaj ?? 0);
                    $tov_z1 = (float) ($zatEnd->tovzaj_1 ?? 0);
                    $kn_dt  = (float) ($zatEnd->kndt ?? 0);

                    $izo_md = 0.981 * ($izo_m + $kn_dt * ($izo_md_raw - $izo_m));

                    $agv_1 = 0.0;
                    $agv_2 = 0.0;
                    $agv_3 = 0.0;
                    $agv_4 = 0.0;
                    $agv_5 = 0.0;
                    $agv_6 = 0.0;

                    if (($broj_ps * $tov_p1 * $pre_p) != 0.0) {
                        $agv_1 = ($vz_a - $izo_md) / ($broj_ps * $tov_p1 * $pre_p);
                    }

                    if (($broj_ps * $tov_p * $pre_p) != 0.0) {
                        $agv_2 = ($vz_b - $izo_m) / ($broj_ps * $tov_p * $pre_p);
                    }

                    if (!$hasGround) {
                        $agv_st = min($agv_1, $agv_2);
                    } else {
                        $agv_3 = min($agv_1, $agv_2);

                        if (($tov_z1 * $pre_z) != 0.0) {
                            $agv_4 = $zz_a / ($tov_z1 * $pre_z);
                        }

                        $agv_5 = min($agv_3, $agv_4);

                        if (($tov_z * $pre_z) != 0.0) {
                            $agv_6 = $zz_b / ($tov_z * $pre_z);
                        }

                        $agv_st = min($agv_5, $agv_6);
                    }
                }

                if ($agv_st != 0.0) {
                    $prc_gv = ((float) ($gp->grr_vpro ?? 0) * 100) / $agv_st;
                    $prc_gz = ((float) ($gp->grr_vzaj ?? 0) * 100) / $agv_st;
                }

                $gp->update([
                    'proc_gv'  => $prc_gv,
                    'grr_st'   => $agv_st,
                    'proc_gz'  => $prc_gz,
                    'stol_ag1' => $sto_ag,
                    'agol_t'   => $ag_t,
                ]);

                $updated++;
            }

            return $updated;
        });
    }

    private function stKey($value, int $decimals = 2): string
    {
        return number_format((float) $value, $decimals, '.', '');
    }

    private function softSeekByField(Collection $rows, string $field, float $value, int $decimals = 2)
    {
        $targetKey = $this->stKey($value, $decimals);

        $exact = $rows->first(function ($row) use ($field, $targetKey, $decimals) {
            return $this->stKey($row->{$field} ?? 0, $decimals) === $targetKey;
        });

        if ($exact) {
            return $exact;
        }

        return $rows
            ->filter(fn ($row) => (float) ($row->{$field} ?? 0) >= $value)
            ->sortBy($field)
            ->first();
    }

    private function findZatpolExactOrSoft(Collection $rows, string $field, float $value)
    {
        $key = $this->stKey($value);

        $exact = $rows->first(fn ($row) => $this->stKey($row->{$field} ?? 0) === $key);

        if ($exact) {
            return $exact;
        }

        return $this->softSeekByField($rows, $field, $value);
    }

}
