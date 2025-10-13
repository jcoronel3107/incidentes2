<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;

class IncendioVehiculo extends Pivot
{
    protected $table = 'incendio_vehiculo';

    public function conductor()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}


