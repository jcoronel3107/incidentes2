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
            'Hora llegada a Emergencia',
            'Hora fin Emergencia',
            'Hora en Base',
            'Información Inicial',
            'Detalle Emergencia',
            'Usuario Afectado',
            'Daños Estimados',
            
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
