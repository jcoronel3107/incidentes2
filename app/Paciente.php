<?php

namespace App;

use App\Cie;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
	protected $fillable=
		[
			"salud_id",
			"paciente",
			"edad",
			"genero",
			"presion1",
			"presion2",
			"temperatura",
			"glasglow",
			"saturacion",
			"casasalud",
		];

    public function salud()
    {
        return $this->belongsTo(Salud::class);
    }

    public function cie()
    {
        return $this->hasOne(Cie::class);
    }
}
