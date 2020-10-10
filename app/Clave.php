<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Clave extends Model
{
	use SoftDeletes;

	protected $fillable=[
		"km_salida",
		"km_gasolinera",
		"km_llegada",
		"dolares",
		"galones",
		"combustible",
		"gasolinera_id",
		"user_id",
		"vehiculo_id",
		"Orden"];


	public function vehiculo(){
		//Muestra informacion del vehiculo en la clave consultada
		return $this->belongsTo(Vehiculo::class);
	}

	public function gasolinera(){
		//Muestra informacion de la gsolinera en la clave consultada
		return $this->belongsTo(Gasolinera::class);
	}

	public function user(){
		//Muestra informacion de la gsolinera en la clave consultada
		return $this->belongsTo(User::class);
	}
}
