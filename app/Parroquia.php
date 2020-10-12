<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Parroquia extends Model
{
    //
    use LogsActivity;
    use SoftDeletes;

	protected $fillable=[
		"nombre","Postalcode"];

	protected static $logFillable = true;
	
	public function inundacion(){
	//Muestra informacion de las inundaciones por id de parroquia
		return $this->hasMany(Inundacion::class);
	}

	public function rescate(){
	//Muestra informacion de las Rescate por id de parroquia
		return $this->hasMany(Rescate::class);
	}

	public function transito(){
	//Muestra informacion de las Transito por id de parroquia
		return $this->hasMany(Transito::class);
	}

	public function incendio(){
	//Muestra informacion de las Incendio por id de parroquia
		return $this->hasMany(Incendio::class);
	}

	public function fuga(){
	//Muestra informacion de las Fuga por id de parroquia
		return $this->hasMany(Fuga::class);
	}

	public function salud(){
	//Muestra informacion de las Salud por id de parroquia
		return $this->hasMany(Salud::class);
	}
}
