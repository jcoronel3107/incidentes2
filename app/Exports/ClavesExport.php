<?php

namespace App\Exports;

use App\Clave;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ClavesExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
	public function headings(): array
    {
        return [
            '#',
            'Km_salida',
            'Km_gasolinera',
            'Km_llegada',
            'Dolares',
            'Galones',
            'Combustible',
            'Razonsocial',
            'Vehiculo',
            'Conductor',
        ];
    }

    public function collection()
    {
        return DB::table('claves')
        ->join('vehiculos','vehiculos.id','=','claves.vehiculo_id')
        ->join('users','users.id','=','claves.user_id')
        ->join('gasolineras','gasolineras.id','=','claves.gasolinera_id')
        ->select('claves.id','claves.km_salida','claves.km_gasolinera','claves.km_llegada','claves.dolares','claves.galones','claves.combustible','gasolineras.razonsocial','vehiculos.codigodis','users.name')
        ->get();
    }


}
