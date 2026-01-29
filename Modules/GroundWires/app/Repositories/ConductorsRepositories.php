<?php

namespace Modules\Conductors\Repositories;

use App\Models\ConductorChain;
use App\Models\Conductors;
use App\Models\Projects;
use App\Models\Trasa;
use App\Models\Voltages;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Modules\Conductors\Dto\ConductorsDto;

class ConductorsRepositories
{
    public function getAllConductors(array $params): LengthAwarePaginator
    {
        $query = Conductors::query()
            ->where('deleted', 0);

        // дефинираме кои полиња се string, а кои бројки
        $columns = [
            'id'   => 'string',
            'type'  => 'string',
            'cross_section'  => 'string',
            'diameter'  => 'string',
            'mass'  => 'string',
            'model'  => 'string',
            'temp_exp_coeff'  => 'string',
            'allowable_stress_normal'  => 'string',
            'allowable_stress_emergency'  => 'string',

        ];

        foreach ($columns as $field => $type) {
            if (!isset($params[$field]) || $params[$field] === '') {
                continue;
            }

            $value = trim((string)$params[$field]);

            if ($type === 'string') {
                $query->where($field, 'like', "%{$value}%");

            } elseif ($type === 'number') {
                $query->where($field, $value);

            } elseif ($type === 'decimal') {
                // MySQL
                $query->whereRaw("CAST($field AS CHAR) LIKE ?", ["%{$value}%"]);
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
        $sortField     = $params['order'] ?? 'type';
        $sortDirection = $params['sort']  ?? 'ASC';

        // безбедност – ако ти дојде непостоечко поле, врати се на id
        if (!array_key_exists($sortField, $columns) && $sortField !== 'active') {
            $sortField = 'id';
        }

        $query->orderBy($sortField, $sortDirection);

        // ПАГИНАЦИЈА
        $listing = $params['listing'] ?? config('conductors.pagination', 15);
        if ($listing === 'a') {
            $listing = $query->count();
        }

        return $query->paginate($listing);
    }


    public function getConductorById($id)
    {
        $conductor = Conductors::where('id', '=', $id)->with('createdBy','updatedBy',)->first();
        if ($conductor){
            return $conductor;
        }
        return null;
    }

    public function updateConductor($id, ConductorsDto $data, $picture_name)
    {
        $conductor = Conductors::where('id', '=', $id)->first();

        if($conductor) {
            $conductor->type = $data->type;
            $conductor->cross_section = $data->cross_section;
            $conductor->diameter = $data->diameter;
            $conductor->mass = $data->mass;
            $conductor->model = $data->model;
            $conductor->temp_exp_coeff = $data->temp_exp_coeff;
            $conductor->allowable_stress_normal = $data->allowable_stress_normal;
            $conductor->allowable_stress_emergency = $data->allowable_stress_emergency;
            $conductor->picture = $picture_name;
            $conductor->updated_by = Auth::id();
            $conductor->active = $data->active;

            if ($conductor->save()) {
                return $conductor;
            }
        }
        return null;
    }


    public function storeConductor($ConductorsDto,$picture_name)
    {

      $conductor= Conductors::create([
            'type' => $ConductorsDto->type,
            'cross_section' => $ConductorsDto->cross_section,
            'diameter' => $ConductorsDto->diameter,
            'mass' => $ConductorsDto->mass,
            'model' => $ConductorsDto->model,
            'temp_exp_coeff' => $ConductorsDto->temp_exp_coeff,
            'allowable_stress_normal' => $ConductorsDto->allowable_stress_normal,
            'allowable_stress_emergency' => $ConductorsDto->allowable_stress_emergency,
            'picture' => $picture_name,
            'active' => $ConductorsDto->active,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return $conductor;

    }



    public function isUsed($id)
    {
        return Projects::where('id_conductor', $id)
            ->first();
    }
    public function delete($id)
    {
        $conductors = $this->getConductorById($id);
        if($conductors) {
         // Conductors::where('id', '=', $id)->delete();
         //   return $conductors;
            $conductors->deleted = 1;
            return $conductors->save();

        }
        return null;
    }


}
