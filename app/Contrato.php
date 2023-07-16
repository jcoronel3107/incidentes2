<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Contrato extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable=[
		"denominacion",
		"fecha",
		"plazo",
		"valor",
    "gasolinera_id"];

    protected static $logFillable = true;

    public function gasolinera(){
		  return $this->belongsTo(Gasolinera::class);
	}
}
