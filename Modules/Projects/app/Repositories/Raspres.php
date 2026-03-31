<?php

namespace Modules\Projects\Repositories;

use App\Models\Projects;
use App\Models\Trasa;
use Illuminate\Support\Facades\DB;

class Raspres
{
    public function raspres(int $projectId): int
    {
        return DB::transaction(function () use ($projectId) {

            $project = Projects::with([
                'conductors',
                'groundWires',
                'insulatorChain',
            ])->findOrFail($projectId);

            // ----- Параметри од проект ----------------------------------------------------------------------------------------------------------------------------------------------------------------
            // Напони на затегање (N/mm2) – ги користиш веќе
            $tensile_stress_cond = (float) ($project->tensile_stress_cond ?? 0);   // проводник
            $tensile_stress_ground = (float) ($project->tensile_stress_ground ?? 0); // заземјач

            // Колку заземјачи има (ако 0 → "---")
            $hasGround = (int) ($project->num_ground_wires ?? 0) > 0;

            // Тип на сврзување (POTP / SILK / …) – прилагоди по својата шема
            //$izo_tied = optional($project->insulatorChain)->id ?? 'POTP';

            // Проводник: пресек (mm2) и маса (kg/km)
            $conductors_cross_section = (float) optional($project->conductors)->cross_section;   // mm²
            $conductors_mass  = (float) optional($project->conductors)->mass;            // kg/km

            // Заземјач – ако го користиш првиот ground wire
            $groundWires_cross_section = (float) optional($project->groundWires)->cross_section;  // mm² (прилагоди)
            $groundWires_mass  = (float) optional($project->groundWires)->mass;           // kg/km (прилагоди)

            // Безбедност: ако недостигаат параметри, фрли јасна грешка
            if (!$conductors_cross_section || !$conductors_mass || !$tensile_stress_cond) {
                throw new \RuntimeException('Недостатни параметри за проводник (presек/маса/напон).');
            }

            // ----- Читање на трасата, сортирано по станица -----
            $points = Trasa::with(['tower', 'insulator1', 'insulator2', 'trafo'])
                ->where('id_project', $projectId)
                ->where(function ($q) {
                    $q->where('id_tower', '>', 0)
                        ->orWhere('id_trafo', '>', 0);
                })
                ->orderBy('stac_t','asc')
                ->get();

            // Нема пресметка ако имаме < 2 точки
            if ($points->count() < 2) {
                return 0;
            }

            $inserted = 0;

            // Итерација по соседни парови точки
            for ($i = 0; $i < $points->count() - 1; $i++) {

                $p1 = $points[$i];
                $p2 = $points[$i + 1];

                //=======================================================================================================
                // Базични полиња
                $stac_t1 = (float) ($p1->stac_t ?? 0.0);
                $stac_t2 = (float) ($p2->stac_t ?? 0.0);

                $kota_t1 = (float) ($p1->kota_t ?? 0.0);
                $kota_t2 = (float) ($p2->kota_t ?? 0.0);

                //=======================================================================================================
                // ПОДАТОЦИ ЗА СТОЛБ
                //=======================================================================================================
                //Висина на долна конзола

                if ($p1->id_tower) {
                    $stolb_vis1 = (float) (optional($p1->tower)->vis ?? 0.0);
                } elseif ($p1->id_trafo) {
                    $stolb_vis1 = (float) (optional($p1->trafo)->visina_p ?? 0.0);
                } else {
                    $stolb_vis1 = 0.0;
                }

                if ($p2->id_tower) {
                    $stolb_vis2 = (float) (optional($p2->tower)->vis ?? 0.0);
                } elseif ($p2->id_trafo) {
                    $stolb_vis2 = (float) (optional($p2->trafo)->visina_p ?? 0.0);
                } else {
                    $stolb_vis2 = 0.0;
                }

                //=======================================================================================================
                //Висина на глава

                if ($p1->id_tower) {
                    $stolb_vig1 = (float) (optional($p1->tower)->vig ?? 0.0); // вис. јарем (ако ја имаш)
                } elseif ($p1->id_trafo) {
                    $stolb_vig1 = (float) (optional($p1->trafo)->visina_zj ?? 0.0);
                } else {
                    $stolb_vig1 = 0.0;
                }

                if ($p2->id_tower) {
                    $stolb_vig2 = (float) (optional($p2->tower)->vig ?? 0.0);
                } elseif ($p2->id_trafo) {
                    $stolb_vig2 = (float) (optional($p2->trafo)->visina_zj ?? 0.0);
                } else {
                    $stolb_vig2= 0.0;
                }

                //=======================================================================================================
                //Агол на столб
                $rawAgol1= null;
                if ($p1->id_tower) {
                    $rawAgol1 = optional($p1->tower)->angle;   // може да е null
                } elseif ($p1->id_trafo) {
                    $rawAgol1 = $p1->agol_tr;                  // може да е null/''
                }
                $stolb_agol1 = (float) ($rawAgol1 ?? 0.0);


                $rawAgol2 = null;
                if ($p2->id_tower) {
                    $rawAgol2 = optional($p2->tower)->angle;   // може да е null
                } elseif ($p2->id_trafo) {
                    $rawAgol2 = $p2->agol_tr;                  // може да е null/''
                }
                $stolb_agol2 = (float) ($rawAgol2 ?? 0.0);


                //=======================================================================================================
                // ПОДАТОЦИ ЗА ИЗОЛАТОР
                //Должина на изолаторска верига
                $insulator1_dolzi1    = (float) (optional($p1->insulator1)->length  ?? 0.0);
                $insulator1_dolzi2   = (float) (optional($p2->insulator1)->length  ?? 0.0);

                //Дали е потпорен 1=да. 0=не
                $insulator1_potp1  =  (int) (optional($p1->insulator1)->support_insulator ?? 0);
                $insulator1_potp2  =  (int) (optional($p2->insulator1)->support_insulator ?? 0);

                //$id_insulator_chain1  = (string) optional($p1->insulator1)->id_insulator_chain ?? '';
                //$id_insulator_chain2  = (string) optional($p2->insulator1)->id_insulator_chain ?? '';


                //=======================================================================================================
                // Распон, raspon
                $raspon = $stac_t2 - $stac_t1;


                //=======================================================================================================
                // Висина на проводник на столб 1, kota_pro
                if ($insulator1_potp1 == 1) {
                    $kota_pro1 = $kota_t1 + $stolb_vis1 + $insulator1_dolzi1;
                } elseif (abs($stolb_agol1) < 0.000001) {
                    $kota_pro1 = ($kota_t1 + $stolb_vis1) - $insulator1_dolzi1;
                } else {
                    $kota_pro1 = ($kota_t1 + $stolb_vis1);
                }
                if ($p1->id_trafo) {
                    $kota_pro1 = ($kota_t1 + $stolb_vis1);
                }

                //=======================================================================================================
                // Висина на заземјач на столб 1, kota_zaj
                if ($hasGround) {
                    $kota_zaj1 = $kota_t1 + $stolb_vis1 + $stolb_vig1;
                } else {
                    $kota_zaj1 = 0.0;
                }
                if ($p1->id_trafo) {
                    $kota_zaj1 = ($kota_t1 + $stolb_vig1);
                    //dd($kota_zaj1);
                }


                //=======================================================================================================
                //  Висина на проводник на столб 2, kota_pro
                if ($insulator1_potp2 == 1) {
                    $kota_pro2 = $kota_t2 + $stolb_vis2 + $insulator1_dolzi2;
                } elseif (abs($stolb_agol2) < 0.000001) {
                    $kota_pro2 = ($kota_t2 + $stolb_vis2) - $insulator1_dolzi2;
                } else {
                    $kota_pro2 = ($kota_t2 + $stolb_vis2);
                }
                if ($p2->id_trafo) {
                    $kota_pro2 = ($kota_t2 + $stolb_vis2);
                }

                //=======================================================================================================
                // Висина на заземјач на столб 2, kota_zaj
                if ($hasGround) {
                    $kota_zaj2 = $kota_t2 + $stolb_vis2 + $stolb_vig2;
                } else {
                    $kota_zaj2 = 0.0;
                }
                if ($p2->id_trafo) {
                    $kota_zaj2 = ($kota_t2 + $stolb_vig2);
                }

                //=======================================================================================================
                // Разлики во висини на проводник, vr_pro
                $vr_pro= $kota_pro2 - $kota_pro1;

                //=======================================================================================================
                // Разлики во висини на  заштитно јаже (заземјувач), vr_zaj
                $vr_zaj = $kota_zaj2 - $kota_zaj1;

                // dd($vr_zaj);
                //=======================================================================================================
                // Должини на проводник и заштитно јаже, dol_pro, dol_zaj

                // (користи sinh; масата е kg/km → во kg/m е $mas/1000) -----
                // формула од DOS: 2*1000*pres*nap * sinh( (L*mas) / (2*1000*pres*nap) ) / mas
                $dol_pro = 0.0;
                if ($conductors_cross_section && $tensile_stress_cond && $conductors_mass) {
                    $dol_pro = 2 * 1000 * $conductors_cross_section * $tensile_stress_cond *
                        sinh(($raspon * $conductors_mass) / (2 * 1000 * $conductors_cross_section * $tensile_stress_cond)) / $conductors_mass;
                }

                $dol_zaj = 0.0;
                if ($hasGround && $groundWires_cross_section && $tensile_stress_ground && $groundWires_mass) {
                    $dol_zaj = 2 * 1000 * $groundWires_cross_section * $tensile_stress_ground *
                        sinh(($raspon * $groundWires_mass) / (2 * 1000 * $groundWires_cross_section * $tensile_stress_ground)) / $groundWires_mass;
                }

                // ----- Запис во RASPRES -----
                \App\Models\Raspres::create([
                    'id_project' => $projectId,
                    'id_trasa' => $p1->id,
                    'stac_t'     => $stac_t1,           // како во DOS: ставаш stac_t на првата точка
                    'kota_t'     => $kota_t1,
                    'raspon'     => $raspon,
                    'vr_pro'     => $vr_pro,
                    'vr_zaj'     => $vr_zaj,
                    'kota_pro'   => $kota_pro1,
                    'kota_zaj'   => $kota_zaj1,

                    //ras_totp
                    //t2op
                    //totz
                    //t2oz

                    'dol_pro'    =>  $dol_pro,
                    'dol_zaj'    =>  $dol_zaj,
                ]);

                $inserted++;
            }

            return $inserted;
        });
    }
}
