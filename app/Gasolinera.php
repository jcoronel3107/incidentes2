<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gasolinera extends Model
{
    //
	use SoftDeletes;
	protected $fillable=["razonsocial","ruc","direccion","email"];
	
	public function clave(){
		//Muestra informacion de las Claves Realizadas por gasolinera
	return $this->hasMany(Clave::class);
}
}
