<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Servicio extends Model
{
    use SoftDeletes;

    public function vehiculo(){
		//Muestra informacion del vehiculo en la clave consultada
		return $this->belongsTo(Vehiculo::class);
	}

	public function users(){
		return $this->belongsToMany(User::class);
	}


}
