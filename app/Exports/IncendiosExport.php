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
