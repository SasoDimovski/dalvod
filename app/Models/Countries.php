<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    protected $table = "_countries";
    protected $fillable = [
        'code_s',
        'code_l',
        'name',

        'active',
        'deleted',
    ];

    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Users::class, 'id_country');
    }
}
