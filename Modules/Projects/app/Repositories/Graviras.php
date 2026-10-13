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

            $project = Projects::findOrFail($projectId);

            $hasGround  = (int) ($project->num_ground_wires ?? 0) > 0;
            $hasGround2 = (int) ($project->num_ground_wires ?? 0) === 2;
            $numGroundWires = (int) ($project->num_ground_wires ?? 0);


            // ============================================================
            // 1. Сите столбови и трафо/портали по редослед
            // ============================================================

            $trasa = Trasa::with(['tower', 'trafo'])
                ->where('id_project', $projectId)
                ->where(function ($q) {
                    $q->where('id_tower', '>', 0)
                        ->orWhere('id_trafo', '>', 0);
                })
                ->orderBy('stac_t', 'asc')
                ->get();

            if ($trasa->isEmpty()) {
                return 0;
            }


            // ============================================================
            // 2. RASPRES - keyBy(id_trasa)
            // ============================================================

            $raspres = Raspres::where('id_project', $projectId)
                ->get()
                ->keyBy('id_trasa');


            // ============================================================
            // 3. Почетни вредности - исто како DOS
            //
            // gr_lp  = 0
            // gr_lpk = 0
            // gr_lz  = 0
            // sr_rl  = 0
            // ============================================================

            $gr_lp  = 0.0;
            $gr_lpk = 0.0;
            $gr_lz  = 0.0;
            $gr_lz2 = 0.0;

            $sr_rl = 0.0;

            $inserted = 0;


            // ============================================================
            // 4. LOOP ПО TRASA
            // ============================================================

            foreach ($trasa as $index => $t) {

                /*
                 * Последната точка нема распон после неа.
                 * Неа ќе ја запишеме посебно подолу.
                 */
                if ($index === $trasa->count() - 1) {
                    break;
                }


                // RASPRES што почнува од овој столб
                $rp = $raspres->get((int) $t->id);

                if (!$rp) {
                    continue;
                }


                // ========================================================
                // Вредности од RASPRES
                // ========================================================

                $raspon1 = (float) ($rp->raspon ?? 0.0);

                $ras_tp1  = (float) ($rp->ras_totp ?? 0.0);
                $ras_tp1k = (float) ($rp->ras_t2op ?? 0.0);

                $ras_tz1 = (float) ($rp->ras_totz ?? 0.0);
                $ras_tz2 = (float) ($rp->ras_totz2 ?? 0.0);

                $vir_p1 = (float) ($rp->vr_pro ?? 0.0);
                $vir_z1 = (float) ($rp->vr_zaj ?? 0.0);


                // ========================================================
                // ЛЕВИ вредности
                // Ова се вредностите пресметани од претходниот распон.
                // ========================================================

                $grr_lpro = $gr_lp;
                $grr_lprk = $gr_lpk;
                $grr_lzaj = $gr_lz;
                $grr_lzaj2 = $gr_lz2;


                // ========================================================
                // Среден распон - DOS:
                //
                // sr_rd   = raspon1 / 2
                // sr_rasp = sr_rl + sr_rd
                // ========================================================

                $sr_rd   = $raspon1 / 2.0;
                $sr_rasp = $sr_rl + $sr_rd;


                // ========================================================
                // Проводник
                // ========================================================

                if ($vir_p1 >= 0.0) {

                    $gr_lp  = $ras_tp1 / 2.0;
                    $gr_lpk = $ras_tp1k / 2.0;

                    $gr_dp  = $raspon1 - ($ras_tp1 / 2.0);
                    $gr_dpk = $raspon1 - ($ras_tp1k / 2.0);

                } else {

                    $gr_lp  = $raspon1 - ($ras_tp1 / 2.0);
                    $gr_lpk = $raspon1 - ($ras_tp1k / 2.0);

                    $gr_dp  = $ras_tp1 / 2.0;
                    $gr_dpk = $ras_tp1k / 2.0;
                }


                // ========================================================
                // Прво заштитно јаже
                // ========================================================

                if (!$hasGround) {

                    $gr_lz = 0.0;
                    $gr_dz = 0.0;

                } else {

                    if ($vir_z1 >= 0.0) {

                        $gr_lz = $ras_tz1 / 2.0;
                        $gr_dz = $raspon1 - ($ras_tz1 / 2.0);

                    } else {

                        $gr_lz = $raspon1 - ($ras_tz1 / 2.0);
                        $gr_dz = $ras_tz1 / 2.0;
                    }
                }


                // ========================================================
                // Второ заштитно јаже
                // ========================================================

                if (!$hasGround2) {

                    $gr_lz2 = 0.0;
                    $gr_dz2 = 0.0;

                } else {

                    // Засега користиме иста vr_zaj геометрија
                    if ($vir_z1 >= 0.0) {

                        $gr_lz2 = $ras_tz2 / 2.0;
                        $gr_dz2 = $raspon1 - ($ras_tz2 / 2.0);

                    } else {

                        $gr_lz2 = $raspon1 - ($ras_tz2 / 2.0);
                        $gr_dz2 = $ras_tz2 / 2.0;
                    }
                }


                // ========================================================
                // Вкупни гравитациони распони
                // ========================================================

                $gr_vkp  = $grr_lpro  + $gr_dp;
                $gr_vkpk = $grr_lprk  + $gr_dpk;

                $gr_vkz  = $grr_lzaj  + $gr_dz;
                $gr_vkz2 = $grr_lzaj2 + $gr_dz2;


                // ========================================================
                // Број на столб
                // ========================================================

                $br_stolb = (int) ($rp->raspon_br ?? ($index + 1));

                $br_rasp = $br_stolb . '-' . ($br_stolb + 1);


                // ========================================================
                // GAPRES
                // ========================================================

                Gapres::create([

                    'id_project' => $projectId,
                    'id_trasa'   => $t->id,

                    'br_stolb' => $br_stolb,
                    'stac_t'   => (float) $t->stac_t,
                    'raspon'   => $raspon1,

                    // Проводник
                    'grr_lpro' => $grr_lpro,
                    'grr_dpro' => $gr_dp,
                    'grr_vpro' => $gr_vkp,

                    'grr_lprk' => $grr_lprk,
                    'grr_dprk' => $gr_dpk,
                    'grr_vprk' => $gr_vkpk,

                    // Прво заштитно јаже
                    'grr_lzaj' => $hasGround ? $grr_lzaj : null,
                    'grr_dzaj' => $hasGround ? $gr_dz : null,
                    'grr_vzaj' => $hasGround ? $gr_vkz : null,

                    // Второ заштитно јаже
                    'grr_lzaj2' => $hasGround2 ? $grr_lzaj2 : null,
                    'grr_dzaj2' => $hasGround2 ? $gr_dz2 : null,
                    'grr_vzaj2' => $hasGround2 ? $gr_vkz2 : null,

                    'sre_ras' => $sr_rasp,

                    'kota_pro' => (float) ($rp->kota_pro ?? 0.0),
                    'kota_zaj' => (float) ($rp->kota_zaj ?? 0.0),

                    'ras_totp' => $ras_tp1,
                    'ras_totz' => $hasGround ? $ras_tz1 : null,
                    'ras_totz2' => $hasGround ? $ras_tz2 : null,

                    'agol_t' => (float) ($t->agol_tr ?? 0.0),

                    'stol_ag1' => $t->id_tower
                        ? (int) (optional($t->tower)->angle ?? 0)
                        : 0,

                    'br_ras' => $br_rasp,
                ]);


                // DOS:
                // sr_rl = raspon1 / 2
                $sr_rl = $raspon1 / 2.0;

                $inserted++;
            }


            // ============================================================
            // 5. ПОСЛЕДЕН СТОЛБ / ПОРТАЛ
            // ============================================================

            $lastT = $trasa->last();

            if ($lastT && $inserted > 0) {

                $prev = Gapres::where('id_project', $projectId)
                    ->orderBy('id', 'desc')
                    ->first();

                $lastRp = $raspres->last();

                if ($prev && $lastRp) {

                    $vir_p = (float) ($lastRp->vr_pro ?? 0.0);
                    $vir_z = (float) ($lastRp->vr_zaj ?? 0.0);

                    $raspon_last = (float) ($lastRp->raspon ?? 0.0);

                    Gapres::create([

                        'id_project' => $projectId,
                        'id_trasa'   => $lastT->id,

                        'br_stolb' => ((int) $prev->br_stolb) + 1,
                        'stac_t'   => (float) $lastT->stac_t,

                        'sre_ras' => $raspon_last / 2.0,

                        'grr_lpro' => $gr_lp,
                        'grr_dpro' => 0.0,
                        'grr_vpro' => $gr_lp,

                        'grr_lprk' => $gr_lpk,
                        'grr_dprk' => 0.0,
                        'grr_vprk' => $gr_lpk,

                        // Прво заштитно јаже
                        'grr_lzaj' => $hasGround ? $gr_lz : null,
                        'grr_dzaj' => $hasGround ? 0.0 : null,
                        'grr_vzaj' => $hasGround ? $gr_lz : null,

                        // Второ заштитно јаже
                        'grr_lzaj2' => $hasGround2 ? $gr_lz2 : null,
                        'grr_dzaj2' => $hasGround2 ? 0.0 : null,
                        'grr_vzaj2' => $hasGround2 ? $gr_lz2 : null,

                        'kota_pro' =>
                            (float) $prev->kota_pro + $vir_p,

                        'kota_zaj' =>
                            (float) $prev->kota_zaj + $vir_z,

                        // DOS експлицитно става 0
                        'agol_t'   => 0.0,
                        'stol_ag1' => 0,

                        'br_ras' => '',
                    ]);

                    $inserted++;
                }
            }


            return $inserted;
        });
    }
}
