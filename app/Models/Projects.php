<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $table = "projects";
    protected $fillable = [
        'title',
        'id_voltage',
        'id_conductor',
        'id_ground_wires',
        'id_starting_point',
        'id_ending_point',
        'tensile_stress_cond',
        'tensile_stress_ground',
        'kn',
        'ki',
        'id_wind_pressure',
        'id_insulator_chain',
        'approx_field_length',
        'approx_number_towers',
        'var_v',
        'num_cond_systems',
        'num_cond_bundle',
        'num_ground_wires',
        'active',
        'deleted',
        'created_by',
        'updated_by',
    ];


    public function voltages(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Voltages::class, 'id_voltage');
    }
    public function conductors(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Conductors::class, 'id_conductor');
    }
    public function groundWires(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(GroundWires::class, 'id_ground_wires');
    }
    public function startingPoint(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Endpoints::class, 'id_starting_point');
    }
    public function endingPoint(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Endpoints::class, 'id_ending_point');
    }
    public function windPressure(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WindPressure::class, 'id_wind_pressure');
    }
    public function insulatorChain(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(InsulatorChain::class, 'id_insulator_chain');
    }
}
