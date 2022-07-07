<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Personnel_EmployeeCertification extends Model
{
	protected $connection = 'pgsql';
	protected $table = 'personnel_employeecertification';
	public $timestamps = false;

	
	public function Personnel_Certification(){
		return $this->hasMany(Personnel_Certification::class,'certification_id');
	}

	
}
