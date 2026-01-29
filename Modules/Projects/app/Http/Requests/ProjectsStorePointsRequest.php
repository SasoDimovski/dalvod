<?php

namespace Modules\Projects\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectsStorePointsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'stac_t' => 'required',
            'kota_t' => 'required',
        ];
    }

    public function messages(): array
    {

        return [
            'stac_t.required' => __('global.required', ['name' => __('projects.edit-points.stacionaza')]),
            'kota_t.required' => __('global.required', ['name' => __('projects.edit-points.kota')]),
        ];
    }
}
