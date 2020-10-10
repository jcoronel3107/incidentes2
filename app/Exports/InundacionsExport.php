<?php

namespace App\Exports;

use App\Inundacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InundacionsExport implements FromCollection, WithHeadings,ShouldAutoSize
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
            'address',
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
            'Jefeguardia_id',
            'Nombre_Jefeguardia',
        ];
    }

    public function collection()
    {
        return DB::table('inundacions')
        ->join('incidentes','incidentes.id','=','inundacions.incidente_id')

        ->join('stations','stations.id','=','inundacions.station_id')
        ->join('parroquias','parroquias.id','=','inundacions.parroquia_id')
        ->select(
        	'inundacions.id',
        	'inundacions.incidente_id',
        	'incidentes.nombre_incidente',
        	'inundacions.tipo_escena',
        	'inundacions.station_id',
        	'inundacions.fecha',
        	'inundacions.address',
        	'inundacions.parroquia_id',
        	'parroquias.nombre',
        	'inundacions.geoposicion',
        	'inundacions.ficha_ecu911',
        	'inundacions.hora_fichaecu911',
        	'inundacions.hora_salida_a_emergencia',
        	'inundacions.hora_llegada_a_emergencia',
        	'inundacions.hora_fin_emergencia',
        	'inundacions.hora_en_base',
        	'inundacions.informacion_inicial',
        	'inundacions.detalle_emergencia',
        	'inundacions.usuario_afectado',
        	'inundacions.danos_estimados')
        ->get();
    }
}
