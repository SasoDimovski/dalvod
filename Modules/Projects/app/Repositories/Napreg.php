<?php

namespace Modules\Projects\Repositories;

use App\Models\Projects;
use App\Models\Zatpol;
use Illuminate\Support\Facades\DB;

class Napreg
{
    public function napreg(int $projectId): int
    {


        return DB::transaction(function () use ($projectId) {

            // ===== 1) Проект + проводник + заземјач (Osparam аналог) =====
            $project = Projects::with(['conductors', 'groundWires', 'groundWires2'])->findOrFail($projectId);

            // Проводник (conductors)
            $pro_mas = (float)optional($project->conductors)->mass;               // kg/km
            $pro_pres = (float)optional($project->conductors)->cross_section;      // mm²
            $pro_dij = (float)optional($project->conductors)->diameter;           // mm
            $pro_mod = (float)optional($project->conductors)->model;              // "modulus" (како DOS)
            $pro_tem = (float)optional($project->conductors)->temp_exp_coeff;  //  pro_temko

            // Заземјач (ground_wires)
            $zaj_mas = (float)optional($project->groundWires)->mass;
            $zaj_pres = (float)optional($project->groundWires)->cross_section;
            $zaj_dij = (float)optional($project->groundWires)->diameter;
            $zaj_mod = (float)optional($project->groundWires)->model;
            $zaj_tem = (float)optional($project->groundWires)->temp_exp_coeff; // zaj_temko

            // Заземјач 2 (ground_wires)
            $zaj_mas2 = (float)optional($project->groundWires2)->mass;
            $zaj_pres2 = (float)optional($project->groundWires2)->cross_section;
            $zaj_dij2 = (float)optional($project->groundWires2)->diameter;
            $zaj_mod2 = (float)optional($project->groundWires2)->model;
            $zaj_tem2 = (float)optional($project->groundWires2)->temp_exp_coeff; // zaj_temko

            // ===== 2) Земи ги ZATPOL редовите =====
            $zat = Zatpol::where('id_project', $projectId)->get();
            if ($zat->isEmpty()) {
                return 0;
            }

            // Basic validation за проводник (зашто секогаш се пресметува)
            if ($pro_mas <= 0 || $pro_pres <= 0 || $pro_dij <= 0 || $pro_mod == 0 || $pro_tem == 0) {
                throw new \RuntimeException('NAPREG_1: Недостатни параметри за проводник (mass/cross_section/diameter/model/temp_exp_coeff).');
            }

            // ============================================================
            // PASS 1: ПРОВОДНИК
            // ============================================================
            foreach ($zat as $zp) {


                $kn = (float)($zp->kndt ?? 0);
                $ki = (float)($zp->kidt ?? 0);
                $nap_p = (float)($zp->nap_pro ?? 0);
                $id_ras = (float)($zp->id_raspon ?? 0);

                // tovpr / tovpr_1 / tovpr_2
                $tovpr = 0.000981 * $pro_mas / $pro_pres;
                $tovpr_1 = (0.000981 * $pro_mas + $kn * 0.18 * sqrt($pro_dij)) / $pro_pres;
                $tovpr_2 = (0.000981 * $pro_mas + $kn * $ki * 0.18 * sqrt($pro_dij)) / $pro_pres;

                $zp->tovpro = $tovpr; // tovpro ==========================================================
                $zp->tovpro_1 = $tovpr_1; // tovpro_1 ==========================================================
                $zp->tovpro_2 = $tovpr_2; // tovpro_2 ==========================================================


                // krit_tempro / krit_raspro
                $krit_te_p = 0.0;
                $krit_ra_p = 0.0;


                $den = ($tovpr_1 * $tovpr_1) - ($tovpr * $tovpr);
                if ($nap_p > 0 && $tovpr_1 != 0.0 && $den > 0.0) {
                    $krit_te_p = ($nap_p * (1.0 - ($tovpr / $tovpr_1)) / ($pro_mod * $pro_tem)) - 5.0;
                    $krit_ra_p = $nap_p * sqrt(360.0 * $pro_tem / $den);
                }

                $zp->krit_te_p = $krit_te_p; // krit_te_p ==========================================================
                $zp->krit_ra_p = $krit_ra_p; // krit_ra_p ==========================================================


//                if ($zp->id_trasa_po == 2167) {
//                    dd([
//                        'id_ras'   => $id_ras,
//                        'nap_p'    => $nap_p,
//                        'kn'       => $kn,
//                        'ki'       => $ki,
//
//                        'pro_mas'  => $pro_mas,
//                        'pro_pres' => $pro_pres,
//                        'pro_dij'  => $pro_dij,
//                        'pro_mod'  => $pro_mod,
//                        'pro_tem'  => $pro_tem,
//
//                        'tovpr'    => $tovpr,
//                        'tovpr_1'  => $tovpr_1,
//                        'tovpr_2'  => $tovpr_2,
//
//                        'krit_te_p' => $krit_te_p,
//                        'krit_ra_p' => $krit_ra_p,
//                    ]);
//                }


                // ПРЕСМЕТКА НА НАПРЕГАЊА ========================================================================================================================================================================================================================================
                $napreg = array_fill(1, 8, 0.0);

                $N_pro = ($tovpr * $tovpr) * ($id_ras * $id_ras) * $pro_mod / 24.0;

                if ($id_ras > $krit_ra_p) {
                    // -------- Napreganje prov - 1 --------
                    for ($i = 1; $i <= 7; $i++) {

                        $temp = 10 * $i - 30; // -20, -10, 0, 10, 20, 30, 40

                        $M = (($tovpr_1 * $tovpr_1) * ($id_ras * $id_ras) * $pro_mod)
                            / (24.0 * max($nap_p * $nap_p, 1e-12))
                            + ($pro_tem * $pro_mod * ($temp + 5.0))
                            - $nap_p;

                        $napreg[$i] = $this->solveNapregNewton($N_pro, $M, 0.1, 0.001);
                    }


                    $napreg[8] = $nap_p;

                } else {
                    // -------- Napreganje prov - 2 --------
                    // Temp[1]=-20; napreg[1]=nap_p
                    $napreg[1] = $nap_p;

                    for ($i = 2; $i <= 7; $i++) {
                        $temp = 10 * $i - 30;

                        $M = (($tovpr * $tovpr) * ($id_ras * $id_ras) * $pro_mod)
                            / (24.0 * max($nap_p * $nap_p, 1e-12))
                            + ($pro_tem * $pro_mod * ($temp + 20.0))
                            - $nap_p;

                        $napreg[$i] = $this->solveNapregNewton($N_pro, $M, 0.5, 0.05);
                    }

                    // i=8 посебно:

                    $N8_pro = (($tovpr_1 * $tovpr_1) * ($id_ras * $id_ras) * $pro_mod) / 24.0;

                    $M8 = (($tovpr * $tovpr) * ($id_ras * $id_ras) * $pro_mod)
                        / (24.0 * max($nap_p * $nap_p, 1e-12))
                        + ($pro_tem * $pro_mod * ((-5.0) + 20.0))
                        - $nap_p;

                    $napreg[8] = $this->solveNapregNewton($N8_pro, $M8, 0.5, 0.05);


                }
                // dd($napreg[3]);

                // Write napreg*_p fields
                $zp->napreg1_p = $napreg[1]; // napreg1_p ==========================================================
                $zp->napreg2_p = $napreg[2];// napreg2_p ==========================================================
                $zp->napreg3_p = $napreg[3];// napreg3_p ==========================================================
                $zp->napreg4_p = $napreg[4];// napreg4_p ==========================================================
                $zp->napreg5_p = $napreg[5];// napreg5_p ==========================================================
                $zp->napreg6_p = $napreg[6];// napreg6_p ==========================================================
                $zp->napreg7_p = $napreg[7];// napreg7_p ==========================================================
                $zp->napreg8_p = $napreg[8];// napreg8_p ==========================================================

                $zp->save();
            }

            // ============================================================
            // PASS 2: ЗАЗЕМЈАЧ
            // ============================================================


            if ($project->num_ground_wires == 0) {

                foreach ($zat as $zp) {
                    $zp->tovzaj = null;
                    $zp->tovzaj_1 = null;
                    $zp->tovzaj_2 = null;
                    $zp->napreg1_z = null;
                    $zp->napreg2_z = null;
                    $zp->napreg3_z = null;
                    $zp->napreg4_z = null;
                    $zp->napreg5_z = null;
                    $zp->napreg6_z = null;
                    $zp->napreg7_z = null;
                    $zp->napreg8_z = null;
                    $zp->krit_te_z = null;
                    $zp->krit_ra_z = null;

                    $zp->tovzaj2 = null;
                    $zp->tovzaj_12 = null;
                    $zp->tovzaj_22 = null;
                    $zp->napreg1_z2 = null;
                    $zp->napreg2_z2 = null;
                    $zp->napreg3_z2 = null;
                    $zp->napreg4_z2 = null;
                    $zp->napreg5_z2 = null;
                    $zp->napreg6_z2 = null;
                    $zp->napreg7_z2 = null;
                    $zp->napreg8_z2 = null;
                    $zp->krit_te_z2 = null;
                    $zp->krit_ra_z2 = null;

                    $zp->save();
                }
            } else {


                foreach ($zat as $zp) {

                    $zp->tovzaj2 = null;
                    $zp->tovzaj_12 = null;
                    $zp->tovzaj_22 = null;
                    $zp->napreg1_z2 = null;
                    $zp->napreg2_z2 = null;
                    $zp->napreg3_z2 = null;
                    $zp->napreg4_z2 = null;
                    $zp->napreg5_z2 = null;
                    $zp->napreg6_z2 = null;
                    $zp->napreg7_z2 = null;
                    $zp->napreg8_z2 = null;
                    $zp->krit_te_z2 = null;
                    $zp->krit_ra_z2 = null;

                    $kn = (float)($zp->kndt ?? 0);
                    $ki = (float)($zp->kidt ?? 0);
                    $nap_z = (float)($zp->nap_zaj ?? 0);
                    $id_ras = (float)($zp->id_raspon ?? 0);


                    // Ако има nap_z, мора да има валидни ground_wires параметри
                    if ($zaj_mas <= 0 || $zaj_pres <= 0 || $zaj_dij <= 0 || $zaj_mod == 0 || $zaj_tem == 0) {
                        throw new \RuntimeException('NAPREG_1: Недостатни параметри за заземјач (ground_wires.*).');
                    }

                    $tovzj = 0.000981 * $zaj_mas / $zaj_pres;
                    $tovzj_1 = (0.000981 * $zaj_mas + $kn * 0.18 * sqrt($zaj_dij)) / $zaj_pres;
                    $tovzj_2 = (0.000981 * $zaj_mas + $kn * $ki * 0.18 * sqrt($zaj_dij)) / $zaj_pres;

                    $zp->tovzaj = $tovzj; // tovzaj ==========================================================
                    $zp->tovzaj_1 = $tovzj_1; // tovzaj_1 ==========================================================
                    $zp->tovzaj_2 = $tovzj_2; // tovzaj_2 ==========================================================

                    $krit_te_z = 0.0;
                    $krit_ra_z = 0.0;

                    $den = ($tovzj_1 * $tovzj_1) - ($tovzj * $tovzj);
                    if ($tovzj_1 != 0.0 && $den > 0.0) {
                        $krit_te_z = ($nap_z * (1.0 - ($tovzj / $tovzj_1)) / ($zaj_mod * $zaj_tem)) - 5.0;
                        $krit_ra_z = $nap_z * sqrt(360.0 * $zaj_tem / $den);
                    }

                    $zp->krit_te_z = $krit_te_z;  // krit_te_z ==========================================================
                    $zp->krit_ra_z = $krit_ra_z; // krit_ra_z ==========================================================


                    // ПРЕСМЕТКА НА НАПРЕГАЊА ================================================================================================================================================================================================================================
                    $napreg = array_fill(1, 8, 0.0);
                    $N_zaj = ($tovzj * $tovzj) * ($id_ras * $id_ras) * $zaj_mod / 24.0;

                    if ($id_ras > $krit_ra_z) {
                        // -------- Napreganje zaj - 1 --------
                        for ($i = 1; $i <= 7; $i++) {
                            $temp = 10 * $i - 30;

                            $M = (($tovzj_1 * $tovzj_1) * ($id_ras * $id_ras) * $zaj_mod)
                                / (24.0 * max($nap_z * $nap_z, 1e-12))
                                + ($zaj_tem * $zaj_mod * ($temp + 5.0))
                                - $nap_z;

                            $napreg[$i] = $this->solveNapregNewton($N_zaj, $M, 0.5, 0.05);
                        }

                        // Temp[8] = -5; napreg[8] = nap_z
                        $napreg[8] = $nap_z;

                    } else {
                        // -------- Napreganje zaj - 2 --------
                        // Temp[1] = -20; napreg[1]=nap_z
                        $napreg[1] = $nap_z;

                        for ($i = 2; $i <= 7; $i++) {
                            $temp = 10 * $i - 30;

                            // M_zaj[i] = (tovzj^2 * id_ras^2 * zaj_mod)/(24 * nap_z^2) + zaj_tem*zaj_mod*(temp+20) - nap_z
                            $M = (($tovzj * $tovzj) * ($id_ras * $id_ras) * $zaj_mod)
                                / (24.0 * max($nap_z * $nap_z, 1e-12))
                                + ($zaj_tem * $zaj_mod * ($temp + 20.0))
                                - $nap_z;

                            $napreg[$i] = $this->solveNapregNewton($N_zaj, $M, 0.5, 0.05);
                        }

                        // i=8 посебно:
                        // N8 = tovzj_1^2 * id_ras^2 * zaj_mod / 24
                        // M8 = (tovzj^2 * id_ras^2 * zaj_mod)/(24 * nap_z^2) + zaj_tem*zaj_mod*( -5 + 20) - nap_z
                        $N8 = (($tovzj_1 * $tovzj_1) * ($id_ras * $id_ras) * $zaj_mod) / 24.0;

                        $M8 = (($tovzj * $tovzj) * ($id_ras * $id_ras) * $zaj_mod)
                            / (24.0 * max($nap_z * $nap_z, 1e-12))
                            + ($zaj_tem * $zaj_mod * ((-5.0) + 20.0))
                            - $nap_z;

                        $napreg[8] = $this->solveNapregNewton($N8, $M8, 0.5, 0.05);
                    }

                    $zp->napreg1_z = $napreg[1]; // napreg1_z ==========================================================
                    $zp->napreg2_z = $napreg[2]; // napreg2_z ==========================================================
                    $zp->napreg3_z = $napreg[3]; // napreg3_z ==========================================================
                    $zp->napreg4_z = $napreg[4]; // napreg4_z ==========================================================
                    $zp->napreg5_z = $napreg[5]; // napreg5_z ==========================================================
                    $zp->napreg6_z = $napreg[6]; // napreg6_z ==========================================================
                    $zp->napreg7_z = $napreg[7]; // napreg7_z ==========================================================
                    $zp->napreg8_z = $napreg[8]; // napreg8_z ==========================================================

                    $zp->save();
                }

            }
                if ($project->num_ground_wires == 2) {


                    // ============================================================
                    // PASS 3: ЗАЗЕМЈАЧ 2
                    // ============================================================
                    foreach ($zat as $zp) {

                        $kn = (float)($zp->kndt ?? 0);
                        $ki = (float)($zp->kidt ?? 0);
                        $nap_z = (float)($zp->nap_zaj2 ?? 0);
                        $id_ras = (float)($zp->id_raspon ?? 0);

                        // Ако има nap_z, мора да има валидни ground_wires параметри
                        if ($zaj_mas2 <= 0 || $zaj_pres2 <= 0 || $zaj_dij2 <= 0 || $zaj_mod2 == 0 || $zaj_tem2 == 0) {
                            throw new \RuntimeException('NAPREG_1: Недостатни параметри за заземјач (ground_wires.*).');
                        }

                        $tovzj2 = 0.000981 * $zaj_mas2 / $zaj_pres2;
                        $tovzj_12 = (0.000981 * $zaj_mas2 + $kn * 0.18 * sqrt($zaj_dij2)) / $zaj_pres2;
                        $tovzj_22 = (0.000981 * $zaj_mas2 + $kn * $ki * 0.18 * sqrt($zaj_dij2)) / $zaj_pres2;

                        $zp->tovzaj2 = $tovzj2; // tovzaj2 ==========================================================
                        $zp->tovzaj_12 = $tovzj_12; // tovzaj_12 ==========================================================
                        $zp->tovzaj_22 = $tovzj_22; // tovzaj_22 ==========================================================

                        $krit_te_z2 = 0.0;
                        $krit_ra_z2 = 0.0;

                        $den = ($tovzj_12 * $tovzj_12) - ($tovzj2 * $tovzj2);
                        if ($tovzj_12 != 0.0 && $den > 0.0) {
                            $krit_te_z2 = ($nap_z * (1.0 - ($tovzj2 / $tovzj_12)) / ($zaj_mod2 * $zaj_tem2)) - 5.0;
                            $krit_ra_z2 = $nap_z * sqrt(360.0 * $zaj_tem2 / $den);
                        }

                        $zp->krit_te_z2 = $krit_te_z2;  // krit_te_z2 ==========================================================
                        $zp->krit_ra_z2 = $krit_ra_z2; // krit_ra_z2 ==========================================================


                        // ПРЕСМЕТКА НА НАПРЕГАЊА ================================================================================================================================================================================================================================
                        $napreg = array_fill(1, 8, 0.0);
                        $N_zaj = ($tovzj2 * $tovzj2) * ($id_ras * $id_ras) * $zaj_mod2 / 24.0;

                        if ($id_ras > $krit_ra_z2) {

                            for ($i = 1; $i <= 7; $i++) {
                                $temp = 10 * $i - 30;

                                $M = (($tovzj_12 * $tovzj_12) * ($id_ras * $id_ras) * $zaj_mod2)
                                    / (24.0 * max($nap_z * $nap_z, 1e-12))
                                    + ($zaj_tem2 * $zaj_mod2 * ($temp + 5.0))
                                    - $nap_z;

                                $napreg[$i] = $this->solveNapregNewton($N_zaj, $M, 0.5, 0.05);
                            }

                            $napreg[8] = $nap_z;

                        } else {

                            $napreg[1] = $nap_z;

                            for ($i = 2; $i <= 7; $i++) {
                                $temp = 10 * $i - 30;

                                $M = (($tovzj2 * $tovzj2) * ($id_ras * $id_ras) * $zaj_mod2)
                                    / (24.0 * max($nap_z * $nap_z, 1e-12))
                                    + ($zaj_tem2 * $zaj_mod2 * ($temp + 20.0))
                                    - $nap_z;

                                $napreg[$i] = $this->solveNapregNewton($N_zaj, $M, 0.5, 0.05);
                            }

                            // i=8 посебно:
                            $N8 = (($tovzj_12 * $tovzj_12) * ($id_ras * $id_ras) * $zaj_mod2) / 24.0;

                            $M8 = (($tovzj2 * $tovzj2) * ($id_ras * $id_ras) * $zaj_mod2)
                                / (24.0 * max($nap_z * $nap_z, 1e-12))
                                + ($zaj_tem2 * $zaj_mod2 * ((-5.0) + 20.0))
                                - $nap_z;

                            $napreg[8] = $this->solveNapregNewton($N8, $M8, 0.5, 0.05);
                        }

                        $zp->napreg1_z2 = $napreg[1]; // napreg1_z ==========================================================
                        $zp->napreg2_z2 = $napreg[2]; // napreg2_z ==========================================================
                        $zp->napreg3_z2 = $napreg[3]; // napreg3_z ==========================================================
                        $zp->napreg4_z2 = $napreg[4]; // napreg4_z ==========================================================
                        $zp->napreg5_z2 = $napreg[5]; // napreg5_z ==========================================================
                        $zp->napreg6_z2 = $napreg[6]; // napreg6_z ==========================================================
                        $zp->napreg7_z2 = $napreg[7]; // napreg7_z ==========================================================
                        $zp->napreg8_z2 = $napreg[8]; // napreg8_z ==========================================================

                        $zp->save();
                    }
                }


            return $zat->count();

        }); // DB::transaction
    }       // napreg()




    private function solveNapregNewton(float $N, float $M, float $x0 = 0.5, float $del0 = 0.05): float
    {
        $x = max($x0, 1e-9);
        $del = $del0;

        $iter = 0;
        while (abs($del) > 1e-6 && $iter++ < 200) {

            $x2 = $x * $x;
            $x3 = $x2 * $x;

            if ($x2 < 1e-18 || $x3 < 1e-27) break;

            $num = ($N / $x2) - $x - $M;
            $den = (2.0 * $N / $x3) + 1.0;

            if (abs($den) < 1e-18) break;

            $del = $num / $den;
            $x += $del;

            if ($x <= 0) {
                $x = 1e-9;
                break;
            }
        }

        return $x;
    }


}
