<?php

namespace Modules\Projects\Dto;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ProjectsDto
{
    public int $id;
    public ?string $title;
    public ?int $id_voltage;
    public ?int $id_conductor;
    public ?int $id_ground_wires;
    public ?int $id_starting_point;
    public ?int $id_ending_point;
    public ?float $tensile_stress_cond;
    public ?float $tensile_stress_ground;
    public ?float $kn;
    public ?float $ki;
    public ?int $id_wind_pressure;
    public ?int $id_insulator_chain;
    public ?int $approx_field_length;
    public ?int $approx_number_towers;
    public ?int $var_v;
    public ?int $num_cond_systems;
    public ?int $num_cond_bundle;
    public ?int $num_ground_wires;
    public ?int $active;
    public ?int $deleted;
    public ?int $created_by;
    public ?int $updated_by;

    public static function fromRequest(Request $request): self
    {
        $dto = new self();
        $dto->id = (int)$request->input('id');
        $dto->title = $request->input('title');
        $dto->id_voltage = (int)$request->input('id_voltage');
        $dto->id_conductor = (int)$request->input('id_conductor');
        $dto->id_ground_wires = (int)$request->input('id_ground_wires');
        $dto->id_starting_point = (int)$request->input('id_starting_point');
        $dto->id_ending_point = (int)$request->input('id_ending_point');
        $dto->tensile_stress_cond = (float)$request->input('tensile_stress_cond');
        $dto->tensile_stress_ground = (float)$request->input('tensile_stress_ground');
        $dto->kn = (float)$request->input('kn');
        $dto->ki = (float)$request->input('ki');
        $dto->id_wind_pressure = (int)$request->input('id_wind_pressure');
        $dto->id_insulator_chain = (int)$request->input('id_insulator_chain');
        $dto->approx_field_length = (int)$request->input('approx_field_length');
        $dto->approx_number_towers = (int)$request->input('approx_number_towers');
        $dto->var_v = (int)$request->input('var_v');
        $dto->num_cond_systems = (int)$request->input('num_cond_systems');
        $dto->num_cond_bundle = (int)$request->input('num_cond_bundle');
        $dto->num_ground_wires = (int)$request->input('num_ground_wires');
        $dto->active = (int)$request->input('active');
        $dto->deleted = (int)$request->input('deleted');
        $dto->created_by = (int)$request->input('created_by');
        $dto->updated_by = (int)$request->input('updated_by');

        return $dto;
    }
}

