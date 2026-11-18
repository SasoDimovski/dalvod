<?php

namespace Modules\Projects\Repositories;

use App\Models\Gapres;
use App\Models\Projects;
use App\Models\Trasa;
use App\Models\Zatpol;
use App\Models\Raspres;
use Illuminate\Support\Facades\DB;

class Controls
{
    public function kongras(int $projectId): array
    {
        $rows = Gapres::with(['trasa.tower', 'trasa.trafo'])
            ->where('id_project', $projectId)
            ->orderBy('br_stolb', 'asc')
            ->get()
            ->values();

        if ($rows->isEmpty()) {
            return [
                'count' => 0,
                'items' => [],
            ];
        }

        $brMinst = (int) ($rows->first()->br_stolb ?? 0);
        $brMaxst = (int) ($rows->last()->br_stolb ?? 0);

        $errors = [];

        foreach ($rows as $index => $row) {
            $procGv  = (float) ($row->proc_gv ?? 0);
            $grrVprk = (float) ($row->grr_vprk ?? 0);
            $stolAg1 = (int) ($row->stol_ag1 ?? 0);
            $brStolb = (int) ($row->br_stolb ?? 0);

            $isError =
                $procGv > 100 ||
                (
                    $grrVprk < 0 &&
                    $stolAg1 === 0 &&
                    $brStolb > $brMinst &&
                    $brStolb < $brMaxst
                );

            if ($isError) {
                $startTrasa = $row->trasa ?? null;

                // следен запис = крај на распонот
                $nextRow = $rows[$index + 1] ?? null;
                $endTrasa = $nextRow?->trasa;

                $errors[] = [

                    'raspon_br' => $brStolb . '-' . ($nextRow->br_stolb ?? $brStolb),

                    'start' => [
                        'br_stolb'   => (int) ($row->br_stolb ?? 0),
                        'id_trasa'   => (int) ($row->id_trasa ?? 0),
                        'stac_t'     => (float) ($startTrasa->stac_t ?? $row->stac_t ?? 0),
                        'tower_name' => $startTrasa ? (optional($startTrasa->tower)->name ?? optional($startTrasa->trafo)->ime ?? '') : '',
                    ],

                    'end' => [
                        'br_stolb'   => (int) ($nextRow->br_stolb ?? 0),
                        'id_trasa'   => (int) ($nextRow->id_trasa ?? 0),
                        'stac_t'     => (float) ($endTrasa->stac_t ?? $nextRow->stac_t ?? 0),
                        'tower_name' => $endTrasa ? (optional($endTrasa->tower)->name ?? optional($endTrasa->tower)->ime ?? '') : '',
                    ],

                    'proc_gv'    => $procGv,
                    'grr_vprk'   => $grrVprk,

                ];
            }
        }

        return [
            'count' => count($errors),
            'items' => $errors,
        ];
    }
    public function konelras(int $projectId): array
    {
        $project = Projects::find($projectId);

        $rows = Gapres::with(['trasa.tower', 'trasa.trafo'])
            ->where('id_project', $projectId)
            ->orderBy('stac_t', 'asc')
            ->get()
            ->values();

        if ($rows->count() < 2) {
            return [
                'count' => 0,
                'items' => [],
            ];
        }

        $hasGroundWire = !empty($project->id_ground_wires);

        $errors = [];

        for ($i = 0; $i < $rows->count() - 1; $i++) {
            $current = $rows[$i];
            $next    = $rows[$i + 1];

            $stacT  = (float) ($current->stac_t ?? 0);
            $raspon = (float) ($current->raspon ?? 0);

            $brStart = (int) ($current->br_stolb ?? 0);
            $brEnd   = (int) ($next->br_stolb ?? 0);


            $elrP2 = (float) ($current->elr_pro2 ?? 0);
            $elrZ2 = (float) ($current->elr_zaj2 ?? 0);

            $elrP1 = (float) ($next->elr_pro1 ?? 0);
            $elrZ1 = (float) ($next->elr_zaj1 ?? 0);

            // електричен распон меѓу два соседни столба
            $elRap = ($elrP2 + $elrP1) / 2;
            $elRaz = ($elrZ2 + $elrZ1) / 2;

            $isError = !$hasGroundWire
                ? ($elRap < $raspon)
                : ($elRap < $raspon || $elRaz < $raspon);

            if ($isError) {
                $startTrasa = $current->trasa;
                $endTrasa   = $next->trasa;

                $problem = [];

                if ($elRap < $raspon) {
                    $problem[] = 'Проводник';
                }

                if ($hasGroundWire && $elRaz < $raspon) {
                    $problem[] = 'Заштитно јаже';
                }

                $errors[] = [
                    'raspon_br' => $brStart . '-' . $brEnd,
                    'raspon'      => $raspon,


                    'start' => [
                        'br_stolb'   => $brStart,
                        'id_trasa'   => (int) ($current->id_trasa ?? 0),
                        'stac_t'     => (float) ($startTrasa->stac_t ?? $stacT),
                        'tower_name' => $startTrasa ? (optional($startTrasa->tower)->name ?? optional($startTrasa->trafo)->ime ?? '') : '',
                    ],

                    'end' => [
                        'br_stolb'   => $brEnd,
                        'id_trasa'   => (int) ($next->id_trasa ?? 0),
                        'stac_t'     => (float) ($endTrasa->stac_t ?? $next->stac_t ?? 0),
                        'tower_name' => $endTrasa ? (optional($endTrasa->tower)->name ?? optional($endTrasa->tower)->ime ?? '') : '',
                    ],

                    'el_raspro'   => $elRap,
                    'el_raszaj'   => $hasGroundWire ? $elRaz : null,
                    'has_zaj'     => $hasGroundWire,
                    'problem'     => implode(', ', $problem),

                ];
            }
        }

        return [
            'count' => count($errors),
            'items' => $errors,
        ];
    }


    public function konsrras(int $projectId): array
    {
        $rows = Gapres::with(['trasa.tower', 'trasa.trafo'])
            ->where('id_project', $projectId)
            ->orderBy('br_stolb', 'asc')
            ->get()
            ->values();

        if ($rows->isEmpty()) {
            return [
                'count' => 0,
                'items' => [],
            ];
        }

        $errors = [];

        foreach ($rows as $index => $row) {

            $brStolb = (int) ($row->br_stolb ?? 0);
            $sreRas = (float) ($row->sre_ras ?? 0);
            $srRasSt = (float) ($row->s_ra_st ?? 0);

            // Оригинална DOS формула
            $srRaz = abs($srRasSt) - abs($sreRas);

            $isError = $srRaz < 0 && $srRasSt != 0;

            if ($isError) {

                $startTrasa = $row->trasa;
                $nextRow = $rows[$index + 1] ?? null;
                $endTrasa = $nextRow?->trasa;

                $errors[] = [

                    'br_stolb' => $brStolb,

                    'raspon_br' => $brStolb . '-' .
                        ($nextRow->br_stolb ?? $brStolb),

                    'start' => [
                        'br_stolb' => $brStolb,
                        'id_trasa' => (int) ($row->id_trasa ?? 0),
                        'stac_t' => (float) (
                            $startTrasa->stac_t ?? $row->stac_t ?? 0
                        ),
                        'tower_name' => $startTrasa
                            ? (
                                optional($startTrasa->tower)->name
                                ?? optional($startTrasa->trafo)->ime
                                ?? ''
                            )
                            : '',
                    ],

                    'end' => [
                        'br_stolb' => (int) ($nextRow->br_stolb ?? 0),
                        'id_trasa' => (int) ($nextRow->id_trasa ?? 0),
                        'stac_t' => (float) (
                            $endTrasa->stac_t ?? $nextRow->stac_t ?? 0
                        ),
                        'tower_name' => $endTrasa
                            ? (
                                optional($endTrasa->tower)->name
                                ?? optional($endTrasa->trafo)->ime
                                ?? ''
                            )
                            : '',
                    ],

                    'sr_raspon' => $sreRas,
                    'sr_ras_st' => $srRasSt,
                    'sr_razlik' => $srRaz,
                ];
            }
        }

        return [
            'count' => count($errors),
            'items' => $errors,
        ];
    }


    public function konagot(int $projectId): array
    {
        $project = Projects::with([
            'voltages',
            'conductors',
        ])->findOrFail($projectId);


        $gapres = Gapres::with(['trasa.tower', 'trasa.trafo'])
            ->where('id_project', $projectId)
            ->orderBy('br_stolb', 'asc')
            ->get()
            ->values();


        $zatpol = Zatpol::where('id_project', $projectId)
            ->orderBy('id_trasa_po', 'asc')
            ->get()
            ->values();

        $angleData = [];
        $angleErrors = [];
        $bridgeData = [];
        $bridgeErrors = [];

        $nomNap = (float) ($project->voltages?->title ?? 0);
        $preseP = (float) ($project->conductors?->cross_section ?? 0);
        $masaP = (float) ($project->conductors?->mass ?? 0);
        $dijamP = (float) ($project->conductors?->diameter ?? 0);
        $brojPs = (int) ($project->num_cond_systems ?? 1);

        $izoTied = match ((int) $project->id_insulator_chain) {
            1 => 'STAK',
            2 => 'PORC',
            3 => 'SILK',
            default => null,
        };

        $sinD = static fn (float $v): float => sin(deg2rad($v));
        $atanD = static fn (float $v): float => rad2deg(atan($v));

        $acosD = static function (float $v): float {
            if ($v < -1 || $v > 1) {
                throw new \DomainException('Invalid acos argument: ' . $v);
            }
            return rad2deg(acos($v));
        };

        $asinD = static function (float $v): float {
            if ($v < -1 || $v > 1) {
                throw new \DomainException('Invalid asin argument: ' . $v);
            }
            return rad2deg(asin($v));
        };

        $safeDiv = static function (float $a, float $b): float {
            if (abs($b) < 1.0e-12) {
                throw new \DomainException('Division by zero in KONAGOT');
            }
            return $a / $b;
        };

        // DOS табела на сигурносни растојанија
        [$dSig1, $dSig2, $dlaMost] = match (true) {
            $nomNap > 1 && $nomNap <= 10  => [0.10, 0.07, 0.40],
            $nomNap <= 20 && $nomNap > 10 => [0.20, 0.07, 0.50],
            $nomNap <= 35 && $nomNap > 20 => [0.30, 0.10, 0.70],
            $nomNap <= 110 && $nomNap > 35 => [0.80, 0.30, 1.50],
            $nomNap <= 220 && $nomNap > 110 => [1.55, 0.55, 2.20],
            $nomNap <= 400 && $nomNap > 220 => [2.70, 0.90, 3.50],
            default => throw new \InvalidArgumentException(
                'Unsupported voltage: ' . $nomNap
            ),
        };

        foreach ($gapres as $index => $g) {

            $trasa = $g->trasa;
            if (!$trasa) {
                throw new \RuntimeException(
                    "Missing Trasa for Gapres ID {$g->id}"
                );
            }

            $tower = $trasa->tower;
            $insulator1 = $trasa->insulator1;
            $insulator2 = $trasa->insulator2;

            $stBr = (int) $g->br_stolb;
            $idTrasa = (int) $g->id_trasa;
            $stacSto = (float) $g->stac_t;

            $agoTra = (float) ($trasa->agol_tr ?? 0);
            $stoNap = (float) ($tower?->voltage ?? 0);
            $stoAg = (float) ($tower?->angle ?? 0);
            $stoVis = (float) ($tower?->vis ?? 0);
            $stoMhr = (float) ($tower?->mhr ?? 0);

            $izTip = (string) ($insulator1?->type ?? '');
            $izoM = (float) ($insulator1?->mass ?? 0);
            $izoD = (float) ($insulator1?->length ?? 0);
            $izoD1 = $izoD;
            $izoD2 = (float) ($insulator2?->length ?? 0);

            $isSupport = (int) ($insulator1?->support_insulator ?? 0) === 1;

            // Лево и десно затезно поле
            $zA = $zatpol->first(
                fn ($z) =>
                    (int) $z->id_trasa_po < $idTrasa
                    && (int) $z->id_trasa_kr >= $idTrasa
            );

            $zB = $zatpol->first(
                fn ($z) => (int) $z->id_trasa_po === $idTrasa
            );

            $zA ??= $zB;
            $zB ??= $zA;

            if (!$zA || !$zB) {
                throw new \RuntimeException(
                    "Missing Zatpol for tower {$stBr}"
                );
            }

            $pritVe1 = (float) $zA->priv;
            $pritVe2 = (float) $zB->priv;
            $nap401 = (float) $zA->napreg7_p;
            $nap402 = (float) $zB->napreg7_p;
            $tovp = (float) $zA->tovpro;

            $grVp = (float) ($g->grr_vpro ?? 0);
            $sreR = (float) ($g->sre_ras ?? 0);

            $ras1 = $index > 0
                ? (float) $gapres[$index - 1]->raspon : 0.0;
            $ras2 = (float) ($g->raspon ?? 0);

            $totR1 = $index > 0
                ? (float) $gapres[$index - 1]->ras_totp : 0.0;
            $totR2 = (float) ($g->ras_totp ?? 0);

            // -----------------------------------------
            // 1. Контрола на изолаторски вериги
            // -----------------------------------------

            if (!$isSupport
                && $stoAg <= 0
                && $stoNap > 0
                && !in_array($izTip, ['ENpot', 'DNpot'], true)
            ) {

                if ($izoD <= 0) {
                    throw new \RuntimeException(
                        "Invalid insulator length at tower {$stBr}"
                    );
                }

                $agPom = 0.0;

                if ($brojPs === 1) {
                    if ($nomNap <= 35) {
                        $agPom = match ($izoTied) {
                            'STAK', 'PORC' => 2.0,
                            'SILK' => 2.78,
                            default => 0.0,
                        };
                    } elseif ($nomNap == 110) {
                        if ($izoTied === 'STAK') {
                            $agPom = 3.28;
                        }
                        if (in_array($izTip, ['DNm', 'DNPm'], true)) {
                            $agPom = 6.76;
                        }
                    }
                } else {
                    $agPom = $atanD(0.25 / $izoD);
                }

                // Без insulators.sifra
                $koIz = str_starts_with($izTip, 'E') ? 0.1 : 0.2;

                $agKrit1 = $acosD($dSig1 / $izoD) - $agPom;
                $agKrit2 = $acosD($dSig2 / $izoD) - $agPom;

                $agKrit4 = ($stoMhr - $dSig1) > $izoD
                    ? $acosD($dSig1 / $izoD) - $agPom
                    : $asinD(($stoMhr - $dSig1) / $izoD) - $agPom;

                $agKrit3 = ($stoMhr - $dSig2) > $izoD
                    ? $acosD($dSig2 / $izoD) - $agPom
                    : $asinD(($stoMhr - $dSig2) / $izoD) - $agPom;

                $agKr1 = min($agKrit1, $agKrit4);
                $agKr2 = min($agKrit2, $agKrit3);

                $denominator = $grVp * $preseP * $brojPs
                    * $tovp + 0.5 * $izoM;

                $factor1 = $brojPs === 1 ? 0.15 : 0.15 * 0.5;
                $factor2 = $brojPs === 1 ? 0.7 : 0.5;

                $wind1 = $factor1 * $pritVe1 * $brojPs
                    * $dijamP * 0.001 * $sreR
                    + 0.5 * $pritVe1 * $koIz * $izoD;

                $wind2 = $factor2 * $pritVe1 * $brojPs
                    * $dijamP * 0.001 * $sreR
                    + 0.5 * $pritVe1 * $koIz * $izoD;

                $agOtkl1 = $atanD($safeDiv($wind1, $denominator));
                $agOtkl2 = $atanD($safeDiv($wind2, $denominator));

                $agOt1 = min($agOtkl1, 80.0);
                $agOt2 = min($agOtkl2, 85.0);

                // Го зачувуваме DOS условот за zab_ot1
                $zabOt1 = $agOtkl1 > $agKrit1;
                $zabOt2 = $agOt2 > $agKr2;

                $teTeg = 0.0;

                if ($zabOt2) {
                    $tanKrit = tan(deg2rad($agKrit2));

                    $teTeg = abs(
                        (
                            $safeDiv(
                                $sreR * $pritVe1 * $brojPs
                                * $dijamP * 0.001
                                + 0.5 * $pritVe1 * $koIz * $izoD,
                                $tanKrit
                            ) - $denominator
                        ) / 0.981
                    );
                }

                $item = [
                    'br_stolb' => $stBr,
                    'id_trasa' => $idTrasa,
                    'stac_t' => $stacSto,
                    'tower_name' => $tower?->type ?? '',
                    'agol_kr1' => $agKr1,
                    'agol_ot1' => $agOt1,
                    'zab_ot1' => $zabOt1,
                    'agol_kr2' => $agKr2,
                    'agol_ot2' => $agOt2,
                    'zab_ot2' => $zabOt2,
                    'tez_teg' => $teTeg,
                ];

                $angleData[] = $item;

                // Финалниот DOS LOCATE користи зачувани агли
                if ($agOt1 > $agKr1 || $agOt2 > $agKr2) {
                    $angleErrors[] = $item;
                }
            }

            // -----------------------------------------
            // 2. Контрола на струјни мостови
            // -----------------------------------------

            if (!$isSupport && ($stoAg > 0 || $stoNap == 0)) {

                if ($masaP <= 0) {
                    throw new \RuntimeException(
                        'Invalid conductor mass'
                    );
                }

                $bridgeAngle = static function (
                    float $ras,
                    float $wind,
                    float $height
                ) use ($masaP, $atanD): float {

                    $factor = $ras < 200
                        ? 0.75
                        : 0.45 + 60 / $ras;

                    return $atanD(
                        $factor * 0.58
                        * (10 * $wind + 3 * $height)
                        / (0.981 * $masaP)
                    );
                };

                $agOtr1 = $bridgeAngle($ras1, $pritVe1, $stoVis);
                $agOtr2 = $bridgeAngle($ras2, $pritVe2, $stoVis);
                $agOtr = ($agOtr1 + $agOtr2) / 2;

                $dsigH1 = $izoD1 * $sinD($agoTra / 2);
                $dsigH2 = $izoD2 * $sinD($agoTra / 2);
                $dsigH = ($dsigH1 + $dsigH2) / 2;

                $fpOt1 = $safeDiv(
                    $izoD1 * $tovp * ($totR1 - $izoD1),
                    2 * $nap401
                );

                $fpOt2 = $safeDiv(
                    $izoD2 * $tovp * ($totR2 - $izoD2),
                    2 * $nap402
                );

                $fpOt = ($fpOt1 + $fpOt2) / 2;
                $dotkH = $fpOt * $sinD($agOtr);

                $rastSig = $stoMhr - (
                        $dsigH + $dotkH
                        + ($dlaMost - $fpOt) * $sinD(30)
                    );

                $bridgeData[] = [
                    'br_stolb' => $stBr,
                    'id_trasa' => $idTrasa,
                    'stac_t' => $stacSto,
                    'tower_name' => $tower?->type ?? '',
                    'agol_tr' => $agoTra,
                    'sig_rh1' => $dsigH,
                    'sig_rv2' => $fpOt,
                    'agol_pr' => $agOtr,
                    'sig_rh2' => $dotkH,
                    'ras_pres' => $rastSig,
                    'ras_sig2' => $dSig2,
                    'zab_ras' => false,
                ];
            }
        }

        // DOS ги исклучува првиот и последниот
        // запис од проверката на струјните мостови.
        $last = count($bridgeData) - 1;

        foreach ($bridgeData as $index => &$item) {
            if ($index === 0 || $index === $last) {
                $item['ras_pres'] = 0.0;
                $item['ras_sig2'] = 0.0;
                continue;
            }

            $item['zab_ras'] =
                $item['ras_pres'] < $item['ras_sig2'];

            if ($item['zab_ras']) {
                $bridgeErrors[] = $item;
            }
        }
        unset($item);

        return [
            'count' => count($angleErrors) + count($bridgeErrors),
            'angles' => [
                'count' => count($angleErrors),
                'items' => $angleErrors,
                'data' => $angleData,
            ],
            'bridges' => [
                'count' => count($bridgeErrors),
                'items' => $bridgeErrors,
                'data' => $bridgeData,
            ],
        ];
    }
    public function konvis(int $projectId): array
    {
        $project = Projects::with(['conductors'])->findOrFail($projectId);

        $trasa = Trasa::where('id_project', $projectId)
            ->orderBy('stac_t')
            ->get()
            ->values();

        $gapres = Gapres::where('id_project', $projectId)
            ->orderBy('stac_t')
            ->get()
            ->values();

        $raspres = Raspres::where('id_project', $projectId)
            ->orderBy('stac_t')
            ->get()
            ->values();

        $zatpol = Zatpol::where('id_project', $projectId)
            ->orderBy('stac_kr')
            ->get()
            ->values();

        $errors = [];

        if ($trasa->count() < 2 || $gapres->count() < 2) {
            throw new \DomainException(
                'KONVIS: Недоволно точки во Trasa или Gapres.'
            );
        }

        if ($project->minimum_safety_clearance === null) {
            throw new \DomainException(
                'KONVIS: Не е внесена минималната сигурносна висина.'
            );
        }

        if (!$project->conductors) {
            throw new \DomainException(
                'KONVIS: Не е пронајден спроводникот.'
            );
        }

        $sigVisP1 = (float) $project->minimum_safety_clearance;

        $nadTemp1 = $project->overtemperature !== null
            ? (int) $project->overtemperature
            : null;

        $hasGround = (int) ($project->num_ground_wires ?? 0) > 0;

        $proMod = (float) $project->conductors->model;
        $proTem = (float) $project->conductors->temp_exp_coeff;

        if ($nadTemp1 !== null
            && $nadTemp1 > 40
            && !in_array($nadTemp1, [50, 60, 70, 80, 90, 100], true)
        ) {
            throw new \DomainException(
                "KONVIS: Неподдржана надтемпература {$nadTemp1}."
            );
        }

        // Подготовка на напрегањата само еднаш за секое затезно поле
        $tensionsCache = [];

        if ($nadTemp1 !== null && $nadTemp1 > 40) {
            foreach ($zatpol as $z) {
                $tensionsCache[$z->id] = $this->calculateAdditionalTensions(
                    $z,
                    $proMod,
                    $proTem
                );
            }
        }

        $stacMini = (float) $trasa->first()->stac_t;
        $stacMaxi = (float) $trasa->last()->stac_t;

        $trasaIndex = 1;
        $gapresIndex = 1;

        // DOS: stac_me = stac_mini; stac_me = stac_me + 1
        for (
            $stacMe = $stacMini;
            $stacMe <= $stacMaxi;
            $stacMe += 1.0
        ) {

            /*
             * 1. Интерполација на котата на теренот
             */

            while (
                $trasaIndex < $trasa->count() - 1
                && (float) $trasa[$trasaIndex]->stac_t < $stacMe
            ) {
                $trasaIndex++;
            }

            $t1 = $trasa[$trasaIndex - 1];
            $t2 = $trasa[$trasaIndex];

            $stac1 = (float) $t1->stac_t;
            $stac2 = (float) $t2->stac_t;

            if ($stac2 <= $stac1) {
                throw new \DomainException(
                    "KONVIS: Невалидни стационажи во Trasa: {$stac1} - {$stac2}."
                );
            }

            $kotaMe = (float) $t1->kota_t
                + (
                    ((float) $t2->kota_t - (float) $t1->kota_t)
                    * ($stacMe - $stac1)
                    / ($stac2 - $stac1)
                );

            /*
             * 2. Наоѓање на распонот помеѓу два столба
             */

            while (
                $gapresIndex < $gapres->count() - 1
                && (float) $gapres[$gapresIndex]->stac_t < $stacMe
            ) {
                $gapresIndex++;
            }

            $g1 = $gapres[$gapresIndex - 1];
            $g2 = $gapres[$gapresIndex];

            $stacSt1 = (float) $g1->stac_t;
            $stacSt2 = (float) $g2->stac_t;

            $spanLength = $stacSt2 - $stacSt1;

            if ($spanLength <= 0) {
                throw new \DomainException(
                    "KONVIS: Невалиден распон {$stacSt1} - {$stacSt2}."
                );
            }

            /*
             * 3. Raspres за почетниот столб
             */

            $r = $raspres->first(
                fn ($row) =>
                    abs((float) $row->stac_t - $stacSt1) < 0.000001
            );

            if (!$r) {
                throw new \DomainException(
                    "KONVIS: Недостасува Raspres за стационажа {$stacSt1}."
                );
            }

            $rasp = (float) $r->raspon;
            $virp = (float) $r->vr_pro;
            $virz = (float) $r->vr_zaj;

            if ($rasp <= 0) {
                throw new \DomainException(
                    "KONVIS: Невалиден raspon за стационажа {$stacSt1}."
                );
            }

            /*
             * 4. Затезно поле
             */

            $z = $zatpol->first(
                fn ($row) =>
                    (float) $row->stac_po <= $stacMe
                    && (float) $row->stac_kr >= $stacMe
            );

            if (!$z) {
                throw new \DomainException(
                    "KONVIS: Не е пронајдено затезно поле за {$stacMe}."
                );
            }

            $tovp = (float) $z->tovpro;
            $tovp1 = (float) $z->tovpro_1;
            $tovz = (float) $z->tovzaj;

            $napPr1 = (float) $z->napreg8_p;
            $napPr2 = (float) $z->napreg7_p;
            $napZj = (float) $z->napreg1_z;

            /*
             * 5. Надтемпература
             */

            if ($nadTemp1 !== null && $nadTemp1 > 40) {
                $napPr2 = $tensionsCache[$z->id][$nadTemp1];
            }

            if ($napPr1 <= 0 || $napPr2 <= 0) {
                throw new \DomainException(
                    "KONVIS: Невалидно напрегање за стационажа {$stacMe}."
                );
            }

            /*
             * 6. Пресметка на висината на спроводникот
             */

            $x = $stacMe - $stacSt1;

            $kotaOp1 = (float) $g1->kota_pro;
            $kotaOp2 = (float) $g2->kota_pro;

            $linePro = $kotaOp1
                + ($kotaOp2 - $kotaOp1) * $x / $spanLength;

            $factorPro = $rasp / sqrt($rasp ** 2 + $virp ** 2);

            // Прва состојба
            $visPro1 = $linePro
                - (
                    $x * ($rasp - $x) * $tovp1
                ) / (
                    2 * $napPr1 * $factorPro
                )
                - $kotaMe;

            // Втора состојба
            $visPro2 = $linePro
                - (
                    $x * ($rasp - $x) * $tovp
                ) / (
                    2 * $napPr2 * $factorPro
                )
                - $kotaMe;

            $minvisP = min($visPro1, $visPro2);

            /*
             * 7. Висина на заштитното јаже
             */

            $visZaj = 0.0;

            if ($hasGround) {

                if ($napZj <= 0) {
                    throw new \DomainException(
                        "KONVIS: Невалидно напрегање на заштитното јаже."
                    );
                }

                $kotaOz1 = (float) $g1->kota_zaj;
                $kotaOz2 = (float) $g2->kota_zaj;

                $lineZaj = $kotaOz1
                    + ($kotaOz2 - $kotaOz1) * $x / $spanLength;

                $factorZaj = $rasp / sqrt($rasp ** 2 + $virz ** 2);

                $visZaj = $lineZaj
                    - (
                        $x * ($rasp - $x) * $tovz
                    ) / (
                        2 * $napZj * $factorZaj
                    )
                    - $kotaMe;
            }

            /*
             * 8. Контрола на минималната сигурносна висина
             */

            if ($minvisP < $sigVisP1) {

                $errors[] = [
                    'br_raspon' => $g1->br_stolb . '-' . $g2->br_stolb,
                    'stac_ter' => $stacMe,
                    'kota_ter' => $kotaMe,
                    'visina_p' => $minvisP,
                    'visina_zj' => $visZaj,
                    'razlika_v' => $sigVisP1 - $minvisP,
                    'vis_pro1' => $visPro1,
                    'vis_pro2' => $visPro2,
                ];
            }
        }

        return [
            'count' => count($errors),
            'items' => $errors,
        ];
    }

    private function calculateAdditionalTensions(
        Zatpol $z,
        float $proMod,
        float $proTem
    ): array {

        $idRas = (float) $z->id_raspon;
        $kritRas = (float) $z->krit_ra_p;
        $napP = (float) $z->nap_pro;

        $tovp = (float) $z->tovpro;
        $tovp1 = (float) $z->tovpro_1;

        if ($napP <= 0 || $idRas <= 0 || $proMod <= 0) {
            throw new \DomainException(
                'NAPREG_2: Невалидни параметри за пресметка.'
            );
        }

        $N = ($tovp ** 2 * $idRas ** 2 * $proMod) / 24;

        $results = [];

        foreach ([15, 50, 60, 70, 80, 90, 100] as $temp) {

            if ($idRas > $kritRas) {

                $M = ($tovp1 ** 2 * $idRas ** 2 * $proMod)
                    / (24 * $napP ** 2)
                    + $proTem * $proMod * ($temp + 5)
                    - $napP;

            } else {

                $M = ($tovp ** 2 * $idRas ** 2 * $proMod)
                    / (24 * $napP ** 2)
                    + $proTem * $proMod * ($temp + 20)
                    - $napP;
            }

            $results[$temp] = $this->solveNapregNewton(
                $N,
                $M,
                0.1,
                0.001
            );
        }

        return $results;
    }
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
