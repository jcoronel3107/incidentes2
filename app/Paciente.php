<?php

namespace App;

use App\Cie;
use App\Salud;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Paciente extends Model
{
	use LogsActivity;

	protected $fillable=
		[
			"salud_id",
			"cie_id",
			"paciente",
			"edad",
			"genero",
			"presion1",
			"presion2",
			"temperatura",
			"glasglow",
			"saturacion",
			"casasalud",
			"Frecuencia_Cardiaca",
			"Frecuencia_Respiratoria",
			"Glicemia",
			"hojapre"
		];
	protected static $logFillable = true;

    public function salud()
    {
        return $this->belongsTo(Salud::class);
    }

    public function cie()
    {
        return $this->belongsTo(Cie::class);
    }
}
