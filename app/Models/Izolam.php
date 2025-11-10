<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izolam extends Model
{
    use HasFactory;
    protected $table = "izolam";
    protected $fillable = [
        'sifra',
        'tip',
        'napon',
        'dolzi',
        'masa',
        'masad',
        'tied',
        'broj',
        'broj',
        'preks',
    ];
    public function trasa1(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Trasa::class, 'id_izolam1');
    }

    public function trasa2(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Trasa::class, 'id_izolam2');
    }
}
