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
            'Usuario Afectado',
            'Daños Estimados',
            
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
            'inundacions.direccion',
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
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull('inundacions.deleted_at')
        ->get();
    }
}
