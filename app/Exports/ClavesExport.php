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
            'Fecha_Creacion',
            'Km_salida',
            'Km_gasolinera',
            'Km_llegada',
            'Dolares',
            'Galones',
            'Combustible',
            'Nro Orden',
            'Factura',
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
        ->select('claves.id','claves.created_at','claves.km_salida','claves.km_gasolinera','claves.km_llegada','claves.dolares','claves.galones','claves.combustible','claves.orden','claves.factura','gasolineras.razonsocial','vehiculos.codigodis','users.name')
        ->get();
    }


}
