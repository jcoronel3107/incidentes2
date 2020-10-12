<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Gasolinera extends Model
{
    //
	use SoftDeletes;
	use LogsActivity;

	protected $fillable=["razonsocial","ruc","direccion","email"];
	protected static $logFillable = true;
	
	public function clave(){
		//Muestra informacion de las Claves Realizadas por gasolinera
	return $this->hasMany(Clave::class);
}
}
