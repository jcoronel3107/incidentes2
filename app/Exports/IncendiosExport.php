<?php

namespace App\Exports;

use App\Incendio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class IncendiosExport implements FromCollection, WithHeadings,ShouldAutoSize
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
        return DB::table('incendios')
        ->join('incidentes','incidentes.id','=','incendios.incidente_id')
        ->join('stations','stations.id','=','incendios.station_id')
        ->join('parroquias','parroquias.id','=','incendios.parroquia_id')
        ->select(
            'incendios.id',
            'incendios.incidente_id',
            'incidentes.nombre_incidente',
            'incendios.tipo_escena',
            'incendios.station_id',
            'incendios.fecha',
            'incendios.direccion',
            'incendios.parroquia_id',
            'parroquias.nombre',
            'incendios.geoposicion',
            'incendios.ficha_ecu911',
            'incendios.hora_fichaecu911',
            'incendios.hora_salida_a_emergencia',
            'incendios.hora_llegada_a_emergencia',
            'incendios.hora_fin_emergencia',
            'incendios.hora_en_base',
            'incendios.informacion_inicial',
            'incendios.detalle_emergencia',
            'incendios.usuario_afectado',
            'incendios.danos_estimados')
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull('incendios.deleted_at')
        ->get();
    }
}
