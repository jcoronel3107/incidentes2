<?php

namespace App\Exports;

use App\Parroquia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ParroquiasExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'created_at',
            'updated_at',
        ];
    }

    public function collection()
    {
        return Parroquia::all();
    }
}
