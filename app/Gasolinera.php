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

	protected $fillable=["razonsocial","ruc","direccion","email","status"];
	protected static $logFillable = true;
	
	public function clave(){
	return $this->hasMany(Clave::class);
	}

	public function contrato(){
		return $this->hasMany(Contrato::class);
	}

	public function solicitud(){
		return $this->hasMany(Solicitud::class);
	}

}
