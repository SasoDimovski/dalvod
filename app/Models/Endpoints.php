<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endpoints extends Model
{
    use HasFactory;
    protected $table = "endpoints";
    protected $fillable = [
        'title',
        'description',
        'active',
        'deleted',
    ];
    public function projectsStartingPoint(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Projects::class, 'id_starting_point');
    }

    public function projectsEndingPoint(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Projects::class, 'id_ending_point');
    }
}
