<?php

namespace Modules\Projects\Repositories;

use App\Models\Projects;
use App\Models\Raspres;
use App\Models\Trasa;

class Zatpol
{
    public function zatpol(int $projectId): void
    {

        $project = Projects::with([
            'conductors',
            'groundWires',
            'insulatorChain',
        ])->findOrFail($projectId);


        $trasa = Trasa::with(['tower', 'insulator1', 'insulator2', 'trafo'])
            ->where('id_project', $projectId)
            ->where(function ($q) {
                $q->where(function ($q2) {
                    $q2->where('id_tower', '>', 0)
                        ->whereHas('tower', function ($t) {
                            $t->where('angle', '>', 0);
                        });
                })
                    ->orWhere('id_trafo', '>', 0);
            })
            ->orderBy('stac_t', 'asc')
            ->get();

        if ($trasa->isEmpty()) {
            return;
        }

        $brojPole = 1;

        for ($i = 0; $i + 1 < count($trasa); $i++) {
            $start = $trasa[$i];
            $end   = $trasa[$i + 1];

            $stacPo = (float) $start->stac_t;
            $stacKr = (float) $end->stac_t;

            $poId = (int) ($start->id_tower ?? 0);
            $krId = (int) ($end->id_tower ?? 0);

            $poleDol = $stacKr - $stacPo;
            if ($poleDol <= 0) {
                continue;
            }

            $pom_post = Raspres::where('id_project', $projectId)
                ->where('id_trasa', (int) $start->id)
                ->value('id');

            $pom_krst = Raspres::where('id_project', $projectId)
                ->where('id_trasa', (int) $end->id)
                ->value('id');

            if ($pom_krst === null) {
                $pom_krst = (int) Raspres::where('id_project', $projectId)->max('id') + 1;
            }

            if ($pom_post === null) {
                throw new \RuntimeException("Не можам да најдам RASPRES за trasa_id={$start->id}");
            }

            if ((int)$pom_krst <= (int)$pom_post) {
                throw new \RuntimeException("Невалиден опсег: pom_post={$pom_post}, pom_krst={$pom_krst}");
            }

            $aggr = Raspres::where('id_project', $projectId)
                ->where('id', '>=', (int)$pom_post)
                ->where('id', '<', (int)$pom_krst)
                ->selectRaw('SUM(POWER(raspon, 3)) as sum_tri')
                ->selectRaw('SUM((POWER(raspon,2) + POWER(vr_pro,2)) / NULLIF(raspon,0)) as sum_ede')
                ->first();

            $sumTri = (float) ($aggr->sum_tri ?? 0.0);
            $sumEde = (float) ($aggr->sum_ede ?? 0.0);

            $idRas = ($sumTri > 0 && $sumEde > 0) ? sqrt($sumTri / $sumEde) : null;

            $napPro = (float) ($start->nap_pro ?? $project->tensile_stress_cond);
            $napZaj = (float) ($start->nap_zaj ?? $project->tensile_stress_ground);
            $kndt   = (float) ($start->kndt ?? $project->kn);
            $kidt   = (float) ($start->kidt ?? $project->ki);
            $priv   = (float) ($start->priv ?? optional($project->windPressure)->title);

            \App\Models\Zatpol::create([
                'id_project' => $projectId,
                'po_stolb'   => $poId,
                'kr_stolb'   => $krId,
                'stac_po'    => $stacPo,
                'id_trasa_po'    => $start->id,
                'stac_kr'    => $stacKr,
                'id_trasa_kr'    => $end->id,
                'pole_dol'   => $poleDol,
                'nap_pro'    => $napPro,
                'nap_zaj'    => $napZaj,
                'kndt'       => $kndt,
                'kidt'       => $kidt,
                'priv'       => $priv,
                'id_raspon'  => $idRas,
            ]);
        }
    }
}
