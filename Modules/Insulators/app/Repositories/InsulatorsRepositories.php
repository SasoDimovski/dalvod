<?php

namespace Modules\Insulators\Repositories;

use App\Models\InsulatorChain;
use App\Models\Insulators;
use App\Models\Trasa;
use App\Models\Voltages;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Modules\Insulators\Dto\InsulatorsDto;

class InsulatorsRepositories
{
    public function getAllInsulators(array $params): LengthAwarePaginator
    {
        $query = Insulators::query()
            ->with('insulatorChain')
            ->where('insulators.deleted', 0);

        // дефинираме кои полиња се string, а кои бројки
        $columns = [
            'id'   => 'number',
            'sifra'  => 'string',
            'type'  => 'string',
            'voltage'  => 'number',
            'length'   => 'string',
            'mass' => 'string',
            'massd'  => 'string',
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


    public function getAllVoltages()
    {
        return Voltages::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }

    public function getAllInsulatorChains()
    {
        return InsulatorChain::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }

    public function getAllInsulatorChain()
    {
        return InsulatorChain::where('deleted', 0)
            ->where('active', 1)
            ->get();
    }
    public function getInsulatorById($id)
    {
        $insulator = Insulators::where('id', '=', $id)->with('createdBy','updatedBy',)->first();
        if ($insulator){
            return $insulator;
        }
        return null;
    }

    public function updateInsulator($id, InsulatorsDto $data, $picture_name)
    {
        $insulator = Insulators::where('id', '=', $id)->first();

        if($insulator) {
            $insulator->sifra = $data->sifra;
            $insulator->type = $data->type;
            $insulator->voltage = $data->voltage;
            $insulator->length = $data->length;
            $insulator->mass = $data->mass;
            $insulator->massd = $data->mass * 1.15;
            $insulator->id_insulator_chain = $data->id_insulator_chain;
            $insulator->support_insulator = $data->support_insulator;
            $insulator->number = $data->number;
            if($data->id_insulator_chain==1){$insulator->insulator_material='STAK';}
            if($data->id_insulator_chain==2){$insulator->insulator_material='PORC';}
            if($data->id_insulator_chain==3){$insulator->insulator_material='SILK';}
            $insulator->breaking_load = $data->breaking_load;
            $insulator->picture = $picture_name;
            $insulator->updated_by = Auth::id();

            $insulator->active = $data->active;

            if ($insulator->save()) {
                return $insulator;
            }
        }
        return null;
    }


    public function storeInsulator($InsulatorsDto,$picture_name)
    {
        if($InsulatorsDto->id_insulator_chain==1){$insulator_insulator_material='STAK';}
        if($InsulatorsDto->id_insulator_chain==2){$insulator_insulator_material='PORC';}
        if($InsulatorsDto->id_insulator_chain==3){$insulator_insulator_material='SILK';}

      $insulator= Insulators::create([
            'sifra' => $InsulatorsDto->sifra,
            'type' => $InsulatorsDto->type,
            'voltage' => $InsulatorsDto->voltage,
            'length' => $InsulatorsDto->length,
            'mass' => $InsulatorsDto->mass,
            'massd' => $InsulatorsDto->mass* 1.15,
            'id_insulator_chain' => $InsulatorsDto->id_insulator_chain,
            'support_insulator' => $InsulatorsDto->support_insulator,
            'number' => $InsulatorsDto->number,
            'breaking_load' => $InsulatorsDto->breaking_load,
            'picture' => $picture_name,
            'insulator_material' => $insulator_insulator_material,

            'active' => $InsulatorsDto->active,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return $insulator;

    }



    public function isUsed($id)
    {
        return Trasa::where('id_insulator1', $id)
            ->orWhere('id_insulator2', $id)
            ->first();
    }
    public function delete($id)
    {
        $insulators = $this->getInsulatorById($id);
        if($insulators) {
         // Insulators::where('id', '=', $id)->delete();
         //   return $insulators;
            $insulators->deleted = 1;
            return $insulators->save();

        }
        return null;
    }


}
