<?php

namespace Modules\Projects\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ProjectsStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'title' => 'required',
            'id_voltage' => 'required',
            'id_starting_point' => 'required',
            'id_ending_point' => 'required',
            'id_conductor' => 'required',
            'tensile_stress_cond' => 'required',



            'num_ground_wires' => 'required|in:0,1,2',
            'id_ground_wires' => 'required_if:num_ground_wires,1,2',
            'tensile_stress_ground' => 'required_if:num_ground_wires,1,2',
            'id_ground_wires2' => 'required_if:num_ground_wires,2',
            'tensile_stress_ground2' => 'required_if:num_ground_wires,2',

            'kn' => 'required',
            'ki' => 'required',
            'id_wind_pressure' => 'required',
            'id_insulator_chain' => 'required',
            'num_cond_systems' => 'required',
            'num_cond_bundle' => 'required',


        ];
    }

    public function messages(): array
    {

        return [
            'title.required' => __('global.required', ['name' => __('projects.title')]),
            'id_voltage.required' => __('global.required', ['name' => __('projects.id_voltage')]),
            'id_starting_point.required' => __('global.required', ['name' => __('projects.id_starting_point')]),
            'id_ending_point.required' => __('global.required', ['name' => __('projects.id_ending_point')]),
            'id_conductor.required' => __('global.required', ['name' => __('projects.id_conductor')]),
            'tensile_stress_cond.required' => __('global.required', ['name' => __('projects.tensile_stress_cond')]),

            'id_ground_wires.required_if' => __('global.required', ['name' => __('projects.id_ground_wires')]),
            'tensile_stress_ground.required_if' => __('global.required', ['name' => __('projects.tensile_stress_ground')]),
            'id_ground_wires2.required_if' => __('global.required', ['name' => __('projects.id_ground_wires')]),
            'tensile_stress_ground2.required_if' => __('global.required', ['name' => __('projects.tensile_stress_ground')]),

            'kn.required' => __('global.required', ['name' => __('projects.kn')]),
            'ki.required' => __('global.required', ['name' => __('projects.ki')]),
            'id_wind_pressure.required' => __('global.required', ['name' => __('projects.id_wind_pressure')]),
            'id_insulator_chain.required' => __('global.required', ['name' => __('projects.id_insulator_chain')]),
            'num_cond_systems.required' => __('global.required', ['name' => __('projects.num_cond_systems')]),
            'num_cond_bundle.required' => __('global.required', ['name' => __('projects.num_cond_bundle')]),
            'num_ground_wires.required' => __('global.required', ['name' => __('projects.num_ground_wires')]),


        ];
    }


//    protected function failedValidation(Validator $validator)
//    {
//        dd([
//            'method' => $this->method(),
//            'input' => $this->all(),
//            'errors' => $validator->errors()->toArray(),
//        ]);
//    }
}
