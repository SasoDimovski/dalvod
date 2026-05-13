<?php

namespace Modules\Projects\Repositories;


use App\Models\Conductors;
use App\Models\Endpoints;
use App\Models\Gapres;
use App\Models\GroundWires;
use App\Models\InsulatorChain;
use App\Models\Insulators;
use App\Models\Projects;
use App\Models\Raspres;
use App\Models\Situations;
use App\Models\SituationsP;
use App\Models\Towers;
use App\Models\TowersA;
use App\Models\TowersType;
use App\Models\Trafo;
use App\Models\Trasa;
use App\Models\Users;
use App\Models\Voltages;
use App\Models\WindPressure;
use App\Models\Zatpol;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Projects\Dto\ProjectsDto;


use Modules\Projects\Repositories\Elpres as ElpresService;
use Modules\Projects\Repositories\Graviras as GravirasService;
use Modules\Projects\Repositories\Grvrast as GrvrastService;
use Modules\Projects\Repositories\Napreg as NapregService;
use Modules\Projects\Repositories\Raspres as RaspresService;
use Modules\Projects\Repositories\Rastotal as RastotalService;
use Modules\Projects\Repositories\Srerast as SrerastService;
use Modules\Projects\Repositories\Zatpol as ZatpolService;

class ProjectsRepositories
{
    public function __construct(
        public RaspresService $raspres,
        public ZatpolService $zatpol,
        public NapregService $napreg,
        public RastotalService $rastotal,
        public GrvrastService $grvrast,
        public SrerastService $srerast,
        public GravirasService $graviras,
        public ElpresService $elpres
    ) {}
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
    public function deleteProject($id)
    {
        $project = $this->getProjectById($id);

        if (!$project) {
            return null;
        }

        return DB::transaction(function () use ($id) {

            Gapres::where('id_project', $id)->delete();
            Zatpol::where('id_project', $id)->delete();
            Raspres::where('id_project', $id)->delete();
            Trasa::where('id_project', $id)->delete();
            Trafo::where('id_project', $id)->delete();
            Situations::where('id_project', $id)->delete();
            SituationsP::where('id_project', $id)->delete();
            Projects::where('id', $id)->delete();

            return true;
        });
    }


    public function createEndpoints($id_project, $point, $id_trafo)
    {
        $project = Trasa::create([
            'id_project' => $id_project,
            'id_trafo' => $point == 1 ? $id_trafo : null,
        ]);

        return $project;
    }
    public function updateEndPoints(int $projectId, array $payload): bool
    {
        // dd($payload);
        return DB::transaction(function () use ($projectId, $payload) {

// 1) TRASA
            foreach ((array) data_get($payload, 'trasa', []) as $trasaId => $data) {

                // нормализација
                $id_insulator1 = data_get($data, 'id_insulator1');
                $id_tower = data_get($data, 'id_tower');
                if ($id_insulator1 === '' || $id_insulator1 === null) {
                    $id_insulator1 = null;
                }
                if ($id_tower === '' || $id_tower === null) {
                    $id_tower = null;
                }
                $trasaUpdate = [
                    'stac_t'     => data_get($data, 'stac_t'),
                    'kota_t'     => data_get($data, 'kota_t'),
                    'agol_tr'    => data_get($data, 'agol_tr'),
                    'id_tower'   => $id_tower,
                    'id_insulator1' => $id_insulator1,
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
                    'visina_p'   => data_get($data, 'visina_p'),
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


    public function getAllEndpoints()
    {
        return Endpoints::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }
    public function getVoltageById($id)
    {
        //dd($id);
        $return = Voltages::where('id', '=', $id)->first();
        if ($return) {
            return $return;
        }
        return null;
    }
    public function getAllVoltages()
    {
        return Voltages::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }
    public function getAllVoltagesByVoltage($voltage)
    {
        return Voltages::where('deleted', 0)
            ->where('active', 1)
            ->where('title','>=', $voltage)
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
    public function getAllWindPressure()
    {
        return WindPressure::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }
    public function getAllInsulatorChains()
    {
        return InsulatorChain::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }


    public function getTrafoByIdProject($id_project)
    {
        $return = Trafo::where('id_project', '=', $id_project)->first();
        if ($return) {
            return $return;
        }
        return null;
    }
    public function createTrafo($id_project)
    {
        $trafo= Trafo::create([
            'id_project' => $id_project,
        ]);
        return $trafo;

    }
    public function deleteTrafo($id_project)
    {
        $trafo = Trafo::where('id_project', $id_project)->first();
        if (!$trafo) {
            return null; // нема trafo за тој проект
        }
        return $trafo->delete();
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
            'id_tower'   => null,
            'id_trafo'   => $id_trafo,
            'id_insulator1' => null,
            'id_insulator2' => null,
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
            'id_tower'   => null,
            'id_trafo'   => $id_trafo,
            'id_insulator1' => null,
            'id_insulator2' => null,
        ]);

        return $trasa;
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
            ->with(['tower'])
            ->with(['insulator1'])
            ->with(['insulator2'])
            ->where('id_project', $id_project)
            ->orderBy('id', 'asc')->take(2)->get();
    }
    public function getTrasaByIdProject(int $id_project, array $params = []): LengthAwarePaginator
    {
        $query = Trasa::with(['trafo', 'tower', 'insulator1', 'insulator2'])
            ->where('id_project', $id_project);


        // ========================
        // FILTER: objects
        // ========================
        if (!empty($params['objects'])) {
            $query->where(function ($q) {
                $q->where('id_tower', '>', 0)
                    ->orWhere('id_trafo', '>', 0);
            });
        }
        if (!empty($params['angle'])) {
            $query->where('agol_tr', '>', 0);

        }

        if (!empty($params['endpoints'])) {

            $ids = Trasa::where('id_project', $id_project)
                ->orderBy('stac_t', 'asc')
                ->pluck('id');

            $firstId = $ids->first();
            $lastId  = $ids->last();

            $query->whereIn('id', array_filter([$firstId, $lastId]));
        }
        // ------------------------
        // Pagination
        // ------------------------
        $perPage = $params['listing'] ?? config('projects.pagination', 15);
        if ($perPage === 'a') {
            $perPage = $query->count();
        }

        // ------------------------
        // Sorting
        // ------------------------
        // дозволени колони за сортирање
        $allowedSorts = [
            'id',
            'stac_t',
            'kota_t',
            'agol_tr',
            'nap_pro',
            'nap_zaj',
            'nap_zaj2',
            'kndt',
            'kidt',
            'priv',
            'imported',
            'id_insulator1',
            'id_insulator2',
            'id_tower',
            'id_trafo',
        ];

        $sortField     = $params['order'] ?? 'stac_t';   // ТУКА е правилно!
        $sortDirection = strtolower($params['sort'] ?? 'asc') === 'desc' ? 'desc' : 'asc';

        // ако пратат непостоечко поле → врати се на default
        if (!in_array($sortField, $allowedSorts, true)) {
            $sortField = 'stac_t';
        }


        $relationSorts = [
            'id_insulator1' => [
                'table'   => 'insulators',
                'alias'   => 'i1',
                'fk'      => 'trasa.id_insulator1',
                'pk'      => 'i1.id',
                'orderBy' => 'i1.type',
            ],
            'id_insulator2' => [
                'table'   => 'insulators',
                'alias'   => 'i2',
                'fk'      => 'trasa.id_insulator2',
                'pk'      => 'i2.id',
                'orderBy' => 'i2.type',
            ],
            'id_tower' => [
                'table'   => 'towers',
                'alias'   => 't',
                'fk'      => 'trasa.id_tower',
                'pk'      => 't.id',
                'orderBy' => 't.name', // или t.sif, t.name,
            ],
            'id_trafo' => [
                'table'   => 'trafo',
                'alias'   => 'tr',
                'fk'      => 'trasa.id_trafo',
                'pk'      => 'tr.id',
                'orderBy' => 'tr.ime', // смени ако кај тебе полето е друго
            ],
        ];

        if (isset($relationSorts[$sortField])) {
            $cfg = $relationSorts[$sortField];

            $query->leftJoin($cfg['table'] . ' as ' . $cfg['alias'], $cfg['fk'], '=', $cfg['pk'])
                ->orderBy($cfg['orderBy'], $sortDirection)
                ->select('trasa.*');
        } else {
            $query->orderBy($sortField, $sortDirection);
        }

        return $query->paginate($perPage);
    }




    public function getPointById($id)
    {
        $return = Trasa::where('id', '=', $id)
            ->with(['trafo', 'tower', 'insulator1', 'insulator2'])->first();
        if ($return) {
            return $return;
        }
        return null;
    }
    public function storePoint($request)
    {
        $point = Trasa::create([
            'id_project' => $request->id,
            'stac_t'     => $request->stac_t,
            'kota_t'     => $request->kota_t,
            'agol_tr'    => $request->agol_tr,
            'id_tower'   => $request->id_tower ?: null,
            'id_insulator1' => $request->id_insulator1 ?: null,
            'id_insulator2' => $request->id_insulator2 ?: null,
            'nap_pro' => $request->nap_pro ?: null,
            'nap_zaj' => $request->nap_zaj ?: null,
            'nap_zaj2' => $request->nap_zaj2 ?: null,
            'kndt' => $request->kndt ?: null,
            'kidt' => $request->kidt ?: null,
            'priv' => $request->priv ?: null,
        ]);

        return $point;
    }
    public function updatePoint($projectId, $id_point, $request)
    {
        //dd($request);
        $point = Trasa::where('id', '=', $id_point)->first();

        if($point) {
            $point->stac_t    = $request['stac_t']    ?? null;
            $point->kota_t    = $request['kota_t']    ?? null;
            $point->agol_tr   = $request['agol_tr']   ?? null;
            $point->id_tower  = $request['id_tower']  ?? null;
            $point->id_insulator1 = $request['id_insulator1'] ?? null;
            $point->id_insulator2 = $request['id_insulator2'] ?? null;
            $point->nap_pro = $request['nap_pro'] ?? null;
            $point->nap_zaj = $request['nap_zaj'] ?? null;
            $point->nap_zaj2 = $request['nap_zaj2'] ?? null;
            $point->kndt = $request['kndt'] ?? null;
            $point->kidt = $request['kidt'] ?? null;
            $point->priv = $request['priv'] ?? null;

            if ($point->save()) {
                return $point;
            }
        }
        return null;
    }
    public function deletePoint($id)
    {
        $trasa = Trasa::find($id);
        if (!$trasa) {
            return null;
        }
        $id_project = $trasa->id_project;
        $trasa->delete();
        return $id_project;
    }


    public function showProfile($projectId)
    {
        $points = Trasa::where('id_project', $projectId)
            ->with(['trafo'])
            ->with(['tower'])
            ->with(['insulator1'])
            ->with(['insulator2'])
            ->orderBy('stac_t')
            ->get();

        return $points;




    }



    public function getTowerById($id)
    {
        $tower = Towers::where('id', '=', $id)->with('createdBy','updatedBy',)->first();
        if ($tower){
            return $tower;
        }
        return null;
    }
    public function getAllTowersVoltage($voltage, array $params, $id_tower): LengthAwarePaginator
    {
        // dd($params);
        $query = Towers::query()
            ->with('towerType')
            ->with('towerA')
            ->where('towers.deleted', 0)
            ->where('towers.voltage','>=', $voltage);



        // дефинираме кои полиња се string, а кои бројки
        $columns = [
            'id'   => 'number',
            'id_tower_type'  => 'number',
            'id_tower_a'  => 'number',
            'sif'  => 'string',
            'type'  => 'string',
            'voltage'  => 'number',
            'angle'   => 'string',
            'mass' => 'string',
            'vid'  => 'string',
            'vis'  => 'string',
            'vig'  => 'string',
            'mhr'  => 'string',
            'dkp'  => 'string',
            'dkz'  => 'string',
            'rap'  => 'string',
            'raz'  => 'string',
        ];

        /*
        * 1️ Проверка дали има други search филтри активни
        */

        // Филтри по СИТЕ полиња – ако е string → LIKE, ако е number → exact
        foreach ($columns as $field => $type) {
            if (isset($params[$field]) && $params[$field] !== '') {
                if ($type === 'string') {
                    $query->where($field, 'like', '%' . $params[$field] . '%');
                } else {
                    $query->where($field, $params[$field]);
                }
            }
        }
        if (isset($params['name1'])) {
            $query->where('name', 'like', '%' . $params['name1'] . '%');
        }
        // ACTIVE / DEACTIVATED филтер (checkbox-и)
        $active      = !empty($params['active']);
        $deactivated = !empty($params['deactivated']);

        if ($active && !$deactivated) {
            $query->where('active', 1);
        } elseif (!$active && $deactivated) {
            $query->where('active', 0);
        }
        // ако се штиклирани и двете – не филтрираме по active

        // СОРТИРАЊЕ
        $sortField     = $params['order'] ?? 'id';
        $sortDirection = $params['sort']  ?? 'ASC';

        // безбедност – ако ти дојде непостоечко поле, врати се на id
        if (!array_key_exists($sortField, $columns) && $sortField !== 'active') {
            $sortField = 'id';
        }

        if (isset($params['order'])&& $params['order'] === 'name1') {
            $sortField = 'name';
        }
        if (isset($params['order']) && $params['order'] === 'id_tower_type') {

            $query->leftJoin('towers_type', 'towers.id_tower_type', '=', 'towers_type.id')
                ->select('towers.*');

            $sortField = 'towers_type.name';
        }

        if (isset($params['order']) && $params['order'] === 'id_tower_a') {

            $query->leftJoin('towers_a', 'towers.id_tower_a', '=', 'towers_a.id')
                ->select('towers.*');

            $sortField = 'towers_a.tip';
        }

        $query->orderBy($sortField, $sortDirection);


        // ПАГИНАЦИЈА
        $listing = $params['listing'] ?? config('projects.pagination', 15);
        if ($listing === 'a') {
            $listing = $query->count();
        }

        return $query->paginate($listing);
    }

    public function getAllTowersTypes()
    {
        return TowersType::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }

    public function getAllTowersA(): \Illuminate\Database\Eloquent\Collection
    {
        return TowersA::with('towerType')
            ->orderBy('tip','asc' )->get();
    }
    public function getAllInsulatorsVoltage($voltage, array $params, $idInsulators): LengthAwarePaginator
    {
        $query = Insulators::query()
            ->with('insulatorChain')
            ->where('deleted', 0)
            ->where('voltage','>=', $voltage);

        // дефинираме кои полиња се string, а кои бројки
        $columns = [
            'id'   => 'number',
            'sifra'  => 'string',
            'type'  => 'string',
            'voltage'  => 'number',
            'length'   => 'string',
            'masa' => 'string',
            'mass'  => 'string',
            'id_insulator_chain'  => 'number',
            'support_insulator'  => 'string',
            'insulator_material'  => 'string',
            'number'  => 'number',
            'breaking_load'  => 'number',
        ];

        // Филтри по СИТЕ полиња – ако е string → LIKE, ако е number → exact
        foreach ($columns as $field => $type) {
            if (isset($params[$field]) && $params[$field] !== '') {
                if ($type === 'string') {
                    $query->where($field, 'like', '%' . $params[$field] . '%');
                } else {
                    $query->where($field, $params[$field]);
                }
            }
        }

        // ACTIVE / DEACTIVATED филтер (checkbox-и)
        $active      = !empty($params['active']);
        $deactivated = !empty($params['deactivated']);

        if ($active && !$deactivated) {
            $query->where('active', 1);
        } elseif (!$active && $deactivated) {
            $query->where('active', 0);
        }
        // ако се штиклирани и двете – не филтрираме по active

        // СОРТИРАЊЕ
        $sortField     = $params['order'] ?? 'voltage';
        $sortDirection = $params['sort']  ?? 'ASC';

        // безбедност – ако ти дојде непостоечко поле, врати се на id
        if (!array_key_exists($sortField, $columns) && $sortField !== 'active') {
            $sortField = 'nap';
        }

        $query->orderBy($sortField, $sortDirection);

        // ПАГИНАЦИЈА
        $listing = $params['listing'] ?? config('insulators.pagination', 15);
        if ($listing === 'a') {
            $listing = $query->count();
        }

        return $query->paginate($listing);
    }



    public function importPoints($rowsToInsert): bool
    {
        return DB::table('trasa')->insert($rowsToInsert);
    }
    public function deleteImportedPoints(int $id_project): bool
    {
        Trasa::where('id_project', $id_project)
            ->where('imported', 1)
            ->delete();

        return true;
    }
    public function checkImportPoints(int $projectId): bool
    {
        return Trasa::where('id_project', $projectId)
            ->where('imported', 1)
            ->exists();
    }


    public function importSituations($rowsToInsert): bool
    {
        return DB::table('situations')->insert($rowsToInsert);
    }

    public function importSituationsP($rowsToInsert): bool
    {
        return DB::table('situations_p')->insert($rowsToInsert);
    }
    public function deleteImportedSituation(int $id_project): bool
    {
        Situations::where('id_project', $id_project)
            ->where('imported', 1)
            ->delete();

        return true;
    }

    public function deleteImportedSituationP(int $id_project): bool
    {
        SituationsP::where('id_project', $id_project)
            ->where('imported', 1)
            ->delete();

        return true;
    }
    public function checkImportSituation(int $projectId): bool
    {
        return Situations::where('id_project', $projectId)
            ->where('imported', 1)
            ->exists();
    }

    public function checkImportSituationP(int $projectId): bool
    {
        return SituationsP::where('id_project', $projectId)
            ->where('imported', 1)
            ->exists();
    }
//====================================================================================================================================================
    public function _getProjectById(int $id)
    {
        return Projects::find($id);
    }


    public function _getTrasaByIdProject(int $id_project): \Illuminate\Support\Collection
    {

        return Trasa::with(['project','tower', 'insulator1', 'insulator2', 'trafo'])
            ->where('id_project', $id_project)
            ->where(function ($q) {
                $q->where('id_tower', '>', 0)
                    ->orWhere('id_trafo', '>', 0);
            })
            ->orderBy('stac_t','asc')
            ->get();
    }

    /**
     * Сите распони (меѓу столбовите) по stac_t растечки
     * ВАЖНО: треба да имаш точно N-1 распони за N столбови во трасата.
     */
    public function _getRaspresByIdProject(int $id_project): \Illuminate\Support\Collection
    {
        return Raspres::with(['project', 'trasa'])
        ->where('id_project', $id_project)
            ->orderBy('stac_t', 'asc')
            ->get();
    }

    /**
     * Сите затезни полиња (опсези) по stac_po растечки
     */
    public function _getZatpolByIdProject(int $id_project): \Illuminate\Support\Collection
    {
        return Zatpol::where('id_project', $id_project)
            ->orderBy('stac_po', 'asc')
            ->get();
    }

    public function _getGapresByIdProject(int $id_project): \Illuminate\Support\Collection
    {
        return Gapres::where('id_project', $id_project)
            ->orderBy('stac_t', 'asc')
            ->get();
    }
//====================================================================================================================================================
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

    public function getSituationByIdProject($id_project): \Illuminate\Database\Eloquent\Collection
    {
        return Situations::with(['project'])
            ->where('id_project', $id_project)
            ->get();
    }
    public function getSituationByIdProjectP($id_project): \Illuminate\Database\Eloquent\Collection
    {
        return SituationsP::with(['project'])
            ->where('id_project', $id_project)
            ->get();
    }

    public function getGapresByIdProject($id_project): \Illuminate\Database\Eloquent\Collection
    {
        return Gapres::with(['project','trasa'])
            ->where('gapres.id_project', $id_project)
            ->get();
    }

//=====================================================================================================================================

    public function deleteRaspres(int $projectId): int
    {
        return Raspres::where('id_project', $projectId)->delete();
    }



    public function deleteZatpol(int $projectId): int
    {
        return  Zatpol::where('id_project', $projectId)->delete();
    }





    public function deletegraviras(int $projectId): int
    {
        return Gapres::where('id_project', $projectId)->delete();
    }


    public function setCalculation(int $projectId, int $value): int
    {
        return Projects::where('id', $projectId)
            ->update(['calculation' => $value]);
    }



    public function copyProject(int $id): ?int
    {
        try {
            return DB::transaction(function () use ($id) {

                $oldProject = Projects::findOrFail($id);

                // 1) COPY PROJECT
                $newProject = $oldProject->replicate();
                $newProject->title = $oldProject->title . ' - Copy';
                $newProject->created_by = Auth::id() ?? $oldProject->created_by;
                $newProject->updated_by = Auth::id() ?? $oldProject->updated_by;
                $newProject->save();

                $newProjectId = (int) $newProject->id;

                // ============================================================
                // 2) COPY TRAFO + MAP OLD_ID => NEW_ID
                // ============================================================
                $trafoIdMap = [];

                $oldTrafos = Trafo::where('id_project', $id)->get();

                foreach ($oldTrafos as $oldTrafo) {
                    $newTrafo = $oldTrafo->replicate();
                    $newTrafo->id_project = $newProjectId;

                    if (isset($newTrafo->created_by)) {
                        $newTrafo->created_by = Auth::id() ?? $oldTrafo->created_by;
                    }
                    if (isset($newTrafo->updated_by)) {
                        $newTrafo->updated_by = Auth::id() ?? $oldTrafo->updated_by;
                    }

                    $newTrafo->save();

                    $trafoIdMap[(int) $oldTrafo->id] = (int) $newTrafo->id;
                }

                // ============================================================
                // 3) COPY TRASA
                // ============================================================
                $oldTrasaRows = Trasa::where('id_project', $id)
                    ->orderBy('stac_t', 'asc')
                    ->get();

                foreach ($oldTrasaRows as $oldTrasa) {
                    $newTrasa = $oldTrasa->replicate();
                    $newTrasa->id_project = $newProjectId;

                    // remap trafo if exists
                    if (!empty($oldTrasa->id_trafo)) {
                        $newTrasa->id_trafo = $trafoIdMap[(int) $oldTrasa->id_trafo] ?? null;
                    }

                    $newTrasa->save();
                }

                // ============================================================
                // 4) COPY SITUATION
                // ============================================================
                $oldSituations = Situations::where('id_project', $id)->get();

                foreach ($oldSituations as $oldSituation) {
                    $newSituation = $oldSituation->replicate();
                    $newSituation->id_project = $newProjectId;

                    if (isset($newSituation->created_by)) {
                        $newSituation->created_by = Auth::id() ?? $oldSituation->created_by;
                    }
                    if (isset($newSituation->updated_by)) {
                        $newSituation->updated_by = Auth::id() ?? $oldSituation->updated_by;
                    }

                    $newSituation->save();
                }

                // ============================================================
                // 5) COPY SITUATION_P
                // ============================================================
                $oldSituationP = SituationsP::where('id_project', $id)->get();

                foreach ($oldSituationP as $oldRow) {
                    $newRow = $oldRow->replicate();
                    $newRow->id_project = $newProjectId;

                    if (isset($newRow->created_by)) {
                        $newRow->created_by = Auth::id() ?? $oldRow->created_by;
                    }
                    if (isset($newRow->updated_by)) {
                        $newRow->updated_by = Auth::id() ?? $oldRow->updated_by;
                    }

                    $newRow->save();
                }



                //RASPRES tabela
                $this->raspres->raspres($newProjectId);

                //ZATPOL tabela
                $this->zatpol->zatpol($newProjectId);
                $this->napreg->napreg($newProjectId);

                //RASPRES tabela
                $this->rastotal->rastotal($newProjectId);


                //GAPRES tabela
                $this->graviras->graviras($newProjectId);
                $this->srerast->srerast($newProjectId);
                $this->grvrast->grvrast($newProjectId);
                $this->elpres->elpres($newProjectId);



                return $newProjectId;
            });
        } catch (Throwable $e) {
            report($e);
            return null;
        }
    }


}
