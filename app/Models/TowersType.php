<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TowersType extends Model
{
    use HasFactory;
    protected $table = "towers_type";
    protected $fillable = [
        'name',
        'active',
        'deleted',
    ];
    public function towers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Towers::class, 'id_tower_type');
    }

}
