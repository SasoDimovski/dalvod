<?php

namespace Modules\GroundWires\Repositories;

use App\Models\GroundWireChain;
use App\Models\GroundWires;
use App\Models\Projects;
use App\Models\Trasa;
use App\Models\Voltages;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Modules\GroundWires\Dto\GroundWiresDto;

class GroundWiresRepositories
{
    public function getAllGroundWires(array $params): LengthAwarePaginator
    {
        $query = GroundWires::query()
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
        $listing = $params['listing'] ?? config('groundwires.pagination', 15);
        if ($listing === 'a') {
            $listing = $query->count();
        }

        return $query->paginate($listing);
    }


    public function getGroundWireById($id)
    {
        $groundwire = GroundWires::where('id', '=', $id)->with('createdBy','updatedBy',)->first();
        if ($groundwire){
            return $groundwire;
        }
        return null;
    }

    public function updateGroundWire($id, GroundWiresDto $data, $picture_name)
    {
        $groundwire = GroundWires::where('id', '=', $id)->first();

        if($groundwire) {
            $groundwire->type = $data->type;
            $groundwire->cross_section = $data->cross_section;
            $groundwire->diameter = $data->diameter;
            $groundwire->mass = $data->mass;
            $groundwire->model = $data->model;
            $groundwire->temp_exp_coeff = $data->temp_exp_coeff;
            $groundwire->allowable_stress_normal = $data->allowable_stress_normal;
            $groundwire->allowable_stress_emergency = $data->allowable_stress_emergency;
            $groundwire->picture = $picture_name;
            $groundwire->updated_by = Auth::id();
            $groundwire->active = $data->active;

            if ($groundwire->save()) {
                return $groundwire;
            }
        }
        return null;
    }


    public function storeGroundWire($GroundWiresDto,$picture_name)
    {
//dd($picture_name);
      $groundwire= GroundWires::create([
            'type' => $GroundWiresDto->type,
            'cross_section' => $GroundWiresDto->cross_section,
            'diameter' => $GroundWiresDto->diameter,
            'mass' => $GroundWiresDto->mass,
            'model' => $GroundWiresDto->model,
            'temp_exp_coeff' => $GroundWiresDto->temp_exp_coeff,
            'allowable_stress_normal' => $GroundWiresDto->allowable_stress_normal,
            'allowable_stress_emergency' => $GroundWiresDto->allowable_stress_emergency,
            'picture' => $picture_name,
            'active' => $GroundWiresDto->active,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return $groundwire;

    }



    public function isUsed($id)
    {
        return Projects::where('id_ground_wires', $id)
            ->orwhere('id_ground_wires2', $id)
            ->first();
    }
    public function delete($id)
    {
        $groundwires = $this->getGroundWireById($id);
        if($groundwires) {
         // GroundWires::where('id', '=', $id)->delete();
         //   return $groundwires;
            $groundwires->deleted = 1;
            return $groundwires->save();

        }
        return null;
    }


}
