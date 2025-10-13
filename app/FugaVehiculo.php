<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FugaVehiculo extends Pivot
{
    protected $table = 'fuga_vehiculo';

    public function conductor()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}