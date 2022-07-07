<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Personnel_Department extends Model
{

	protected $connection = 'pgsql';
	protected $table = 'personnel_department';
	public $timestamps = false;

	public function Personnel_Employee(){
		return $this->hasMany(Personnel_Employee::class);
	}
}
