<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsulatorChain extends Model
{
    use HasFactory;
    protected $table = "insulator_chain";
    protected $fillable = [
        'title',
        'description',
        'active',
        'deleted',
    ];
    public function projects (): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Projects::class, 'id_insulator_chain');
    }


}
