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
        'x_t',
        'agol_tr',
        'id_tower',
        'id_trafo',
        'id_insulator1',
        'id_insulator2',
    ];

    public function trafo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Trafo::class, 'id_trafo');
    }
    public function tower(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Towers::class, 'id_tower');
    }

    public function insulator1(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Insulators::class, 'id_insulator1');
    }
    public function insulator2(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Insulators::class, 'id_insulator2');
    }
}
