<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\DB;


class Vehiculo extends Model
{
    //
    use LogsActivity;
	use SoftDeletes;
	//protected $primaryKey = "codigo";  en caso de la primary key no sea autonumerica.
	protected $fillable=[
	"codigodis",
	"placa",
	"tipo",
	"marca",
	"modelo",
	"clase",
	"pais_orig",
	"anio_fab",
	"carroceria",
	"color1",
	"color2",
	"tonelaje",
	"cilindraje",
	"motor",
	"chasis",
	"station_id",
	"responsab",
	"estado",
	"activo",
	"codigoinv",
	"fechacomp",
	"facturacomp",
	"valorcomp",
	"fechabaja",
	"concepbaja",
	"observacion",
	"kmmantrut",
	"usuacrea",
	"usuaedit",
	"combustible"];

	protected static $logFillable = true;
	
	public function clave(){
	//Muestra informacion de las Claves14 por id de vehiculo
	return $this->hasMany(Clave::class);
	}

	public function station(){
	//Muestra informacion de las Claves14 por id de vehiculo
	return $this->belongsTo(Station::class);
	}

	public function inundacions(){
        return $this->belongsToMany(Inundacion::class)
        ->withTimestamps()
        ->withPivot('km_salida','km_llegada','driver_id');
    }

    public function incendios(){
        return $this->belongsToMany(Incendio::class)
        ->withTimestamps()
        ->withPivot('km_salida','km_llegada','driver_id');
    }

    public function rescates(){
        return $this->belongsToMany(Rescate::class)
        ->withTimestamps()
        ->withPivot('km_salida','km_llegada','driver_id');
    }

    public function saluds(){
        return $this->belongsToMany(Salud::class)
        ->withTimestamps()
        ->withPivot('km_salida','km_llegada','driver_id');
    }

    public function fugas(){
        return $this->belongsToMany(Fuga::class)
        ->withTimestamps()
        ->withPivot('km_salida','km_llegada','driver_id');
    }

    public function transitos(){
        return $this->belongsToMany(Transito::class)
        ->withTimestamps()
        ->withPivot('km_salida','km_llegada','driver_id');
    }

    public function derrames(){
        return $this->belongsToMany(Derrame::class)
        ->withTimestamps()
        ->withPivot('km_salida','km_llegada','driver_id');
    }

	public function list_Id_codigodis_vehiculo(){
		$array = DB::table('Vehiculos')->select('id','codigodis');
		return $array;
	}

	public function maintenance_requests(){
		return $this->hasMany(Maintenance_request::class);
		}

}
