<?php

namespace Modules\Insulators\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsulatorsStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'type' => 'required',
            'voltage' => 'required',
//            'length' => 'required',
//            'mass' => 'required',
//            'massd' => 'required',
//            'id_insulator_chain' => 'required',
//            'support_insulator' => 'required',
//            'number' => 'required',
//            'breaking_load' => 'required',
            'id_insulator_chain' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => __('global.required', ['name' => __('insulators.type')]),
            'voltage.required' => __('global.required', ['name' => __('insulators.voltage')]),
//            'length.required' => __('global.required', ['name' => __('insulators.length')]),
//            'mass.required' => __('global.required', ['name' => __('insulators.mass')]),
//            'massd.required' => __('global.required', ['name' => __('insulators.massd')]),
//            'id_insulator_chain.required' => __('global.required', ['name' => __('insulators.id_insulator_chain')]),
//            'support_insulator.required' => __('global.required', ['name' => __('insulators.support_insulator')]),
//            'number.required' => __('global.required', ['name' => __('insulators.number')]),
//            'breaking_load.required' => __('global.required', ['name' => __('insulators.breaking_load')]),
            'id_insulator_chain.required' => __('global.required', ['name' => __('insulators.id_insulator_chain')]),
        ];
    }

}
