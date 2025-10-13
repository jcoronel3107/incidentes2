<?php

namespace App\Exports;

use App\Salud;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SaludsExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

     public function headings(): array
    {
        return [
            '#',
            'Incidente ID',
            'Nombre Incidente',
            'Tipo Escena',
            'Estación ID',
            'Fecha',
            'Dirección',
            'Parroquia ID',
            'Parroquia',
            'Geoposición',
            'Ficha ECU-911',
            'Hora Ficha ECU-911',
            'Hora Salida a Emergencia',
            'Hora Llegada a Emergencia',
            'Hora Fin Emergencia',
            'Hora en Base',
            'Información Inicial',
            'Detalle Emergencia',
            
        ];
    }

    public function collection()
    {
        return DB::table('saluds')
        ->join('incidentes','incidentes.id','=','saluds.incidente_id')
        ->join('stations','stations.id','=','saluds.station_id')
        ->join('parroquias','parroquias.id','=','saluds.parroquia_id')
        ->select(
        	'saluds.id',
        	'saluds.incidente_id',
        	'incidentes.nombre_incidente',
        	'saluds.tipo_escena',
        	'saluds.station_id',
        	'saluds.fecha',
        	'saluds.direccion',
        	'saluds.parroquia_id',
        	'parroquias.nombre',
        	'saluds.geoposicion',
        	'saluds.ficha_ecu911',
        	'saluds.hora_fichaecu911',
        	'saluds.hora_salida_a_emergencia',
        	'saluds.hora_llegada_a_emergencia',
        	'saluds.hora_fin_emergencia',
        	'saluds.hora_en_base',
        	'saluds.informacion_inicial',
        	'saluds.detalle_emergencia')
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull('saluds.deleted_at')
        ->get();
    }
}
