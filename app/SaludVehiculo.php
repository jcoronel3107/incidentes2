<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SaludVehiculo extends Pivot
{
    protected $table = 'salud_vehiculo';

    public function conductor()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}