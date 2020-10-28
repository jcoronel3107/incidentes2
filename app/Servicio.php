<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Servicio extends Model
{
	use LogsActivity;
    use SoftDeletes;

    protected $fillable=[
    	"fecha_salida",
    	"fecha_retorno",
    	"unidad",
    	"delegante",
		"km_salida",
		"km_retorno",
		"asunto",
		"user_id",
		"vehiculo_id",
		"usr_creador"
		];

    protected static $logFillable = true;
    
    public function vehiculo(){
		//Muestra informacion del vehiculo en la clave consultada
		return $this->belongsTo(Vehiculo::class);
	}

	public function user(){
		return $this->belongsTo(User::class);
	}


}
