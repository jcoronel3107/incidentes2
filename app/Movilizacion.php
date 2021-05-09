<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Movilizacion extends Model
{
    use LogsActivity;
    use SoftDeletes;

    protected $fillable=[
    	"fecha_salida",
    	"fecha_retorno",
        "km_salida",
        "km_retorno",
        "observaciones",
        "usr_creador",
        "usr_editor",
        "actividad_id",
        "user_id",
        "vehiculo_id"
		];

    protected static $logFillable = true;
    
    public function actividads()
    {
        return $this->hasMany(Actividad::class);
    }

    public function vehiculo(){
		//Muestra informacion del vehiculo en la clave consultada
		return $this->belongsTo(Vehiculo::class);
	}
	
}
