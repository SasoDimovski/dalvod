<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trasa extends Model
{
    use HasFactory;
    protected $table = "trasa";
    protected $fillable = [
        'id_project',
        'stac_t',
        'kota_t',
        'agol_tr',
        'id_stolb',
        'id_trafo',
        'id_izolam1',
        'id_izolam2',
    ];

    public function trafo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Trafo::class, 'id_trafo');
    }
    public function stolb(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Stolb::class, 'id_stolb');
    }

    public function izolam1(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Izolam::class, 'id_izolam1');
    }
    public function izolam2(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Izolam::class, 'id_izolam2');
    }
}
