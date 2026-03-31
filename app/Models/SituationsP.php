<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituationsP extends Model
{
    use HasFactory;
    protected $table = "situations_p";
    protected $fillable = [
        'id_project',
        'x',
        'y',
        'z',
        'imported',
        'active',
        'deleted',
    ];

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        // foreign key во raspres = id_project, owner key во projects = id
        return $this->belongsTo(Projects::class, 'id_project', 'id');
    }
}
