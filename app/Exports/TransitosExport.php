<?php

namespace App\Exports;

use App\Transito;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransitosExport implements FromCollection, WithHeadings,ShouldAutoSize
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
        return DB::table('transitos')
        ->join('incidentes','incidentes.id','=','transitos.incidente_id')

        ->join('stations','stations.id','=','transitos.station_id')
        ->join('parroquias','parroquias.id','=','transitos.parroquia_id')
        ->select(
        	'transitos.id',
        	'transitos.incidente_id',
        	'incidentes.nombre_incidente',
        	'transitos.tipo_escena',
        	'transitos.station_id',
        	'transitos.fecha',
        	'transitos.direccion',
        	'transitos.parroquia_id',
        	'parroquias.nombre',
        	'transitos.geoposicion',
        	'transitos.ficha_ecu911',
        	'transitos.hora_fichaecu911',
        	'transitos.hora_salida_a_emergencia',
        	'transitos.hora_llegada_a_emergencia',
        	'transitos.hora_fin_emergencia',
        	'transitos.hora_en_base',
        	'transitos.informacion_inicial',
        	'transitos.detalle_emergencia',
        	'transitos.usuario_afectado',
        	'transitos.danos_estimados')
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull('transitos.deleted_at')
        ->get();
    }
}
