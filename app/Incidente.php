<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Incidente extends Model
{
    //
	use SoftDeletes;
	protected $fillable=[
		"tipo_incidente",
		"nombre_incidente"];
}
