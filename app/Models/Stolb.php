<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stolb extends Model
{
    use HasFactory;
    protected $table = "stolb";
    protected $fillable = [
        'sif',
        'tip',
        'nap',
        'ag',
        'masa',
        'vid',
        'vis',
        'vig',
        'mhr',
        'dkp',
        'dkz',
        'rap',
        'raz',
    ];
    public function trasa(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Trasa::class, 'id_stolb');
    }
}
