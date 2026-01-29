<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gapres extends Model
{
    use HasFactory;
    protected $table = "gapres";
    protected $fillable = [
        'id_project',
        'br_stolb',
        'stac_t',
        'raspon',
        'grr_lpro',
        'grr_dpro',
        'grr_vpro',
        'proc_gv',
        'grr_st',
        'grr_lprk',
        'grr_dprk',
        'grr_vprk',
        'elr_pro1',
        'elr_pro2',
        'sre_ras',
        'proc_sr',
        's_ra_st',
        'grr_lzaj',
        'grr_dzaj',
        'grr_vzaj',
        'proc_gz',
        'elr_zaj1',
        'elr_zaj2',
        'kota_pro',
        'kota_zaj',
        'ras_totp',
        'ras_totz',
        'agol_t',
        'stol_ag1',
        'br_ras',
    ];
    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        // foreign key во raspres = id_project, owner key во projects = id
        return $this->belongsTo(Projects::class, 'id_project', 'id');
    }

    protected $casts = [
        'stac_t'=>'float',
        'raspon'=>'float',
        'grr_lpro'=>'float',
        'grr_dpro'=>'float',
        'grr_vpro'=>'float',
        'proc_gv'=>'float',
        'grr_st'=>'float',
        'grr_lprk'=>'float',
        'grr_dprk'=>'float',
        'grr_vprk'=>'float',
        'elr_pro1'=>'float',
        'elr_pro2'=>'float',
        'sre_ras'=>'float',
        'proc_sr'=>'float',
        's_ra_st'=>'float',
        'grr_lzaj'=>'float',
        'grr_dzaj'=>'float',
        'grr_vzaj'=>'float',
        'proc_gz'=>'float',
        'elr_zaj1'=>'float',
        'elr_zaj2'=>'float',
        'kota_pro'=>'float',
        'kota_zaj'=>'float',
        'ras_totp'=>'float',
        'ras_totz'=>'float',
        'agol_t'=>'float',
    ];
}
