<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;


class Solicitud extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $fillable=[
        "vehiculo_id",
        "user_id",
        "gasolinera_id",
        "combustible",
        "status"
        ];
    
   

    public static $status = ['Solicitado', 'Confirmado', 'Cancelado'];

    public function user(){
		return $this->belongsTo(User::class);
	}

    public function vehiculo(){
		return $this->belongsTo(Vehiculo::class);
	}

  public function gasolinera(){
		return $this->belongsTo(Gasolinera::class);
	}

    
}
