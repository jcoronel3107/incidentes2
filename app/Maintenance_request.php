<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Maintenance_request extends Model
{
    use LogsActivity;
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        "fecha",
        "descripcion",
        "user_id",
        "vehiculo_id",
        "km_ingreso",
        "status"
        ];
    
    protected $casts = [
        'fecha' => 'datetime'
    ];

    public static $status = ['Solicitado', 'Asignado', 'Cancelado','Finalizado'];

    public function user(){
		return $this->belongsTo(User::class);
	}

    public function vehiculo(){
		
		return $this->belongsTo(Vehiculo::class);
	}

    public function workorder(){
        return $this->hasMany(Workorder::class);
    }
}
