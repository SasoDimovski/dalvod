<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raspres extends Model
{
    use HasFactory;
    protected $table = "raspres";
    protected $fillable = [
        'id_project',
        'stac_t',
        'kota_t',
        'raspon',
        'vr_pro',
        'vr_zaj',
        'kota_pro',
        'kota_zaj',
        'ras_totp',
        'ras_t2op',
        'ras_totz',
        'ras_t2oz',
        'dol_pro',
        'dol_zaj',
    ];
    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        // foreign key во raspres = id_project, owner key во projects = id
        return $this->belongsTo(Projects::class, 'id_project', 'id');
    }

    protected $casts = [
        'stac_t' => 'float', 'kota_t' => 'float', 'raspon' => 'float',
        'vr_pro' => 'float', 'vr_zaj' => 'float', 'kota_pro' => 'float',
        'kota_zaj' => 'float', 'ras_totp' => 'float', 'ras_t2op' => 'float',
        'ras_totz' => 'float', 'ras_t2oz' => 'float', 'dol_pro' => 'float',
        'dol_zaj' => 'float',
    ];
}
