<?php

namespace Modules\Towers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TowersStoreRequest extends FormRequest
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
  //          'ag' => 'required',
 //           'mass' => 'required',
//            'vid' => 'required',
//            'vis' => 'required',
//            'vig' => 'required',
//            'mhr' => 'required',
//            'dkp' => 'required',
//            'dkz' => 'required',
//            'rap' => 'required',
//            'raz' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => __('global.required', ['name' => __('towers.type')]),
            'voltage.required' => __('global.required', ['name' => __('towers.voltage')]),
//            'ag.required' => __('global.required', ['name' => __('towers.ag')]),
//            'mass.required' => __('global.required', ['name' => __('towers.mass')]),
//            'vid.required' => __('global.required', ['name' => __('towers.vid')]),
//            'vis.required' => __('global.required', ['name' => __('towers.vis')]),
//            'vig.required' => __('global.required', ['name' => __('towers.vig')]),
//            'mhr.required' => __('global.required', ['name' => __('towers.mhr')]),
//            'dkp.required' => __('global.required', ['name' => __('towers.dkp')]),
//            'dkz.required' => __('global.required', ['name' => __('towers.dkz')]),
//            'rap.required' => __('global.required', ['name' => __('towers.rap')]),
//            'raz.required' => __('global.required', ['name' => __('towers.raz')]),
        ];
    }

}
