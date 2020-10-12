<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Incidente extends Model
{
    //
    use LogsActivity;
	use SoftDeletes;

	protected $fillable=[
		"tipo_incidente",
		"nombre_incidente"];

	protected static $logFillable = true;
}
