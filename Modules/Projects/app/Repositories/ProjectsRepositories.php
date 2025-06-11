<?php

namespace Modules\Projects\Repositories;


use App\Models\Conductors;
use App\Models\Endpoints;
use App\Models\GroundWires;
use App\Models\InsulatorChain;
use App\Models\Projects;
use App\Models\Users;
use App\Models\Voltages;
use App\Models\WindPressure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
            'tensile_stress_cond' => $projectsDto->tensile_stress_cond,
            'tensile_stress_ground' => $projectsDto->tensile_stress_ground,
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

        if($project) {
            $project->title = $data->title;
            $project->id_voltage = $data->id_voltage;
            $project->id_starting_point = $data->id_starting_point;
            $project->id_ending_point = $data->id_ending_point;
            $project->id_conductor = $data->id_conductor;
            $project->id_ground_wires = $data->id_ground_wires;
            $project->tensile_stress_cond = $data->tensile_stress_cond;
            $project->tensile_stress_ground = $data->tensile_stress_ground;
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
    public function getUserById($id)
    {
        $return= Users::where('id', '=', $id)->first();
        if ($return){
            return $return;
        }
        return null;
    }


}
