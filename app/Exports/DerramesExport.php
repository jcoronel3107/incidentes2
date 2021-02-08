<?php

namespace App\Exports;

use App\Derrame;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DerramesExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            '#',
            'Incidente_id',
            'Nombre_incidente',
            'Tipo_escena',
            'Estation_id',
            'Fecha',
            'Direccion',
            'Parroquia_id',
            'Parroquia',
            'Geoposicion',
            'Ficha_ecu911',
            'Hora_fichaecu911',
            'Hora_salida_a_emergencia',
            'Hora_llegada_a_emergencia',
            'Hora_fin_emergencia',
            'Hora_en_base',
            'Informacion_inicial',
            'Detalle_emergencia',
            'Usuario_afectado',
            'Danos_estimados',
            
        ];
    }

    public function collection()
    {
        return DB::table('derrames')
        ->join('incidentes','incidentes.id','=','derrames.incidente_id')
        ->join('stations','stations.id','=','derrames.station_id')
        ->join('parroquias','parroquias.id','=','derrames.parroquia_id')
        ->select(
            'derrames.id',
            'derrames.incidente_id',
            'incidentes.nombre_incidente',
            'derrames.tipo_escena',
            'derrames.station_id',
            'derrames.fecha',
            'derrames.direccion',
            'derrames.parroquia_id',
            'parroquias.nombre',
            'derrames.geoposicion',
            'derrames.ficha_ecu911',
            'derrames.hora_fichaecu911',
            'derrames.hora_salida_a_emergencia',
            'derrames.hora_llegada_a_emergencia',
            'derrames.hora_fin_emergencia',
            'derrames.hora_en_base',
            'derrames.informacion_inicial',
            'derrames.detalle_emergencia',
            'derrames.usuario_afectado',
            'derrames.danos_estimados')
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull('derrames.deleted_at')
        ->get();
    }
}
