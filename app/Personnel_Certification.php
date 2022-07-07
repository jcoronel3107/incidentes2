<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Personnel_Certification extends Model
{

	protected $connection = 'pgsql';
	protected $table = 'personnel_certification';
	public $timestamps = false;

	public function Personnel_EmployeeCertification(){
		return $this->belongsToMany(Personnel_Employee::class, 'personnel_employeecertification', 'certification_id', 'employee_id');
	}
}
