<?php

namespace Modules\Insulators\Dto;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class InsulatorsDto
{
    public ?int $id;
    public string $sifra;
    public string $type;
    public ?float $voltage;
    public ?float $length;
    public ?float $mass;
    public string $massd;
    public ?int $id_insulator_chain;
    public ?int $support_insulator;
    public string $insulator_material;
    public ?int $number;
    public ?float $breaking_load;
    public ?UploadedFile $picture = null;
    public ?int $active;

    public static function fromRequest(Request $request): self
    {
        $dto = new self();

        $dto->id    = $request->input('id');
        $dto->sifra   = (string) $request->input('sifra');
        $dto->type   = (string) $request->input('type');
        $dto->voltage   = $request->input('voltage')   !== null ? (float) $request->input('voltage')   : null;
        $dto->length    = $request->input('length')    !== null ? (float) $request->input('length')    : null;
        $dto->mass  = $request->input('mass')  !== null ? (float) $request->input('mass')  : null;
        $dto->massd  = $request->input('massd')  !== null ? (float) $request->input('massd')  : null;
        $dto->id_insulator_chain    = $request->input('id_insulator_chain');
        $dto->support_insulator   = $request->boolean('support_insulator') ? 1 : 0;
        $dto->insulator_material   = (string) $request->input('insulator_material');
        $dto->number   = $request->input('number');
        $dto->breaking_load   = $request->input('breaking_load');
        $dto->picture = $request->file('picture');
        $dto->active = $request->boolean('active') ? 1 : 0;

        return $dto;

    }
}

