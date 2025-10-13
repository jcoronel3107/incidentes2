<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RescateVehiculo extends Pivot
{
    protected $table = 'rescate_vehiculo';

    public function conductor()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}