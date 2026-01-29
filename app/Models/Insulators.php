<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insulators extends Model
{
    use HasFactory;
    protected $table = "insulators";
    protected $fillable = [
        'sifra',
        'type',
        'voltage',
        'length',
        'mass',
        'massd',
        'id_insulator_chain',
        'support_insulator',
        'insulator_material',
        'number',
        'breaking_load',
        'picture',
        'active',
        'deleted',
        'created_by',
        'updated_by',
    ];
    public function trasa1(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Trasa::class, 'id_insulator1');
    }

    public function trasa2(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Trasa::class, 'id_insulator2');
    }

    public function insulatorChain(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(InsulatorChain::class, 'id_insulator_chain');
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
