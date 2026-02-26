<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trafo extends Model
{
    use HasFactory;
    protected $table = "trafo";
    protected $fillable = [
        'id_project',
        'ime',
        'visina_p',
        'visina_zj',
        'hor_ras',
    ];
    public function trasa(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Trasa::class, 'id_trafo');
    }
}
