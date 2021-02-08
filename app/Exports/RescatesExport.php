<?php

namespace App\Exports;

use App\Rescate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RescatesExport implements FromCollection, WithHeadings,ShouldAutoSize
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
        return DB::table('rescates')
        ->join('incidentes','incidentes.id','=','rescates.incidente_id')

        ->join('stations','stations.id','=','rescates.station_id')
        ->join('parroquias','parroquias.id','=','rescates.parroquia_id')
        ->select(
        	'rescates.id',
        	'rescates.incidente_id',
        	'incidentes.nombre_incidente',
        	'rescates.tipo_escena',
        	'rescates.station_id',
        	'rescates.fecha',
        	'rescates.direccion',
        	'rescates.parroquia_id',
        	'parroquias.nombre',
        	'rescates.geoposicion',
        	'rescates.ficha_ecu911',
        	'rescates.hora_fichaecu911',
        	'rescates.hora_salida_a_emergencia',
        	'rescates.hora_llegada_a_emergencia',
        	'rescates.hora_fin_emergencia',
        	'rescates.hora_en_base',
        	'rescates.informacion_inicial',
        	'rescates.detalle_emergencia',
        	'rescates.usuario_afectado',
        	'rescates.danos_estimados')
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull('rescates.deleted_at')
        ->get();
    }
}
