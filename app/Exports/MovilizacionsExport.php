<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MovilizacionsExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
	public function headings(): array
    {
        return [
            'id',
            'Fecha Salida',
            'Fecha Retorno',
            'Km Salida',
            'Km Retorno',
            'User ID',
            'Nombre',
            'Vehiculo ID',
            'Codigo Dis',
            'Observaciones',
            'Actividad',
            'Detalle',   
        ];
    }

    public function collection()
    {
        $result= DB::table('movilizacions')
            ->join('actividads','movilizacion_id','=','movilizacions.id')
            ->join('users','user_id','=','users.id')
            ->join('vehiculos','vehiculo_id','=','vehiculos.id')
            ->select('movilizacions.id','movilizacions.fecha_salida','movilizacions.fecha_retorno','movilizacions.km_salida','movilizacions.km_retorno','movilizacions.user_id','users.name','movilizacions.vehiculo_id','vehiculos.codigodis','movilizacions.observaciones','actividads.descripcion', 'detalle')
            ->whereNull('movilizacions.deleted_at')
            ->whereYear('fecha_salida', '=', date('Y'))
            ->orderByDesc('fecha_salida')
            ->get();
            return $result;
            
    }


}
