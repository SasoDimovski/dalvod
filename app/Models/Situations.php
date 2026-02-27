<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situations extends Model
{
    use HasFactory;
    protected $table = "situations";
    protected $fillable = [
        'id_project',
        'x',
        'y',
        'z',
        'inserted',
        'active',
        'deleted',
    ];

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        // foreign key во raspres = id_project, owner key во projects = id
        return $this->belongsTo(Projects::class, 'id_project', 'id');
    }
}
