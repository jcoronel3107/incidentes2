<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TransitoVehiculo extends Pivot
{
    protected $table = 'transito_vehiculo';

    public function conductor()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}

