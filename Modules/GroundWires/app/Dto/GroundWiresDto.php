<?php

namespace Modules\GroundWires\Dto;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class GroundWiresDto
{
    public ?int $id;
    public string $type;
    public ?float $cross_section;
    public ?float $diameter;
    public ?float $mass;
    public ?float $model;
    public ?float $temp_exp_coeff;
    public ?float $allowable_stress_normal;
    public ?float $allowable_stress_emergency;
    public ?UploadedFile $picture = null;
    public ?int $active;

    public static function fromRequest(Request $request): self
    {
        $dto = new self();

        $dto->id    = $request->input('id');
        $dto->type   = (string) $request->input('type');
        $dto->cross_section  = $request->input('cross_section')   !== null ? (float) $request->input('cross_section')   : null;
        $dto->diameter    = $request->input('diameter')    !== null ? (float) $request->input('diameter')    : null;
        $dto->mass  = $request->input('mass')  !== null ? (float) $request->input('mass')  : null;
        $dto->model  = $request->input('model')  !== null ? (float) $request->input('model')  : null;
        $dto->temp_exp_coeff  = $request->input('temp_exp_coeff')  !== null ? (float) $request->input('temp_exp_coeff')  : null;
        $dto->allowable_stress_normal  = $request->input('allowable_stress_normal')  !== null ? (float) $request->input('allowable_stress_normal')  : null;
        $dto->allowable_stress_emergency  = $request->input('allowable_stress_emergency')  !== null ? (float) $request->input('allowable_stress_emergency')  : null;
        $dto->picture = $request->file('picture');
        $dto->active = $request->boolean('active') ? 1 : 0;

        return $dto;

    }
}

