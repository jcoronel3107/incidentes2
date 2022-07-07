<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DisponibilidadUserExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'Nombre',
            'Apellido',
            'Cedula',
            'Genero',
            'birthday',
            'address',
            'Mobile',
            'Hire_Date',
            'Email',
        ];
    }

    public function collection()
    {
        return DB::connection('pgsql')->table('personnel_employee')
        ->join('personnel_employeecertification','personnel_employee.id','=','personnel_employeecertification.employee_id')
        ->join('personnel_certification','personnel_certification.id','=','personnel_employeecertification.certification_id')
        ->select('first_name','last_name','passport','gender','birthday','address','mobile','hire_date','email')
        ->where('status','=',0)
        ->orderByDesc('personnel_employee.hire_date')
        ->get();
    }
}
