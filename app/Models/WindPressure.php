<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WindPressure extends Model
{
    use HasFactory;
    protected $table = "wind_pressure";
    protected $fillable = [
        'title',
        'description',
        'active',
        'deleted',
    ];
    public function projects (): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Projects::class, 'id_wind_pressure');
    }


}
