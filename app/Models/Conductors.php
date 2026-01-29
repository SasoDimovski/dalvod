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
        'temp_del',
        'allowable_stress_normal',
        'allowable_stress_emergency',
        'picture',
        'active',
        'deleted',
        'created_by',
        'updated_by',
    ];

    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Projects::class, 'id_conductor');
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
