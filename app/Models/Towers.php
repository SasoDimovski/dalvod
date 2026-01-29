<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Towers extends Model
{
    use HasFactory;
    protected $table = "towers";
    protected $fillable = [
        'sif',
        'type',
        'voltage',
        'angle',
        'mass',
        'vid',
        'vis',
        'vig',
        'mhr',
        'dkp',
        'dkz',
        'rap',
        'raz',
        'picture',
        'active',
        'deleted',
        'created_by',
        'updated_by',
    ];
    public function trasa(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Trasa::class, 'id_tower');
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
