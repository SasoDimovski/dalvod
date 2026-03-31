<?php

namespace Modules\Projects\Repositories;

use App\Models\Projects;
use App\Models\Raspres;
use App\Models\Trasa;
use App\Models\Zatpol;
use Illuminate\Support\Facades\DB;

class Rastotal
{
    public function rastotal(int $projectId): int
    {
        return DB::transaction(function () use ($projectId) {

            $project = Projects::with([
                'conductors',
                'groundWires',
                'insulatorChain',
            ])->findOrFail($projectId);

            $hasGround = (int) ($project->num_ground_wires ?? 0) > 0;

            // 1) сите точки од траса, по редослед
            $allTrasa = Trasa::where('id_project', $projectId)
                ->where(function ($q) {
                    $q->where('id_tower', '>', 0)
                        ->orWhere('id_trafo', '>', 0);
                })
                ->orderBy('stac_t', 'asc')
                ->get(['id', 'stac_t']);

            if ($allTrasa->isEmpty()) {
                return 0;
            }

            // map: trasa_id => ordered index
            $trasaIndexMap = [];
            foreach ($allTrasa as $idx => $t) {
                $trasaIndexMap[(int) $t->id] = $idx;
            }

            // 2) затезни полиња
            $poles = Zatpol::where('id_project', $projectId)
                ->orderBy('id', 'asc')
                ->get([
                    'id',
                    'id_trasa_po',
                    'id_trasa_kr',
                    'tovpro',
                    'tovpro_1',
                    'tovzaj',
                    'tovzaj_1',
                    'napreg1_p',
                    'napreg8_p',
                    'napreg1_z',
                    'napreg8_z',
                ]);

            if ($poles->isEmpty()) {
                return 0;
            }

            // 3) однапред пресметај boundary index за секое поле
            $preparedPoles = $poles->map(function ($pole) use ($trasaIndexMap) {
                $po = (int) ($pole->id_trasa_po ?? 0);
                $kr = (int) ($pole->id_trasa_kr ?? 0);

                $pole->start_idx = $trasaIndexMap[$po] ?? null;
                $pole->end_idx   = $trasaIndexMap[$kr] ?? null;

                return $pole;
            })->filter(fn ($pole) => $pole->start_idx !== null && $pole->end_idx !== null && $pole->end_idx > $pole->start_idx);

            if ($preparedPoles->isEmpty()) {
                return 0;
            }

            // 4) сите raspres редови
            $rows = Raspres::where('id_project', $projectId)
                ->orderBy('stac_t', 'asc')
                ->get(['id', 'id_trasa', 'raspon', 'vr_pro', 'vr_zaj']);

            $updated = 0;

            foreach ($rows as $r) {
                $trasaId = (int) ($r->id_trasa ?? 0);
                $rasp    = (float) ($r->raspon ?? 0.0);

                if (!$trasaId || $rasp == 0.0) {
                    continue;
                }

                $rowIdx = $trasaIndexMap[$trasaId] ?? null;
                if ($rowIdx === null) {
                    continue;
                }

                // најди поле на кое му припаѓа овој raspres ред
                $pole = $preparedPoles->first(function ($p) use ($rowIdx) {
                    return $rowIdx >= $p->start_idx && $rowIdx < $p->end_idx;
                });

                if (!$pole) {
                    continue;
                }

                $napP1 = (float) ($pole->napreg1_p ?? 0.0);
                $napP8 = (float) ($pole->napreg8_p ?? 0.0);
                $napZ1 = (float) ($pole->napreg1_z ?? 0.0);
                $napZ8 = (float) ($pole->napreg8_z ?? 0.0);

                $tovp   = (float) ($pole->tovpro   ?? 0.0);
                $tovp_1 = (float) ($pole->tovpro_1 ?? 0.0);
                $tovz   = (float) ($pole->tovzaj   ?? 0.0);
                $tovz_1 = (float) ($pole->tovzaj_1 ?? 0.0);

                $tovp   = ($tovp   == 0.0) ? 1e-12 : $tovp;
                $tovp_1 = ($tovp_1 == 0.0) ? 1e-12 : $tovp_1;
                $tovz   = ($tovz   == 0.0) ? 1e-12 : $tovz;
                $tovz_1 = ($tovz_1 == 0.0) ? 1e-12 : $tovz_1;

                $virp = (float) ($r->vr_pro ?? 0.0);
                $virz = (float) ($r->vr_zaj ?? 0.0);

                $ras_totp = $rasp + (2.0 * $napP8 * abs($virp)) / ($rasp * $tovp_1);
                $ras_t20p = $rasp + (2.0 * $napP1 * abs($virp)) / ($rasp * $tovp);

                if (!$hasGround) {
                    $ras_totz = 0.0;
                    $ras_t20z = 0.0;
                } else {
                    $ras_totz = $rasp + (2.0 * $napZ8 * abs($virz)) / ($rasp * $tovz_1);
                    $ras_t20z = $rasp + (2.0 * $napZ1 * abs($virz)) / ($rasp * $tovz);
                }

                Raspres::where('id', (int) $r->id)->update([
                    'ras_totp' => $ras_totp,
                    'ras_t2op' => $ras_t20p,
                    'ras_totz' => $ras_totz,
                    'ras_t2oz' => $ras_t20z,
                ]);

                $updated++;
            }

            return $updated;
        });
    }
}
