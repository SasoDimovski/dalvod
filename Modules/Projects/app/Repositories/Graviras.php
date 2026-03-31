<?php

namespace Modules\Projects\Repositories;

use App\Models\Gapres;
use App\Models\Projects;
use App\Models\Raspres;
use App\Models\Trasa;
use Illuminate\Support\Facades\DB;

class Graviras
{
    public function graviras(int $projectId): int
    {
        return DB::transaction(function () use ($projectId) {

            $project = Projects::with(['groundWires'])->findOrFail($projectId);

            $hasGround = (int) ($project->num_ground_wires ?? 0) > 0;
            if (!$hasGround) {
                $hasGround = !empty(optional($project->groundWires)->id);
            }

            $raspres = Raspres::where('id_project', $projectId)
                ->orderBy('stac_t', 'asc')
                ->get();

            $trasa = Trasa::with(['tower', 'insulator1', 'insulator2', 'trafo'])
                ->where('id_project', $projectId)
                ->where(function ($q) {
                    $q->where('id_tower', '>', 0)
                        ->orWhere('id_trafo', '>', 0);
                })
                ->orderBy('stac_t', 'asc')
                ->get();

            if ($raspres->isEmpty() || $trasa->isEmpty()) {
                return 0;
            }

            // КЛУЧНО: map po trasa.id
            $trasaMap = $trasa->keyBy('id');

            $grr_lpro_temp = 0.0;
            $grr_lprk_temp = 0.0;
            $grr_lzaj_temp = 0.0;
            $sr_rasp_temp  = 0.0;

            $inserted = 0;

            foreach ($raspres as $index => $rp) {

                $idTrasa = (int) ($rp->id_trasa ?? 0);
                $t = $trasaMap[$idTrasa] ?? null;

                if (!$t) {
                    continue;
                }

                $sta_t    = (float) ($rp->stac_t ?? 0.0);
                $raspon   = (float) ($rp->raspon ?? 0.0);

                $ras_tp1  = (float) ($rp->ras_totp ?? 0.0);
                $ras_tp1k = (float) ($rp->ras_t2op ?? 0.0);
                $ras_tz1  = (float) ($rp->ras_totz ?? 0.0);

                $vir_p1   = (float) ($rp->vr_pro ?? 0.0);
                $vir_z1   = (float) ($rp->vr_zaj ?? 0.0);

                $agol_t   = (float) ($t->agol_tr ?? 0.0);
                $stol_ag1 = (int) (optional($t->tower)->angle ?? 0);

                // ако немаш br_raspon во raspres, користи реден број
                $br_stolb = (int) ($rp->br_raspon ?? ($index + 1));

                // ============================================================
                // grr_lpro
                $grr_lpro = $grr_lpro_temp;

                if ($vir_p1 >= 0) {
                    $grr_lpro_temp = $ras_tp1 / 2.0;
                } else {
                    $grr_lpro_temp = $raspon - ($ras_tp1 / 2.0);
                }

                // grr_dpro
                if ($vir_p1 >= 0) {
                    $grr_dpro = $raspon - ($ras_tp1 / 2.0);
                } else {
                    $grr_dpro = $ras_tp1 / 2.0;
                }

                // grr_vpro
                $grr_vpro = $grr_lpro + $grr_dpro;

                // ============================================================
                // grr_lprk
                $grr_lprk = $grr_lprk_temp;

                if ($vir_p1 >= 0) {
                    $grr_lprk_temp = $ras_tp1k / 2.0;
                } else {
                    $grr_lprk_temp = $raspon - ($ras_tp1k / 2.0);
                }

                // grr_dprk
                if ($vir_p1 >= 0) {
                    $grr_dprk = $raspon - ($ras_tp1k / 2.0);
                } else {
                    $grr_dprk = $ras_tp1k / 2.0;
                }

                // grr_vprk
                $grr_vprk = $grr_lprk + $grr_dprk;

                // ============================================================
                // sr_rasp
                $sr_rasp = $sr_rasp_temp + ($raspon / 2.0);

                // ============================================================
                // grr_lzaj
                $grr_lzaj = $grr_lzaj_temp;

                if (!$hasGround) {
                    $grr_lzaj_temp = 0.0;
                } else {
                    if ($vir_z1 >= 0) {
                        $grr_lzaj_temp = $ras_tz1 / 2.0;
                    } else {
                        $grr_lzaj_temp = $raspon - ($ras_tz1 / 2.0);
                    }
                }

                // grr_dzaj
                if (!$hasGround) {
                    $grr_dzaj = 0.0;
                } else {
                    if ($vir_z1 >= 0) {
                        $grr_dzaj = $raspon - ($ras_tz1 / 2.0);
                    } else {
                        $grr_dzaj = $ras_tz1 / 2.0;
                    }
                }

                // grr_vzaj
                $grr_vzaj = $grr_lzaj + $grr_dzaj;

                // br_ras
                $br_ras = $br_stolb . '-' . ($br_stolb + 1);

                Gapres::create([
                    'id_project' => $projectId,
                    'id_trasa'   => $idTrasa,
                    'br_stolb'   => $br_stolb,
                    'stac_t'     => $sta_t,
                    'raspon'     => $raspon,

                    'grr_lpro'   => $grr_lpro,
                    'grr_dpro'   => $grr_dpro,
                    'grr_vpro'   => $grr_vpro,

                    'grr_lprk'   => $grr_lprk,
                    'grr_dprk'   => $grr_dprk,
                    'grr_vprk'   => $grr_vprk,

                    'grr_lzaj'   => $grr_lzaj,
                    'grr_dzaj'   => $grr_dzaj,
                    'grr_vzaj'   => $grr_vzaj,

                    'sre_ras'    => $sr_rasp,
                    'kota_pro'   => (float) ($rp->kota_pro ?? 0.0),
                    'kota_zaj'   => (float) ($rp->kota_zaj ?? 0.0),
                    'ras_totp'   => $ras_tp1,
                    'ras_totz'   => $ras_tz1,

                    'agol_t'     => $agol_t,
                    'stol_ag1'   => $stol_ag1,
                    'br_ras'     => $br_ras,
                ]);

                $sr_rasp_temp = $raspon / 2.0;
                $inserted++;
            }

            // ============================================================
            // Последен ред
            $lastT  = $trasa->last();
            $lastRp = $raspres->last();

            if ($lastT && $lastRp) {

                $sta_t_last = (float) ($lastT->stac_t ?? 0.0);

                $vir_p = (float) ($lastRp->vr_pro ?? 0.0);
                $vir_z = (float) ($lastRp->vr_zaj ?? 0.0);

                $raspon_last = (float) ($lastRp->raspon ?? 0.0);
                $sr_rl_last  = $raspon_last / 2.0;

                $agol_t   = (float) ($lastT->agol_tr ?? 0.0);
                $stol_ag1 = (int) (optional($lastT->tower)->angle ?? 0);

                $prev = Gapres::where('id_project', $projectId)
                    ->orderBy('id', 'desc')
                    ->first();

                $pomk_p = (float) ($prev->kota_pro ?? 0.0);
                $pomk_z = (float) ($prev->kota_zaj ?? 0.0);

                $br_st_last = (int) ($prev->br_stolb ?? $inserted);
                $br_st_new  = $br_st_last + 1;

                Gapres::create([
                    'id_project' => $projectId,
                    'id_trasa'   => (int) $lastT->id,

                    'br_stolb'   => $br_st_new,
                    'stac_t'     => $sta_t_last,

                    'sre_ras'    => $sr_rl_last,

                    'grr_lpro'   => $grr_lpro_temp,
                    'grr_dpro'   => 0.0,
                    'grr_vpro'   => $grr_lpro_temp,

                    'grr_lprk'   => $grr_lprk_temp,
                    'grr_dprk'   => 0.0,
                    'grr_vprk'   => $grr_lprk_temp,

                    'grr_lzaj'   => $grr_lzaj_temp,
                    'grr_dzaj'   => 0.0,
                    'grr_vzaj'   => $grr_lzaj_temp,

                    'kota_pro'   => $pomk_p + $vir_p,
                    'kota_zaj'   => $pomk_z + $vir_z,

                    'agol_t'     => $agol_t,
                    'stol_ag1'   => $stol_ag1,

                    'br_ras'     => '',
                ]);

                $inserted++;
            }

            return $inserted;
        });
    }
}
