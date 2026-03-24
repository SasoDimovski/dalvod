<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TowersA extends Model
{
    use HasFactory;
    protected $table = "towers_a";
    protected $fillable = [
        'id',
        'id_tower_type',
        'sif',
        'tip',
        'ago',
        'nap',
        'vxa',
        'vza',
        'zxa',
        'zza',
        'vxb',
        'vzb',
        'zxb',
        'zzb',
        'sxb',
        'vxc',
        'vyc',
        'vzc',
        'zxc',
        'zyc',
        'zzc',
        'syc',
        'vxo',
        'vyo',
        'vzo',
        'zxo',
        'zyo',
        'zzo',
        'vxa1',
        'vya1',
        'vza1',
        'vxb1',
        'vzb1',
        'zxb1',
        'zzb1',
        'zxc2',
        'zyc2',
        'zzc2',
        'vxd2',
        'vzd2',
        'zxd2',
        'zzd2',
        'active',
        'deleted',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
    public function towerA(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Towers::class, 'id_tower_a');
    }
    public function towerType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TowersType::class, 'id_tower_type', 'id');
    }
    public function createdBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Users::class, 'created_by');
    }

    public function updatedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Users::class, 'updated_by');
    }

}
