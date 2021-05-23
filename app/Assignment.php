<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use SoftDeletes;

    protected $fillable=[
        
        "color",
        "textColor",
        "start",
        "end",
        "reporte_conductor",
        "estado",
        "vehiculo_id",
        "conductor_id",
        "solicitud_id",
        ];
    //protected $guarded = [];

    protected $casts = [
        'start' => 'datetime',
        'end'   => 'datetime',
    ];

    public static $estado = ['En Curso','Finalizado'];

    public function solicitud(){
		
		return $this->belongsTo(Solicitud::class);
	}
   
}
