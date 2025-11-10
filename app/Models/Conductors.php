<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductors extends Model
{
    use HasFactory;

    protected $table = "conductors";
    protected $fillable = [
        'type',
        'cross_section',
        'diameter',
        'mass',
        'model',
        'resistance_per_km',
        'nominal_voltage',
        'test_voltage',
        'active',
        'deleted',
        'created_by',
        'updated_by',
    ];

    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Projects::class, 'id_conductor');
    }
}
