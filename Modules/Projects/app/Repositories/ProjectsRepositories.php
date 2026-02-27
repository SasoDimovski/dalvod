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
use App\Models\Towers;
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
            // додади што сакаш уште...
        ];

        $sortField     = $params['order'] ?? 'stac_t';   // ТУКА е правилно!
        $sortDirection = strtolower($params['sort'] ?? 'asc') === 'desc' ? 'desc' : 'asc';

        // ако пратат непостоечко поле → врати се на default
        if (!in_array($sortField, $allowedSorts, true)) {
            $sortField = 'stac_t';
        }


        $query->orderBy($sortField, $sortDirection);


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

        $return =Trasa::where('id', '=', $id)->delete();
        if(!$return) {
            return null;
//          $users->deleted = 1;
//          return $users->save();
        }
        return $return;
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
            ->where('deleted', 0)
            ->where('voltage','>=', $voltage);



        // дефинираме кои полиња се string, а кои бројки
        $columns = [
            'id'   => 'number',
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
        $sortField     = $params['order'] ?? 'tip';
        $sortDirection = $params['sort']  ?? 'ASC';

        // безбедност – ако ти дојде непостоечко поле, врати се на id
        if (!array_key_exists($sortField, $columns) && $sortField !== 'active') {
            $sortField = 'voltage';
        }

        $query->orderBy($sortField, $sortDirection);


        // ПАГИНАЦИЈА
        $listing = $params['listing'] ?? config('projects.pagination', 15);
        if ($listing === 'a') {
            $listing = $query->count();
        }

        return $query->paginate($listing);
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

    public function importSituations($rowsToInsert): bool
    {
        return DB::table('situations')->insert($rowsToInsert);
    }

    public function deleteImportedPoints(int $id_project): bool
    {
        Trasa::where('id_project', $id_project)
            ->where('imported', 1)
            ->delete();

        return true;
    }
//====================================================================================================================================================
    public function _getProjectById(int $id)
    {
        return Projects::find($id);
    }

    /**
     * Сите "столбни" точки (само каде има id_tower > 0), по stac_t растечки
     */
    public function _getTowersByIdProject(int $id_project): \Illuminate\Support\Collection
    {
        return Trasa::with(['tower', 'insulator1', 'insulator2'])
            ->where('id_project', $id_project)
            ->where('id_tower', '>', 0)
            ->orderBy('stac_t', 'asc')
            ->get();
    }

    /**
     * Сите распони (меѓу столбовите) по stac_t растечки
     * ВАЖНО: треба да имаш точно N-1 распони за N столбови во трасата.
     */
    public function _getRaspresByIdProject(int $id_project): \Illuminate\Support\Collection
    {
        return Raspres::where('id_project', $id_project)
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

    public function getGapresByIdProject($id_project): \Illuminate\Database\Eloquent\Collection
    {
        return Gapres::with(['project'])
            ->where('gapres.id_project', $id_project)
            ->get();
    }

    public function deleteRaspres(int $projectId): int
    {
        return Raspres::where('id_project', $projectId)->delete();
    }

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
                Raspres::create([
                    'id_project' => $projectId,
                    'stac_t'     => $stac_t1,           // како во DOS: ставаш stac_t на првата точка
                    'kota_t'     => $kota_t1,
                    'raspon'     => $raspon,
                    'vr_pro'     => $vr_pro,
                    'vr_zaj'     => $vr_zaj,
                    'kota_pro'   => $kota_pro1,
                    'kota_zaj'   => $kota_zaj1,
                    // ras_totp/t2op/totz/t2oz ако ги пресметуваш подоцна – остави null
                    'dol_pro'    =>  $dol_pro,
                    'dol_zaj'    =>  $dol_zaj,
                ]);

                $inserted++;
            }

            return $inserted;
        });
    }

    public function deleteZatpol(int $projectId): int
    {
        return  Zatpol::where('id_project', $projectId)->delete();
    }

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

            $stacPo = (float)$start->stac_t;
            $stacKr = (float)$end->stac_t;

            $poId   = (int) ($start->id_tower ?? 0);
            $krId   = (int) ($end->id_tower ?? 0);

            $poleDol = $stacKr - $stacPo;
            if ($poleDol <= 0) {
                continue;
            }

            // ---- 1) најди pom_post / pom_krst (br_raspon) преку Raspres.id ----

            $eps = 0.0001; // толеранција за float stac_t (прилагоди ако треба)

            $pom_post = Raspres::where('id_project', $projectId)
                ->whereBetween('stac_t', [$stacPo - $eps, $stacPo + $eps])
                ->orderBy('stac_t', 'asc')
                ->value('id');

// fallback ако не го најде поради float
            if ($pom_post === null) {
                $pom_post = Raspres::where('id_project', $projectId)
                    ->where('stac_t', '>=', $stacPo)
                    ->orderBy('stac_t', 'asc')
                    ->value('id');
            }

            $pom_krst = Raspres::where('id_project', $projectId)
                ->whereBetween('stac_t', [$stacKr - $eps, $stacKr + $eps])
                ->orderBy('stac_t', 'asc')
                ->value('id');

// fallback ако не го најде поради float
            if ($pom_krst === null) {
                $pom_krst = Raspres::where('id_project', $projectId)
                    ->where('stac_t', '>=', $stacKr)
                    ->orderBy('stac_t', 'asc')
                    ->value('id');
            }

// ако нема следен распон (последно поле) -> крај = max+1
            if ($pom_krst === null) {
                $pom_krst = (int) Raspres::where('id_project', $projectId)->max('id') + 1;
            }

// ако пак нема pom_post -> нема што да се пресмета
            if ($pom_post === null) {
                throw new \RuntimeException("Не можам да најдам pom_post за stacPo={$stacPo} (project={$projectId})");
            }

// ако pom_krst <= pom_post (може да се случи ако stacKr е исто/помало) -> прескокни
            if ((int)$pom_krst <= (int)$pom_post) {
                // тука можеш continue; или throw ако сакаш строго
                throw new \RuntimeException("Невалиден опсег: pom_post={$pom_post}, pom_krst={$pom_krst} (stacPo={$stacPo}, stacKr={$stacKr})");
            }


// ---- 2) DOS-еквивалент агрегација: FOR id >= pom_post AND id < pom_krst ----

            $aggr = Raspres::where('id_project', $projectId)
                ->where('id', '>=', (int)$pom_post)
                ->where('id', '<',  (int)$pom_krst)
                ->selectRaw('SUM(POWER(raspon, 3)) as sum_tri')
                ->selectRaw('SUM((POWER(raspon,2) + POWER(vr_pro,2)) / NULLIF(raspon,0)) as sum_ede')
                ->first();

            $sumTri = (float) ($aggr->sum_tri ?? 0.0);
            $sumEde = (float) ($aggr->sum_ede ?? 0.0);

            $idRas = ($sumTri > 0 && $sumEde > 0) ? sqrt($sumTri / $sumEde) : null;

            $napPro = (float) ($start->nap_pro ?? $project->tensile_stress_cond);
            $napZaj = (float) ($start->nap_zaj?? $project->tensile_stress_ground);
            $kndt = (float) ($start->kndt?? $project->kn);
            $kidt = (float) ($start->kidt?? $project->ki);
            $priv = (float) ($start->kidt ?? optional($project->windPressure)->title);



            // 7) Запиши ред во ZATPOL
            Zatpol::create([
                'id_project' => $projectId,
                'po_stolb'   => $poId, //id на запис на почетокот на полето од Trasa
                'kr_stolb'   => $krId, //id на запис на крај на полето од Trasa
                'stac_po'    => $stacPo, //почетна стационажа на полето
                'stac_kr'    => $stacKr, //крајна стационажа на полето
                'pole_dol'   => $poleDol, // должина на поле, разлика помеѓу  stac_po и stac_kr

                'nap_pro'    => $napPro, // се препишува од Project
                'nap_zaj'    => $napZaj, // се препишува од Project
                'kndt'       => $kndt, // се препишува од Project
                'kidt'       => $kidt, // се препишува од Project
                'priv'       => $priv, // се препишува од Project

                'id_raspon'  => $idRas,
                // останатите полиња можат да се пополнуваат подоцна (null by default)
            ]);

            $brojPole++;
        }
    }

    public function napreg(int $projectId): int
    {
        return DB::transaction(function () use ($projectId) {

            // ===== 1) Проект + проводник + заземјач (Osparam аналог) =====
            $project = Projects::with(['conductors', 'groundWires'])->findOrFail($projectId);

            // Проводник (conductors)
            $pro_mas  = (float) optional($project->conductors)->mass;               // kg/km
            $pro_pres = (float) optional($project->conductors)->cross_section;      // mm²
            $pro_dij  = (float) optional($project->conductors)->diameter;           // mm
            $pro_mod  = (float) optional($project->conductors)->model;              // "modulus" (како DOS)
            $pro_tem  = (float) optional($project->conductors)->temp_exp_coeff;  //  pro_temko

            // Заземјач (ground_wires)
            $zaj_mas  = (float) optional($project->groundWires)->mass;
            $zaj_pres = (float) optional($project->groundWires)->cross_section;
            $zaj_dij  = (float) optional($project->groundWires)->diameter;
            $zaj_mod  = (float) optional($project->groundWires)->model;
            $zaj_tem  = (float) optional($project->groundWires)->temp_exp_coeff; // zaj_temko

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

                $kn     = (float) ($zp->kndt ?? 0);
                $ki     = (float) ($zp->kidt ?? 0);
                $nap_p  = (float) ($zp->nap_pro ?? 0);
                $id_ras = (float) ($zp->id_raspon ?? 0);

                // tovpr / tovpr_1 / tovpr_2
                $tovpr   = 0.000981 * $pro_mas / $pro_pres;
                $tovpr_1 = (0.000981 * $pro_mas + $kn * 0.18 * sqrt($pro_dij)) / $pro_pres;
                $tovpr_2 = (0.000981 * $pro_mas + $kn * $ki * 0.18 * sqrt($pro_dij)) / $pro_pres;

                $zp->tovpro   = $tovpr;
                $zp->tovpro_1 = $tovpr_1;
                $zp->tovpro_2 = $tovpr_2;



                // krit_tempro / krit_raspro
                $krit_te_p = 0.0;
                $krit_ra_p = 0.0;

                $den = ($tovpr_1*$tovpr_1) - ($tovpr*$tovpr);
                if ($nap_p > 0 && $tovpr_1 != 0.0 && $den > 0.0) {
                    $krit_te_p = ($nap_p * (1.0 - ($tovpr / $tovpr_1)) / ($pro_mod * $pro_tem)) - 5.0;
                    $krit_ra_p = $nap_p * sqrt(360.0 * $pro_tem / $den);
                }

                $zp->krit_te_p = $krit_te_p;
                $zp->krit_ra_p = $krit_ra_p;

                // Napreg arrays (1..8)
                $napreg = array_fill(1, 8, 0.0);

                // N_pro = (tovpr^2 * id_ras^2 * pro_mod)/24
                $N_pro = ($tovpr*$tovpr) * ($id_ras*$id_ras) * $pro_mod / 24.0;

                if ($id_ras > $krit_ra_p) {
                    // -------- Napreganje prov - 1 --------
                    for ($i=1; $i<=7; $i++) {
                        $temp = 10*$i - 30; // -20..40

                        // M_pro[i] = (tovpr_1^2 * id_ras^2 * pro_mod)/(24 * nap_p^2) + pro_tem*pro_mod*(temp+5) - nap_p
                        $M = (($tovpr_1*$tovpr_1) * ($id_ras*$id_ras) * $pro_mod)
                            / (24.0 * max($nap_p*$nap_p, 1e-12))
                            + ($pro_tem * $pro_mod * ($temp + 5.0))
                            - $nap_p;

                        $napreg[$i] = $this->solveNapregNewton($N_pro, $M, 0.1, 0.001);
                    }

                    // Temp[8] = -5; napreg[8] = nap_p
                    $napreg[8] = $nap_p;

                } else {
                    // -------- Napreganje prov - 2 --------
                    // Temp[1]=-20; napreg[1]=nap_p
                    $napreg[1] = $nap_p;

                    for ($i=2; $i<=7; $i++) {
                        $temp = 10*$i - 30;

                        // M_pro[i] = (tovpr^2 * id_ras^2 * pro_mod)/(24 * nap_p^2) + pro_tem*pro_mod*(temp+20) - nap_p
                        $M = (($tovpr*$tovpr) * ($id_ras*$id_ras) * $pro_mod)
                            / (24.0 * max($nap_p*$nap_p, 1e-12))
                            + ($pro_tem * $pro_mod * ($temp + 20.0))
                            - $nap_p;

                        $napreg[$i] = $this->solveNapregNewton($N_pro, $M, 0.5, 0.05);
                    }

                    // i=8 посебно:
                    // N = (tovpr_1^2 * id_ras^2 * pro_mod)/24
                    // M8 = (tovpr^2 * id_ras^2 * pro_mod)/(24 * nap_p^2) + pro_tem*pro_mod*( -5 + 20) - nap_p
                    $N8 = (($tovpr_1*$tovpr_1) * ($id_ras*$id_ras) * $pro_mod) / 24.0;

                    $M8 = (($tovpr*$tovpr) * ($id_ras*$id_ras) * $pro_mod)
                        / (24.0 * max($nap_p*$nap_p, 1e-12))
                        + ($pro_tem * $pro_mod * ((-5.0) + 20.0))
                        - $nap_p;

                    $napreg[8] = $this->solveNapregNewton($N8, $M8, 0.5, 0.05);

                }
               // dd($napreg[3]);

                // Write napreg*_p fields
                $zp->napreg1_p = $napreg[1];
                $zp->napreg2_p = $napreg[2];
                $zp->napreg3_p = $napreg[3];
                $zp->napreg4_p = $napreg[4];
                $zp->napreg5_p = $napreg[5];
                $zp->napreg6_p = $napreg[6];
                $zp->napreg7_p = $napreg[7];
                $zp->napreg8_p = $napreg[8];

                $zp->save();
            }

            // ============================================================
            // PASS 2: ЗАЗЕМЈАЧ
            // ============================================================
            foreach ($zat as $zp) {

                $kn     = (float) ($zp->kndt ?? 0);
                $ki     = (float) ($zp->kidt ?? 0);
                $nap_z  = (float) ($zp->nap_zaj ?? 0);
                $id_ras = (float) ($zp->id_raspon ?? 0);

                // Ако нема заземјач (nap_z == 0) -> нули како DOS
                if ($nap_z == 0.0) {
                    $zp->tovzaj    = 0;
                    $zp->tovzaj_1  = 0;
                    $zp->tovzaj_2  = 0;

                    $zp->napreg1_z = 0;
                    $zp->napreg2_z = 0;
                    $zp->napreg3_z = 0;
                    $zp->napreg4_z = 0;
                    $zp->napreg5_z = 0;
                    $zp->napreg6_z = 0;
                    $zp->napreg7_z = 0;
                    $zp->napreg8_z = 0;

                    $zp->krit_te_z = 0;
                    $zp->krit_ra_z = 0;

                    $zp->save();
                    continue;
                }

                // Ако има nap_z, мора да има валидни ground_wires параметри
                if ($zaj_mas <= 0 || $zaj_pres <= 0 || $zaj_dij <= 0 || $zaj_mod == 0 || $zaj_tem == 0) {
                    throw new \RuntimeException('NAPREG_1: Недостатни параметри за заземјач (ground_wires.*).');
                }

                $tovzj   = 0.000981 * $zaj_mas / $zaj_pres;
                $tovzj_1 = (0.000981 * $zaj_mas + $kn * 0.18 * sqrt($zaj_dij)) / $zaj_pres;
                $tovzj_2 = (0.000981 * $zaj_mas + $kn * $ki * 0.18 * sqrt($zaj_dij)) / $zaj_pres;

                $zp->tovzaj   = $tovzj;
                $zp->tovzaj_1 = $tovzj_1;
                $zp->tovzaj_2 = $tovzj_2;

                $krit_te_z = 0.0;
                $krit_ra_z = 0.0;

                $den = ($tovzj_1*$tovzj_1) - ($tovzj*$tovzj);
                if ($tovzj_1 != 0.0 && $den > 0.0) {
                    $krit_te_z = ($nap_z * (1.0 - ($tovzj / $tovzj_1)) / ($zaj_mod * $zaj_tem)) - 5.0;
                    $krit_ra_z = $nap_z * sqrt(360.0 * $zaj_tem / $den);
                }

                $zp->krit_te_z = $krit_te_z;
                $zp->krit_ra_z = $krit_ra_z;

                $napreg = array_fill(1, 8, 0.0);

                // N_zaj = tovzj^2 * id_ras^2 * zaj_mod / 24
                $N_zaj = ($tovzj*$tovzj) * ($id_ras*$id_ras) * $zaj_mod / 24.0;

                if ($id_ras > $krit_ra_z) {
                    // -------- Napreganje zaj - 1 --------
                    for ($i=1; $i<=7; $i++) {
                        $temp = 10*$i - 30;

                        // M_zaj[i] = (tovzj_1^2 * id_ras^2 * zaj_mod)/(24 * nap_z^2) + zaj_tem*zaj_mod*(temp+5) - nap_z
                        $M = (($tovzj_1*$tovzj_1) * ($id_ras*$id_ras) * $zaj_mod)
                            / (24.0 * max($nap_z*$nap_z, 1e-12))
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

                    for ($i=2; $i<=7; $i++) {
                        $temp = 10*$i - 30;

                        // M_zaj[i] = (tovzj^2 * id_ras^2 * zaj_mod)/(24 * nap_z^2) + zaj_tem*zaj_mod*(temp+20) - nap_z
                        $M = (($tovzj*$tovzj) * ($id_ras*$id_ras) * $zaj_mod)
                            / (24.0 * max($nap_z*$nap_z, 1e-12))
                            + ($zaj_tem * $zaj_mod * ($temp + 20.0))
                            - $nap_z;

                        $napreg[$i] = $this->solveNapregNewton($N_zaj, $M, 0.5, 0.05);
                    }

                    // i=8 посебно:
                    // N8 = tovzj_1^2 * id_ras^2 * zaj_mod / 24
                    // M8 = (tovzj^2 * id_ras^2 * zaj_mod)/(24 * nap_z^2) + zaj_tem*zaj_mod*( -5 + 20) - nap_z
                    $N8 = (($tovzj_1*$tovzj_1) * ($id_ras*$id_ras) * $zaj_mod) / 24.0;

                    $M8 = (($tovzj*$tovzj) * ($id_ras*$id_ras) * $zaj_mod)
                        / (24.0 * max($nap_z*$nap_z, 1e-12))
                        + ($zaj_tem * $zaj_mod * ((-5.0) + 20.0))
                        - $nap_z;

                    $napreg[8] = $this->solveNapregNewton($N8, $M8, 0.5, 0.05);
                }

                $zp->napreg1_z = $napreg[1];
                $zp->napreg2_z = $napreg[2];
                $zp->napreg3_z = $napreg[3];
                $zp->napreg4_z = $napreg[4];
                $zp->napreg5_z = $napreg[5];
                $zp->napreg6_z = $napreg[6];
                $zp->napreg7_z = $napreg[7];
                $zp->napreg8_z = $napreg[8];

                $zp->save();
            }

            return $zat->count();
        });
    }

    /**
     * Newton solver - 1:1 со DOS:
     * Del = (N/x^2 - x - M) / (2N/x^3 + 1)
     * x = x + Del, додека |Del| > 1e-6
     */
    private function solveNapregNewton(float $N, float $M, float $x0 = 0.5, float $del0 = 0.05): float
    {
        $x   = max($x0, 1e-9);
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
            $x  += $del;

            if ($x <= 0) { $x = 1e-9; break; }
        }

        return $x;
    }

    public function deletegraviras(int $projectId): int
    {
        return Gapres::where('id_project', $projectId)->delete();
    }
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
                ->orderBy('stac_t','asc')
                ->get();

            if ($raspres->isEmpty() || $trasa->isEmpty()) {
                return 0;
            }

            // 4) DOS иницијализации
            $gr_lp  = 0.0;
            $gr_lpk = 0.0;
            $gr_lz  = 0.0;
            $sr_rl  = 0.0;

            $inserted = 0;

            // 5) Ќе итерираме по RASPRES, ама агол/столаг ќе земаме од TRASA со ист индекс
            $n = min($raspres->count(), $trasa->count());

            for ($i = 0; $i < $n; $i++) {

                $rp = $raspres[$i];
                $t  = $trasa[$i]; // ✅ директно тековен Trasa ред (без map)

                $sta_t   = (float) ($rp->stac_t ?? 0.0);
                $raspon1 = (float) ($rp->raspon ?? 0.0);

                $ras_tp1  = (float) ($rp->ras_totp ?? 0.0);
                $ras_tp1k = (float) ($rp->ras_t20p  ?? 0.0); // ако го имаш (инаку 0)
                $ras_tz1  = (float) ($rp->ras_totz ?? 0.0);

                $vir_p1 = (float) ($rp->vr_pro ?? 0.0);
                $vir_z1 = (float) ($rp->vr_zaj ?? 0.0);

                // ✅ како DOS: agov_t = Trastol->agol_tr ; stol_a = Trastol->stolb_ag

                $agol_t   = (float) ($t->agol_tr ?? 0.0);
                $stol_ag1 = (int) (optional($t->tower)->angle ?? 0);

                // DOS: sr_rd = raspon1/2 ; sr_rasp = sr_rl + sr_rd
                $sr_rd   = $raspon1 / 2.0;
                $sr_rasp = $sr_rl + $sr_rd;

                // левите вредности се од претходниот чекор
                $left_lpro = $gr_lp;
                $left_lprk = $gr_lpk;
                $left_lzaj = $gr_lz;

                // проводник
                if ($vir_p1 >= 0) {
                    $gr_lp  = $ras_tp1  / 2.0;
                    $gr_lpk = $ras_tp1k / 2.0;

                    $gr_dp  = $raspon1 - ($ras_tp1  / 2.0);
                    $gr_dpk = $raspon1 - ($ras_tp1k / 2.0);
                } else {
                    $gr_lp  = $raspon1 - ($ras_tp1  / 2.0);
                    $gr_lpk = $raspon1 - ($ras_tp1k / 2.0);

                    $gr_dp  = $ras_tp1  / 2.0;
                    $gr_dpk = $ras_tp1k / 2.0;
                }

                // заземјач
                if (!$hasGround) {
                    $gr_lz = 0.0;
                    $gr_dz = 0.0;
                } else {
                    if ($vir_z1 >= 0) {
                        $gr_lz = $ras_tz1 / 2.0;
                        $gr_dz = $raspon1 - ($ras_tz1 / 2.0);
                    } else {
                        $gr_lz = $raspon1 - ($ras_tz1 / 2.0);
                        $gr_dz = $ras_tz1 / 2.0;
                    }
                }

                $gr_vpro = $left_lpro + $gr_dp;
                $gr_vprk = $left_lprk + $gr_dpk;
                $gr_vzaj = $left_lzaj + $gr_dz;

                $br_stolb = (int) ($rp->br_raspon ?? ($i + 1));
                $br_ras   = $br_stolb . '-' . ($br_stolb + 1);

                Gapres::create([
                    'id_project' => $projectId,
                    'br_stolb' => $br_stolb,
                    'stac_t'   => $sta_t,
                    'raspon'   => $raspon1,
                    'grr_lpro' => $left_lpro,
                    'grr_dpro' => $gr_dp,
                    'grr_vpro' => $gr_vpro,
                    'grr_lprk' => $left_lprk,
                    'grr_dprk' => $gr_dpk,
                    'grr_vprk' => $gr_vprk,
                    'grr_lzaj' => $left_lzaj,
                    'grr_dzaj' => $gr_dz,
                    'grr_vzaj' => $gr_vzaj,
                    'sre_ras'  => $sr_rasp,
                    'kota_pro' => (float) ($rp->kota_pro ?? 0.0),
                    'kota_zaj' => (float) ($rp->kota_zaj ?? 0.0),
                    'ras_totp' => $ras_tp1,
                    'ras_totz' => $ras_tz1,
                    'agol_t'   => $agol_t,
                    'stol_ag1' => $stol_ag1,
                    'br_ras'   => $br_ras,
                ]);

                // DOS: sr_rl = raspon1/2
                $sr_rl = $raspon1 / 2.0;

                $inserted++;
            }

            // 6) Последен ред како DOS (APPEND BLANK после loop)
            // DOS зема:
            // - sta_t од последен TRASA ред
            // - vir_p/vir_z од последен RASPRES ред
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

                $prev = Gapres::where('id_project', $projectId)->orderBy('id', 'desc')->first();

                $pomk_p = (float) ($prev->kota_pro ?? 0.0);
                $pomk_z = (float) ($prev->kota_zaj ?? 0.0);

                $br_st_last = (int) ($prev->br_stolb ?? $inserted);
                $br_st_new  = $br_st_last + 1;

                Gapres::create([
                    'id_project' => $projectId,

                    'br_stolb' => $br_st_new,
                    'stac_t'   => $sta_t_last,

                    'sre_ras'  => $sr_rl_last,

                    'grr_lpro' => $gr_lp,
                    'grr_lprk' => $gr_lpk,
                    'grr_lzaj' => $gr_lz,

                    'grr_dpro' => 0.0,
                    'grr_dprk' => 0.0,
                    'grr_dzaj' => 0.0,

                    'grr_vpro' => $gr_lp,
                    'grr_vprk' => $gr_lpk,
                    'grr_vzaj' => $gr_lz,

                    'kota_pro' => $pomk_p + $vir_p,
                    'kota_zaj' => $pomk_z + $vir_z,

                    'agol_t'   => $agol_t,
                    'stol_ag1' => $stol_ag1,

                    'br_ras'   => $br_st_new . '-' . ($br_st_new + 1),
                ]);

                $inserted++;
            }

            return $inserted;
        });
    }



    public function rastotal(int $projectId): int
    {
        return DB::transaction(function () use ($projectId) {

            // =========================
            // 1) Osparam -> Projects
            // =========================
            $project = Projects::with([
                'conductors',
                'groundWires',
                'insulatorChain',
            ])->findOrFail($projectId);

            // DOS: zaj_ja = Osparam->zaj_tip; IF zaj_ja="---" нема заземјач
            $hasGround = (int) ($project->num_ground_wires ?? 0) > 0;

            // =========================
            // 2) Земи ги сите затезни полиња (Zatpol)
            // DOS: GO BOTTOM brop_max=broj_pole, GO TOP brop_min=broj_pole, па врти
            // Ние ќе идеме по ред со orderBy
            // =========================
            $poles = Zatpol::where('id_project', $projectId)
                ->orderBy('id', 'asc')
                ->get([
                    'id',
                    'stac_po',
                    'stac_kr',
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

            // max id во raspres за "последно поле"
            $maxRaspId = (int) Raspres::where('id_project', $projectId)->max('id');
            if ($maxRaspId <= 0) {
                return 0;
            }

            // =========================
            // 3) helper: најди Raspres.id што одговара на stac (float-safe)
            // DOS: INDEX ON stac_t + SEEK sta_p
            // Кај нас: најди id за stac со between +/- eps, па fallback на >=
            // =========================
            $eps = 0.0001;

            $findRaspIdAtStac = function (float $stac) use ($projectId, $eps): ?int {

                // 1) пробај "квази-еднаквост"
                $id = Raspres::where('id_project', $projectId)
                    ->whereBetween('stac_t', [$stac - $eps, $stac + $eps])
                    ->orderBy('stac_t', 'asc')
                    ->value('id');

                if ($id !== null) {
                    return (int) $id;
                }

                // 2) fallback: првиот распон што почнува на/после stac
                $id = Raspres::where('id_project', $projectId)
                    ->where('stac_t', '>=', $stac)
                    ->orderBy('stac_t', 'asc')
                    ->value('id');

                return $id !== null ? (int) $id : null;
            };

            // =========================
            // 4) Главна логика (DOS REPLACE во Raspres)
            // =========================
            $updated = 0;

            foreach ($poles as $pole) {

                $stacPo = (float) ($pole->stac_po ?? 0.0);
                $stacKr = (float) ($pole->stac_kr ?? 0.0);

                // прескокни ако е лошо поле
                if ($stacKr <= $stacPo) {
                    continue;
                }

                // DOS: pom_post / pom_krst (br_raspon граници)
                $pom_post = $findRaspIdAtStac($stacPo);
                $pom_krst = $findRaspIdAtStac($stacKr);

                if ($pom_post === null) {
                    // нема распон што почнува од stacPo -> нема што да ажурираш
                    continue;
                }

                // последно поле -> до крај
                if ($pom_krst === null) {
                    $pom_krst = $maxRaspId + 1;
                }

                if ($pom_krst <= $pom_post) {
                    continue;
                }

                // параметри (DOS nap_pr[1], nap_pr[8], nap_zj[1], nap_zj[8] итн.)
                $napP1 = (float) ($pole->napreg1_p ?? 0.0);
                $napP8 = (float) ($pole->napreg8_p ?? 0.0);
                $napZ1 = (float) ($pole->napreg1_z ?? 0.0);
                $napZ8 = (float) ($pole->napreg8_z ?? 0.0);

                $tovp   = (float) ($pole->tovpro   ?? 0.0);
                $tovp_1 = (float) ($pole->tovpro_1 ?? 0.0);
                $tovz   = (float) ($pole->tovzaj   ?? 0.0);
                $tovz_1 = (float) ($pole->tovzaj_1 ?? 0.0);

                // заштита од делење со нула (да не падне скриптата)
                $tovp   = ($tovp   == 0.0) ? 1e-12 : $tovp;
                $tovp_1 = ($tovp_1 == 0.0) ? 1e-12 : $tovp_1;
                $tovz   = ($tovz   == 0.0) ? 1e-12 : $tovz;
                $tovz_1 = ($tovz_1 == 0.0) ? 1e-12 : $tovz_1;

                // земи ги распоните што припаѓаат на ова поле
                // DOS: DO WHILE br_ras < kr_st (по SEEK sta_p)
                $rows = Raspres::where('id_project', $projectId)
                    ->where('id', '>=', $pom_post)
                    ->where('id', '<',  $pom_krst)
                    ->orderBy('id', 'asc')
                    ->get(['id', 'raspon', 'vr_pro', 'vr_zaj']);

                foreach ($rows as $r) {

                    $rasp = (float) ($r->raspon ?? 0.0);
                    if ($rasp == 0.0) {
                        continue; // избегни делење со нула
                    }

                    $virp = (float) ($r->vr_pro ?? 0.0);
                    $virz = (float) ($r->vr_zaj ?? 0.0);

                    // DOS:
                    // rasp_tot[8]=rasp+(2*nap_pr[8]*ABS(virp))/(rasp * tovp_1)
                    // rasp_t20   =rasp+(2*nap_pr[1]*ABS(virp))/(rasp * tovp)
                    $ras_totp = $rasp + (2.0 * $napP8 * abs($virp)) / ($rasp * $tovp_1);
                    $ras_t20p = $rasp + (2.0 * $napP1 * abs($virp)) / ($rasp * $tovp);

                    if (!$hasGround) {
                        // DOS: ако zaj_ja="---" тогаш 0
                        $ras_totz = 0.0;
                        $ras_t20z = 0.0;
                    } else {
                        // DOS:
                        // rasz_tot[8]=rasp+(2*nap_zj[8]*ABS(virz))/(rasp * tovz_1)
                        // rasz_t20   =rasp+(2*nap_zj[1]*ABS(virz))/(rasp * tovz)
                        $ras_totz = $rasp + (2.0 * $napZ8 * abs($virz)) / ($rasp * $tovz_1);
                        $ras_t20z = $rasp + (2.0 * $napZ1 * abs($virz)) / ($rasp * $tovz);
                    }

                    // DOS: REPLACE ...
                    Raspres::where('id', (int)$r->id)->update([
                        'ras_totp' => $ras_totp,
                        'ras_t2op' => $ras_t20p,
                        'ras_totz' => $ras_totz,
                        'ras_t2oz' => $ras_t20z,
                    ]);

                    $updated++;
                }
            }

            return $updated;
        });
    }

}
