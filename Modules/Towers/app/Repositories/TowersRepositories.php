<?php

namespace Modules\Towers\Repositories;


use App\Models\Countries;
use App\Models\ExpirationTime;
use App\Models\Languages;
use App\Models\Passwords;
use App\Models\Towers;
use App\Models\Trasa;
use App\Models\Voltages;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Modules\Towers\Dto\TowersDto;

class TowersRepositories
{
    public function getAllTowers(array $params): LengthAwarePaginator
    {
        $query = Towers::query()
            ->where('deleted', 0);

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
            $sortField = 'voltage';
        }

        $query->orderBy($sortField, $sortDirection);

        // ПАГИНАЦИЈА
        $listing = $params['listing'] ?? config('towers.pagination', 15);
        if ($listing === 'a') {
            $listing = $query->count();
        }

        return $query->paginate($listing);
    }


    public function getAllVoltages()
    {
        return Voltages::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }
    public function getTowerById($id)
    {
        $tower = Towers::where('id', '=', $id)->with('createdBy','updatedBy',)->first();
        if ($tower){
            return $tower;
        }
        return null;
    }

    public function updateTower($id, TowersDto $data, $picture_name)
    {
        $tower = Towers::where('id', '=', $id)->first();

        if($tower) {
            $tower->sif = $data->sif;
            $tower->type = $data->type;
            $tower->voltage = $data->voltage;
            $tower->angle = $data->angle;
            $tower->mass = $data->mass;
            $tower->vid = $data->vid;
            $tower->vis = $data->vis;
            $tower->vig = $data->vig;
            $tower->mhr = $data->mhr;
            $tower->dkp = $data->dkp;
            $tower->dkz = $data->dkz;
            $tower->rap = $data->rap;
            $tower->raz = $data->raz;
            $tower->picture = $picture_name;
            $tower->updated_by = Auth::id();

            $tower->active = $data->active;

            if ($tower->save()) {
                return $tower;
            }
        }
        return null;
    }


    public function storeTower($TowersDto,$picture_name)
    {
      $tower= Towers::create([
            'sif' => $TowersDto->sif,
            'type' => $TowersDto->type,
            'voltage' => $TowersDto->voltage,
            'angle' => $TowersDto->angle,
            'mass' => $TowersDto->mass,
            'vid' => $TowersDto->vid,
            'vis' => $TowersDto->vis,
            'vig' => $TowersDto->vig,
            'mhr' => $TowersDto->mhr,
            'dkp' => $TowersDto->dkp,
            'dkz' => $TowersDto->dkz,
            'rap' => $TowersDto->rap,
            'raz' => $TowersDto->rap,
            'picture' => $picture_name,
            'active' => $TowersDto->active,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return $tower;

    }



    public function isUsed($id)
    {
        $towers = Trasa::where('id_tower', '=', $id)->first();
        if($towers) {
            return $towers;
        }
        return null;
    }
    public function delete($id)
    {
        $towers = $this->getTowerById($id);
        if($towers) {
         // Towers::where('id', '=', $id)->delete();
         //   return $towers;
            $towers->deleted = 1;
            return $towers->save();

        }
        return null;
    }


}
