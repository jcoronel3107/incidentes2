<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Actividad extends Model
{
    use LogsActivity;
    use SoftDeletes;
    protected $fillable=[
    	"descripcion",
    	"detalle",
		];

        protected static $logFillable = true;

    public function movilizacion()
    {
        return $this->belongsTo(Movilizacion::class);
    }
}
