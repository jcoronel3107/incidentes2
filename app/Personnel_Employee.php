<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personnel_Employee extends Model
{

	protected $connection = 'pgsql';
	protected $table = 'personnel_employee';
	public $timestamps = false;


	public function Personnel_EmployeeCertification(){
		return $this->belongsToMany(Personnel_Certification::class, 'personnel_employeecertification', 'employee_id', 'certification_id');
	}

	public function Personnel_Department(){
		return $this->belongsTo(Personnel_Department::class,'department_id');
	}
	public function Personnel_Position(){
		return $this->belongsTo(Personnel_Position::class,'position_id');
	}
}
