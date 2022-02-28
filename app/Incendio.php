<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Incendio extends Model
{
	use LogsActivity;
    use SoftDeletes;

    protected $fillable=[
		"incidente_id",
		"tipo_escena",
		"station_id",
		"fecha",
		"direccion",
		"parroquia_id",
		"geoposicion",
		"ficha_ecu911",
		"hora_fichaecu911",
		"hora_salida_a_emergencia",
		"hora_llegada_a_emergencia",
		"hora_fin_emergencia",
		"hora_en_base",
		"informacion_inicial",
		"detalle_emergencia",
		"usuario_afectado",
		"danos_estimados",
		"usr_creador",
		"usr_editor"];

	protected static $logFillable = true;
	
	public function station(){
		//Muestra informacion del vehiculo en la clave consultada
		return $this->belongsTo(Station::class);
	}

	public function parroquia(){
		//Muestra informacion del vehiculo en la clave consultada
		return $this->belongsTo(Parroquia::class);
	}

	public function incidente(){
		//Muestra informacion del vehiculo en la clave consultada
		return $this->belongsTo(Incidente::class);
	}

	public function users(){
		return $this->belongsToMany(User::class);
	}

	public function vehiculos(){
		return $this->belongsToMany(Vehiculo::class)
		->withTimestamps()
		->withPivot('km_salida','km_llegada','driver_id');

	}

}
