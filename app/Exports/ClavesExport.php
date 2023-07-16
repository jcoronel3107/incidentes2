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
            'Station_id',
            'Razonsocial',
            'Vehiculo_id',
            'Vehiculo',
            'usr_creador',
            'Conductor_id',
            'Conductor',
            'usr_editor'
        ];
    }

    public function collection()
    {
        return DB::table('claves')
        ->join('vehiculos','vehiculos.id','=','claves.vehiculo_id')
        ->join('users','users.id','=','claves.user_id')
        ->join('gasolineras','gasolineras.id','=','claves.gasolinera_id')
        ->select('claves.id','claves.created_at','claves.km_salida','claves.km_gasolinera','claves.km_llegada','claves.dolares','claves.galones','claves.combustible','claves.orden','claves.factura','claves.gasolinera_id','gasolineras.razonsocial','claves.vehiculo_id','vehiculos.codigodis','usr_creador','claves.user_id','users.name','usr_editor')
        ->get();
    }


}
