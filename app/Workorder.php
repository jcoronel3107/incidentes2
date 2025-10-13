<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;


class Workorder extends Model
{
    
    use LogsActivity;
	use SoftDeletes;

    protected $fillable=[
        "nro_orden",
        "fecha",
        "km_ingreso",
        "maintenance_request_id",
        "status"
		];

    public static $status = ['Anulada', 'Liquidada','Asignada'];
    
    public function maintenance_request(){
		
		return $this->belongsTo(maintenance_request::class);
	}

    public function mecanico(){
		
		return $this->belongsToMany(Mecanico::class);
	}
}
