<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculo extends Model
{
    //
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
	"kmmantrut",
	"usuacrea",
	"usuaedit",
	"combustible"];

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
        ->withPivot('km_salida','km_llegada');
    }

    public function incendios(){
        return $this->belongsToMany(Incendio::class)
        ->withTimestamps()
        ->withPivot('km_salida','km_llegada');
    }

    public function rescates(){
        return $this->belongsToMany(Rescate::class)
        ->withTimestamps()
        ->withPivot('km_salida','km_llegada');
    }

    public function saluds(){
        return $this->belongsToMany(Salud::class)
        ->withTimestamps()
        ->withPivot('km_salida','km_llegada');
    }

    public function fugas(){
        return $this->belongsToMany(Fuga::class)
        ->withTimestamps()
        ->withPivot('km_salida','km_llegada');
    }

    public function transitos(){
        return $this->belongsToMany(Transito::class)
        ->withTimestamps()
        ->withPivot('km_salida','km_llegada');
    }

    public function derrames(){
        return $this->belongsToMany(Derrame::class)
        ->withTimestamps()
        ->withPivot('km_salida','km_llegada');
    }


}
