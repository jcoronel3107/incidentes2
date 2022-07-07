<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Personnel_Position extends Model
{

	protected $connection = 'pgsql';
	protected $table = 'personnel_position';
	public $timestamps = false;

	
}
