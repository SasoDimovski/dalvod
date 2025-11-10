<?php

namespace Modules\Projects\Repositories;


use App\Models\Conductors;
use App\Models\Endpoints;
use App\Models\GroundWires;
use App\Models\InsulatorChain;
use App\Models\Izolam;
use App\Models\Projects;
use App\Models\Raspres;
use App\Models\Stolb;
use App\Models\Trafo;
use App\Models\Trasa;
use App\Models\Users;
use App\Models\Voltages;
use App\Models\WindPressure;
use App\Models\Zatpol;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Projects\Dto\ProjectsDto;

class ProjectsRepositories
{
    public function getAllProjects($params): \Illuminate\Pagination\LengthAwarePaginator

    {
        $query = Projects::query()
            ->with([
                'voltages',
                'conductors',
                'groundWires',
                'startingPoint',
                'endingPoint',
                'windPressure',
                'insulatorChain',
            ])
            ->where('projects.deleted', 0);

        // LIKE filters
        $likeFilters = ['id', 'title', 'id_conductor', 'id_ground_wires'];
        foreach ($likeFilters as $field) {
            if (!empty($params[$field])) {
                $query->where("projects.$field", 'like', '%' . $params[$field] . '%');
            }
        }

        // EXACT match filters
        $exactFilters = ['id_voltage'];
        foreach ($exactFilters as $field) {
            if (!empty($params[$field])) {
                $query->where($field, $params[$field]);
            }
        }

        // ACTIVE / DEACTIVATED filter
        $active = !empty($params['active']);
        $deactivated = !empty($params['deactivated']);

        if ($active && !$deactivated) {
            $query->where('active', 1);
        } elseif (!$active && $deactivated) {
            $query->where('active', 0);
        }

        // Sort handling
        $sortField = $params['order'] ?? 'id';
        $sortDirection = $params['sort'] ?? 'DESC';

        if ($sortField === 'id_voltage') {
            $query->leftJoin('voltages', 'voltages.id', '=', 'projects.id_voltage')
                ->orderBy('voltages.title', $sortDirection)
                ->select('projects.*');
        } elseif ($sortField === 'id_conductor') {
            $query->leftJoin('conductors', 'conductors.id', '=', 'projects.id_conductor')
                ->orderBy('conductors.type', $sortDirection)
                ->select('projects.*');
        } elseif ($sortField === 'id_ground_wires') {
            $query->leftJoin('ground_wires', 'ground_wires.id', '=', 'projects.id_ground_wires')
                ->orderBy('ground_wires.type', $sortDirection)
                ->select('projects.*');
        } else {
            $query->orderBy($sortField, $sortDirection);
        }

        // Pagination
        $listing = $params['listing'] ?? config('projects.pagination');
        if ($listing === 'a') {
            $listing = $query->count();
        }

        return $query->paginate($listing);
    }

    public function storeProject($projectsDto)
    {
        $project= Projects::create([
            'title' => $projectsDto->title,
            'id_voltage' => $projectsDto->id_voltage,
            'id_starting_point' => $projectsDto->id_starting_point,
            'id_ending_point' => $projectsDto->id_ending_point,
            'id_conductor' => $projectsDto->id_conductor,
            'id_ground_wires' => $projectsDto->id_ground_wires,
            'id_ground_wires2' => $projectsDto->id_ground_wires2,
            'tensile_stress_cond' => $projectsDto->tensile_stress_cond,
            'tensile_stress_ground' => $projectsDto->tensile_stress_ground,
            'tensile_stress_ground2' => $projectsDto->tensile_stress_ground2,
            'kn' => $projectsDto->kn,
            'ki' => $projectsDto->ki,
            'id_wind_pressure' => $projectsDto->id_wind_pressure,
            'id_insulator_chain' => $projectsDto->id_insulator_chain,
            'num_cond_systems' => $projectsDto->num_cond_systems,
            'num_cond_bundle' => $projectsDto->num_cond_bundle,
            'num_ground_wires' => $projectsDto->num_ground_wires,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
            'active' => $projectsDto->active,
            'deleted' => 0,
        ]);
        return $project;

    }
    public function createTrafo($id_project)
    {
        $trafo= Trafo::create([
            'id_project' => $id_project,
        ]);
        return $trafo;

    }

    public function storePoint($request)
    {
        $point = Trasa::create([
            'id_project' => $request->id,
            'stac_t'     => $request->stac_t,
            'kota_t'     => $request->kota_t,
            'agol_tr'    => $request->agol_tr,
            'id_stolb'   => $request->id_stolb ?: null,
            'id_izolam1' => $request->id_izolam1 ?: null,
            'id_izolam2' => $request->id_izolam2 ?: null,
        ]);

        return $point;
    }
    public function createEndpoints($id_project, $point, $id_trafo)
    {
        $project = Trasa::create([
            'id_project' => $id_project,
            'id_trafo' => $point == 1 ? $id_trafo : null,
        ]);

        return $project;
    }
    public function updateProject($id, ProjectsDto $data)
    {
        $project = Projects::where('id', '=', $id)->first();

        //dd($data->id_starting_point);

        if($project) {
            $project->title = $data->title;
            //$project->id_voltage = $data->id_voltage;
            $project->id_starting_point = $data->id_starting_point;
            $project->id_ending_point = $data->id_ending_point;
            $project->id_conductor = $data->id_conductor;
            $project->id_ground_wires = $data->id_ground_wires;
            $project->id_ground_wires2 = $data->id_ground_wires2;
            $project->tensile_stress_cond = $data->tensile_stress_cond;
            $project->tensile_stress_ground = $data->tensile_stress_ground;
            $project->tensile_stress_ground2 = $data->tensile_stress_ground2;
            $project->kn = $data->kn;
            $project->ki = $data->ki;
            $project->id_wind_pressure = $data->id_wind_pressure;
            $project->id_insulator_chain = $data->id_insulator_chain;
            $project->num_cond_systems = $data->num_cond_systems;
            $project->num_cond_bundle = $data->num_cond_bundle;
            $project->num_ground_wires = $data->num_ground_wires;
            $project->updated_by = Auth::id();
            $project->active = $data->active;

            if ($project->save()) {
                return $project;
            }
        }
        return null;
    }

    public function resetTrasa(int $projectId,  $id_trafo): ?Trasa
    {
        $trasa = Trasa::where('id_project', $projectId)->first();

        if (!$trasa) {
            return null;
        }

        $trasa->update([
            'stac_t'     => null,
            'kota_t'     => null,
            'agol_tr'    => null,
            'id_stolb'   => null,
            'id_trafo'   => $id_trafo,
            'id_izolam1' => null,
            'id_izolam2' => null,
        ]);

        return $trasa;
    }

    public function resetTrasaLatest(int $projectId, $id_trafo): ?Trasa
    {
        $trasa = Trasa::where('id_project', $projectId)
            ->orderBy('id', 'asc')
            ->skip(1)
            ->first();

        if (!$trasa) {
            return null;
        }

        $trasa->update([
            'stac_t'     => null,
            'kota_t'     => null,
            'agol_tr'    => null,
            'id_stolb'   => null,
            'id_trafo'   => $id_trafo,
            'id_izolam1' => null,
            'id_izolam2' => null,
        ]);

        return $trasa;
    }

    public function deleteTrafotById(int $projectId, int $id_trafo): ?Trasa
    {
        $trasa = Trasa::where('id_project', $projectId)->first();

        if (!$trasa) {
            return null;
        }

        $trasa->update([

            'id_trafo'   => null,

        ]);

        return $trasa;
    }

    public function deleteTrafo($id_project)
    {
        $trafo = Trafo::where('id_project', $id_project)->first();

        if (!$trafo) {
            return null; // нема trafo за тој проект
        }

        return $trafo->delete();
    }
    public function deleteTrafoLatest($id_project)
    {
        $trafo = Trafo::where('id_project', $id_project)->latest()->first();

        if (!$trafo) {
            return null; // нема trafo за тој проект
        }

        return $trafo->delete();
    }

    public function deleteProject($id)
    {
        $return = $this->getProjectById($id);
        if(!$return) {
            return null;
        }
        $return =Projects::where('id', '=', $id)->delete();
        if(!$return) {
            return null;
//          $users->deleted = 1;
//          return $users->save();
        }
        return $return;
    }

    public function deletePoint($id)
    {

        $return =Trasa::where('id', '=', $id)->delete();
        if(!$return) {
            return null;
//          $users->deleted = 1;
//          return $users->save();
        }
        return $return;
    }

    public function getAllVoltages()
    {
        return Voltages::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }

    public function getAllConductors()
    {
        return Conductors::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }

    public function getAllGroundWires()
    {
        return GroundWires::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }
    public function getAllEndpoints()
    {
        return Endpoints::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }

    public function getAllWindPressure()
    {
        return WindPressure::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }

    public function getAllInsulatorChain()
    {
        return InsulatorChain::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }
    public function getAllIzolam()
    {
        return Izolam::orderBy('napon', 'asc')->get();
    }

    public function getAllStolb($id_project)
    {
        // земи го избраниот напон (ID) од проектот
        $projectVoltageId = Projects::whereKey($id_project)->value('id_voltage');

        if (!$projectVoltageId) {
            // ако проектот нема зададен напон → врати ги сите (или празно, по желба)
            return Stolb::orderBy('nap')->orderBy('tip')->get();
        }

        //dd($projectVoltageId);
        // земи ја НУМЕРИЧКАТА вредност на напонот во kV (приспособи го името на колоната!)
        $kv = Voltages::whereKey($projectVoltageId)->value('title'); // <— СМЕНИ во твоето име на колона (на пр. 'value', 'kv_value', ...)
       // dd($kv);


        //$kvRaw = $kv ?? null; // од каде и да ти доаѓа
        //$kvNum = $kvRaw !== null ? (float) preg_replace('/[^\d.]/', '', (string) $kvRaw) : null;

        if ($kv === null) {
            return Stolb::orderBy('nap')->orderBy('tip')->get();
        }


//        dd([
//            'kvRaw' => $kvRaw,
//            'kvNum' => $kvNum,
//            'type'  => gettype($kvNum),
//            'countNapEq' => Stolb::where('nap', '=', $kvNum)->count(),
//            'someEq' => Stolb::where('nap', '=', $kvNum)->limit(3)->pluck('nap','id'),
//            'minMax' => Stolb::selectRaw('MIN(nap) as min_nap, MAX(nap) as max_nap')->first(),
//        ]);

        // врати столбови со напон >= проектскиот напон
        return Stolb::where('nap', '>=', $kv)
            ->orderBy('nap')
            ->orderBy('tip')
            ->get();
    }

    public function getProjectById($id)
    {
        $return = Projects::where('id', '=', $id)
            ->with([
                'voltages',
                'conductors',
                'groundWires',
                'startingPoint',
                'endingPoint',
                'windPressure',
                'insulatorChain',
            ])->first();
        if ($return) {
            return $return;
        }
        return null;
    }
    public function getTrafoByIdProject($id_project)
    {
        $return = Trafo::where('id_project', '=', $id_project)->first();
        if ($return) {
            return $return;
        }
        return null;
    }

    public function getTrasaByIdProject($id_project): \Illuminate\Database\Eloquent\Collection
    {
        return Trasa::with(['trafo'])
            ->with(['stolb'])
            ->with(['izolam1'])
            ->with(['izolam2'])
            ->where('id_project', $id_project)
            ->orderByRaw('CAST(stac_t AS UNSIGNED) ASC')
            ->get();
    }
    public function getRaspresByIdProject($id_project): \Illuminate\Database\Eloquent\Collection
    {
        return Raspres::with(['project'])
            ->where('raspres.id_project', $id_project)
            ->get();
    }
    public function getZatpolByIdProject($id_project): \Illuminate\Database\Eloquent\Collection
    {
        return Zatpol::with(['project'])
            ->where('zatpol.id_project', $id_project)
            ->get();
    }
    public function firstTwoIds($id_project)
    {
        return Trasa::where('id_project', $id_project)
            ->orderBy('id', 'asc')
            ->take(2)
            ->pluck('id')
            ->toArray();
    }
    public function getTrasaByIdProjectTopTwo($id_project): \Illuminate\Database\Eloquent\Collection
    {
        return Trasa::with(['trafo'])
            ->with(['stolb'])
            ->with(['izolam1'])
            ->with(['izolam2'])
            ->where('id_project', $id_project)
            ->orderBy('id', 'asc')->take(2)->get();
    }

    public function getUserById($id)
    {
        $return= Users::where('id', '=', $id)->first();
        if ($return){
            return $return;
        }
        return null;
    }

    public function updateEndPoints(int $projectId, array $payload): bool
    {
        return DB::transaction(function () use ($projectId, $payload) {

// 1) TRASA
            foreach ((array) data_get($payload, 'trasa', []) as $trasaId => $data) {

                // нормализација
                $id_izolam1 = data_get($data, 'id_izolam1');
                $id_stolb = data_get($data, 'id_stolb');
                if ($id_izolam1 === '' || $id_izolam1 === null) {
                    $id_izolam1 = null;
                }
                if ($id_stolb === '' || $id_stolb === null) {
                    $id_stolb = null;
                }
                $trasaUpdate = [
                    'stac_t'     => data_get($data, 'stac_t'),
                    'kota_t'     => data_get($data, 'kota_t'),
                    'agol_tr'    => data_get($data, 'agol_tr'),
                    'id_stolb'   => $id_stolb,
                    'id_izolam1' => $id_izolam1,
                ];

                // овде НЕ користиме array_filter, бидејќи сакаме null да се сними
                Trasa::where('id', $trasaId)
                    ->where('id_project', $projectId)
                    ->update($trasaUpdate);
            }

            // 2) TRAFO
            foreach ((array) data_get($payload, 'trafo', []) as $trafoId => $data) {

                $trafoUpdate = array_filter([
                    'ime'       => data_get($data, 'ime'),
                    'visna_p'   => data_get($data, 'visna_p'),
                    'visina_zj' => data_get($data, 'visina_zj'),
                    'hor_ras'   => data_get($data, 'hor_ras'),
                ], fn($v) => !is_null($v));

                if (!empty($trafoUpdate)) {
                    // Обезбеди дека trafo припаѓа на истиот проект
                    Trafo::where('id', $trafoId)
                        ->where('id_project', $projectId)
                        ->update($trafoUpdate);
                }
            }

            return true;
        });
    }

    public function raspres(int $projectId): int
    {
        return DB::transaction(function () use ($projectId) {

            $project = Projects::with([
                'conductors',
                'groundWires',
                'insulatorChain',
            ])->findOrFail($projectId);

            // ----- Параметри од проект -----
            // Напони на затегање (N/mm2) – ги користиш веќе
            $nap_p = (float) ($project->tensile_stress_cond ?? 0);   // проводник
            $nap_z = (float) ($project->tensile_stress_ground ?? 0); // заземјач

            // Колку заземјачи има (ако 0 → "---")
            $hasGround = (int) ($project->num_ground_wires ?? 0) > 0;

            // Тип на сврзување (POTP / SILK / …) – прилагоди по својата шема
            $izo_tied = optional($project->insulatorChain)->type ?? 'POTP';

            // Проводник: пресек (mm2) и маса (kg/km)
            $pro_pres = (float) optional($project->conductors)->cross_section;   // mm²
            $pro_mas  = (float) optional($project->conductors)->mass;            // kg/km

            // Заземјач – ако го користиш првиот ground wire
            $zaj_pres = (float) optional($project->groundWires)->cross_section;  // mm² (прилагоди)
            $zaj_mas  = (float) optional($project->groundWires)->mass;           // kg/km (прилагоди)

            // Безбедност: ако недостигаат параметри, фрли јасна грешка
            if (!$pro_pres || !$pro_mas || !$nap_p) {
                throw new \RuntimeException('Недостатни параметри за проводник (presек/маса/напон).');
            }

            // ----- Читање на трасата, сортирано по станица -----
            $points = Trasa::with(['stolb', 'izolam1', 'izolam2'])
                ->where('id_project', $projectId)
                ->orderBy('stac_t', 'asc')  // важно
                ->get();

            // Нема пресметка ако имаме < 2 точки
            if ($points->count() < 2) {
                return 0;
            }

            // исчисти претходни пресметки
             Raspres::where('id_project', $projectId)->delete();

            $inserted = 0;

            // Итерација по соседни парови точки
            for ($i = 0; $i < $points->count() - 1; $i++) {

                $p1 = $points[$i];
                $p2 = $points[$i + 1];

                // Базични полиња
                $st_1 = (float) ($p1->stac_t ?? 0.0);
                $st_2 = (float) ($p2->stac_t ?? 0.0);
                $nv_1 = (float) ($p1->kota_t ?? 0.0);
                $nv_2 = (float) ($p2->kota_t ?? 0.0);

                // Податоци од столб
                $sv_1 = (float) optional($p1->stolb)->vis ?? 0.0; // прилагоди име на колона
                $sv_2 = (float) optional($p2->stolb)->vis ?? 0.0;

                $sg_1 = (float) optional($p1->stolb)->vig ?? 0.0; // вис. јарем (ако ја имаш)
                $sg_2 = (float) optional($p2->stolb)->vig ?? 0.0;

                // Податоци од изолатори
                $id_1   = (float) optional($p1->izolam1)->dolzina ?? 0.0;
                $id_2   = (float) optional($p2->izolam1)->dolzina ?? 0.0;
                $iz_t1  = (string) optional($p1->izolam1)->tip ?? '';
                $iz_t2  = (string) optional($p2->izolam1)->tip ?? '';

                // Распон
                $pom_ras = $st_2 - $st_1;

                // ----- Висина на проводник на столб 1 -----
                // DOS логика (POTP/SILK + ENpot/DNpot); по аналогија:
                if ($izo_tied === 'POTP' || ($izo_tied === 'SILK' && in_array($iz_t1, ['ENpot', 'DNpot'], true))) {
                    $pom_kpr1 = $nv_1 + $sv_1 + $id_1;
                } else {
                    // ако нема агол/специфики, користиме nv + sv - id (како во DOS)
                    $pom_kpr1 = ($nv_1 + $sv_1) - $id_1;
                }

                // ----- Висина на заземјач на столб 1 -----
                $pom_kzj1 = $hasGround ? ($nv_1 + $sv_1 + $sg_1) : 0.0;

                // ----- Висина на проводник на столб 2 -----
                if ($izo_tied === 'POTP' || ($izo_tied === 'SILK' && in_array($iz_t2, ['ENpot', 'DNpot'], true))) {
                    $pom_kpr2 = $nv_2 + $sv_2 + $id_2;
                } else {
                    $pom_kpr2 = ($nv_2 + $sv_2) - $id_2;
                }

                // ----- Висина на заземјач на столб 2 -----
                $pom_kzj2 = $hasGround ? ($nv_2 + $sv_2 + $sg_2) : 0.0;

                // ----- Разлики -----
                $pom_pro = $pom_kpr2 - $pom_kpr1;   // Δпроводник
                $pom_zaj = $pom_kzj2 - $pom_kzj1;   // Δзаземјач

                // ----- Должини (користи sinh; масата е kg/km → во kg/m е $mas/1000) -----
                // формула од DOS: 2*1000*pres*nap * sinh( (L*mas) / (2*1000*pres*nap) ) / mas
                $dol_p = 0.0;
                if ($pro_pres && $nap_p && $pro_mas) {
                    $dol_p = 2 * 1000 * $pro_pres * $nap_p *
                        sinh(($pom_ras * $pro_mas) / (2 * 1000 * $pro_pres * $nap_p)) / $pro_mas;
                }

                $dol_z = 0.0;
                if ($hasGround && $zaj_pres && $nap_z && $zaj_mas) {
                    $dol_z = 2 * 1000 * $zaj_pres * $nap_z *
                        sinh(($pom_ras * $zaj_mas) / (2 * 1000 * $zaj_pres * $nap_z)) / $zaj_mas;
                }

                // ----- Запис во RASPRES -----
                Raspres::create([
                    'id_project' => $projectId,
                    'stac_t'     => $st_1,           // како во DOS: ставаш stac_t на првата точка
                    'kota_t'     => $nv_1,
                    'raspon'     => $pom_ras,
                    'vr_pro'     => $pom_pro,
                    'vr_zaj'     => $pom_zaj,
                    'kota_pro'   => $pom_kpr1,
                    'kota_zaj'   => $pom_kzj1,
                    // ras_totp/t2op/totz/t2oz ако ги пресметуваш подоцна – остави null
                    'dol_pro'    => $dol_p,
                    'dol_zaj'    => $dol_z,
                ]);

                $inserted++;
            }

            return $inserted;
        });
    }

    public function zatpol(int $projectId): void
    {
        // 1) Проект параметри (аналог на Osparam)
        /** @var Projects $project */
        $project = Projects::findOrFail($projectId);
        $napPro = $project->tensile_stress_cond;   // или посебна колона ако имаш
        $napZaj = $project->tensile_stress_ground; // или друга
        $kndt   = $project->kn;                    // analog kndt
        $kidt   = $project->ki;                    // analog kidt
        $priv   = null;                            // ако имаш колона, мапирај ја, инаку null

        // 2) Избриши (или задржи) претходни: тука ќе "ресетираш"
        Zatpol::where('id_project', $projectId)->delete();

        // 3) Земи ја трасата подредена по stac_t (растечки).
        //    ВАЖНО: stac_t во MySQL ти е float -> сортирање е ОК.
        $trasa = Trasa::with(['stolb'])
            ->where('id_project', $projectId)
            ->orderBy('stac_t', 'asc')
            ->get();

        if ($trasa->isEmpty()) {
            return;
        }

        // 4) Детекција на граници на полето:
        //    „Boundary“ ако: agol_tr > 0 ИЛИ stolb->nap == 0 (ако постои)
        $boundaries = [];
        foreach ($trasa as $row) {
            $angle = (float)($row->agol_tr ?? 0);
            $nap   = $row->stolb->nap ?? null; // ако го имаш
            $isBoundary = $angle > 0 || (isset($nap) && (float)$nap == 0);
            if ($isBoundary) {
                $boundaries[] = $row;
            }
        }

        // Ако нема boundary, тогаш земи само прв и последен како граница
        if (empty($boundaries)) {
            $boundaries = [$trasa->first(), $trasa->last()];
        } else {
            // Осигурај се првиот е старт, последниот е крај на последното поле.
            if ($boundaries[0]->id !== $trasa->first()->id) {
                array_unshift($boundaries, $trasa->first());
            }
            if (end($boundaries)->id !== $trasa->last()->id) {
                $boundaries[] = $trasa->last();
            }
        }

        // 5) Итерираме преку соседни парови граници: [b[i], b[i+1]]
        $brojPole = 1;
        for ($i = 0; $i + 1 < count($boundaries); $i++) {
            $start = $boundaries[$i];
            $end   = $boundaries[$i + 1];

            $stacPo = (float)$start->stac_t;
            $stacKr = (float)$end->stac_t;
            $poId   = $start->id;
            $krId   = $end->id;

            $poleDol = $stacKr - $stacPo;
            if ($poleDol <= 0) {
                continue;
            }

            // 6) Агрегации врз RASpres во опсег [stacPo, stacKr)
            $aggr = Raspres::where('id_project', $projectId)
                ->where('stac_t', '>=', $stacPo)
                ->where('stac_t', '<',  $stacKr)
                ->select([
                    DB::raw('SUM(POWER(raspon, 3)) as sum_tri'),
                    DB::raw('SUM( (POW(SQRT(POW(raspon,2) + POW(vr_pro,2)),2)) / NULLIF(raspon,0) ) as sum_ede')
                ])
                ->first();

            $sumTri = (float)($aggr->sum_tri ?? 0);
            $sumEde = (float)($aggr->sum_ede ?? 0);

            $idRas = null;
            if ($sumTri > 0 && $sumEde > 0) {
                $idRas = sqrt($sumTri / $sumEde);
            }

            // 7) Запиши ред во ZATPOL
            Zatpol::create([
                'id_project' => $projectId,
                'po_stolb'   => $poId,
                'stac_po'    => $stacPo,
                'kr_stolb'   => $krId,
                'stac_kr'    => $stacKr,
                'pole_dol'   => $poleDol,
                'nap_pro'    => $napPro,
                'nap_zaj'    => $napZaj,
                'kndt'       => $kndt,
                'kidt'       => $kidt,
                'priv'       => $priv,
                'id_raspon'  => $idRas,
                // останатите полиња можат да се пополнуваат подоцна (null by default)
            ]);

            $brojPole++;
        }
    }
}
