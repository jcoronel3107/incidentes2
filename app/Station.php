<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Station extends Model
{
    //
    use LogsActivity;
    use SoftDeletes;
    protected $fillable=[
    	"nombre"];

    protected static $logFillable = true;

    public function inundacion(){
	//Muestra informacion de las Claves14 por id de vehiculo
	return $this->hasMany(Inundacion::class);
}

	public function vehiculo(){
	//Muestra informacion de las Claves14 por id de vehiculo
	return $this->belongsTo(Inundacion::class);
}


}
