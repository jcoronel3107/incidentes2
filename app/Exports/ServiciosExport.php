<?php

namespace App\Exports;

use App\Clave;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ServiciosExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
	public function headings(): array
    {
        return [
            '#',
            'fecha_salida',
            'fecha_retorno',
            'delegante',
            'unidad',
            'km_salida',
            'km_retorno',
            'asunto',
            'codigodis',
            'user_id',
            'name',
            'usr_creador',
            'usr_editor',
        ];
    }

    public function collection()
    {
        return DB::table('servicios')
        ->join('vehiculos','vehiculos.id','=', 'servicios.vehiculo_id')
        ->join('users','users.id','=','servicios.user_id')
        ->select('servicios.id', 'servicios.fecha_salida', 'servicios.fecha_retorno', 'servicios.delegante', 'servicios.unidad', 'servicios.km_salida', 'servicios.km_retorno', 'servicios.asunto', 'vehiculos.codigodis', 'servicios.user_id','users.name', 'servicios.usr_creador', 'servicios.usr_editor')
        ->get();
    }


}
