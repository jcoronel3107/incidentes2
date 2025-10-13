<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DerrameVehiculo extends Pivot
{
    protected $table = 'derrame_vehiculo';

    public function conductor()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
