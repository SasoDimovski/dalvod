<?php

namespace Modules\Towers\Dto;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class TowersDto
{
    public ?int $id;
    public string $sif;
    public string $type;
    public ?float $voltage;
    public ?float $angle;
    public ?float $mass;
    public string $vid;
    public ?float $vis;
    public ?float $vig;
    public ?float $mhr;
    public ?float $dkp;
    public ?float $dkz;
    public string $rap;
    public string $raz;
    public ?UploadedFile $picture = null;
    public ?int $active;

    public static function fromRequest(Request $request): self
    {
        $dto = new self();

        $dto->id    = $request->input('id');
        $dto->sif   = (string) $request->input('sif');
        $dto->type   = (string) $request->input('type');
        $dto->voltage   = $request->input('voltage')   !== null ? (float) $request->input('voltage')   : null;
        $dto->angle    = $request->input('angle')    !== null ? (float) $request->input('angle')    : null;
        $dto->mass  = $request->input('mass')  !== null ? (float) $request->input('mass')  : null;
        $dto->vid   = (string) $request->input('vid');
        $dto->vis   = $request->input('vis')   !== null ? (float) $request->input('vis')   : null;
        $dto->vig   = $request->input('vig')   !== null ? (float) $request->input('vig')   : null;
        $dto->mhr   = $request->input('mhr')   !== null ? (float) $request->input('mhr')   : null;
        $dto->dkp   = $request->input('dkp')   !== null ? (float) $request->input('dkp')   : null;
        $dto->dkz   = $request->input('dkz')   !== null ? (float) $request->input('dkz')   : null;
        $dto->rap   = (string) $request->input('rap');
        $dto->raz   = (string) $request->input('raz');
        $dto->active = $request->boolean('active') ? 1 : 0;
        $dto->picture = $request->file('picture');

        return $dto;

    }
}

