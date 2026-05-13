<?php

namespace Modules\Projects\Repositories;

use App\Models\Gapres;
use App\Models\Projects;
use App\Models\Trasa;
use App\Models\Zatpol;
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
}
