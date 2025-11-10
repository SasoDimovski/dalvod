<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zatpol extends Model
{
    use HasFactory;
    protected $table = "zatpol";
    protected $fillable = [
        'id_project',
        'po_stolb',
        'stac_po',
        'kr_stolb',
        'stac_kr',
        'pole_dol',
        'nap_pro',
        'nap_zaj',
        'kndt',
        'kidt',
        'priv',
        'id_raspon',
        'tovpro',
        'tovpro_1',
        'tovpro_2',
        'napreg1_p',
        'napreg2_p',
        'napreg3_p',
        'napreg4_p',
        'napreg5_p',
        'napreg6_p',
        'napreg7_p',
        'napreg8_p',
        'krit_te_p',
        'krit_ra_p',
        'tovzaj',
        'tovzaj_1',
        'tovzaj_2',
        'napreg1_z',
        'napreg2_z',
        'napreg3_z',
        'napreg4_z',
        'napreg5_z',
        'napreg6_z',
        'napreg7_z',
        'napreg8_z',
        'krit_te_z',
        'krit_ra_z'
    ];
    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        // foreign key во raspres = id_project, owner key во projects = id
        return $this->belongsTo(Projects::class, 'id_project', 'id');
    }


}
