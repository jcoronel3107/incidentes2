<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InundacionVehiculo extends Pivot
{
    protected $table = 'inundacion_vehiculo';

    public function conductor()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}