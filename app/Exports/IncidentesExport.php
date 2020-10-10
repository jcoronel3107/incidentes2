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
            '#id',
            'tipo_incidente',
            'nombre_incidente',
            'created_at',
            'updated_at',
        ];
    }
    public function collection()
    {
        return Incidente::all();
    }
}