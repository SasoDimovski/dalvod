<?php

namespace Modules\Conductors\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConductorsUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'type' => 'required',
            'cross_section' => 'required',
            'diameter' => 'required',
            'mass' => 'required',
            'model' => 'required',
            'temp_exp_coeff' => 'required',
            'allowable_stress_normal' => 'required',
            'allowable_stress_emergency' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => __('global.required', ['name' => __('conductors.type')]),
            'cross_section.required' => __('global.required', ['name' => __('conductors.cross_section')]),
            'diameter.required' => __('global.required', ['name' => __('conductors.diameter')]),
            'mass.required' => __('global.required', ['name' => __('conductors.mass')]),
            'model.required' => __('global.required', ['name' => __('conductors.model')]),
            'temp_exp_coeff.required' => __('global.required', ['name' => __('conductors.temp_exp_coeff')]),
            'allowable_stress_normal.required' => __('global.required', ['name' => __('conductors.allowable_stress_normal')]),
            'allowable_stress_emergency.required' => __('global.required', ['name' => __('conductors.allowable_stress_emergency')]),
        ];
    }

}
