<?php

namespace App\Exports;

use App\Incidente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;



class IncidentesExport implements FromCollection, WithHeadings,ShouldAutoSize
{
	public function headings(): array
    {
        return [
            '#ID',
            'Tipo Incidente',
            'Nombre Incidente',
            'Fecha Creación',
            'Fecha Actualización'
        ];
    }
    public function collection()
    {
        return Incidente::all();
    }
    
}