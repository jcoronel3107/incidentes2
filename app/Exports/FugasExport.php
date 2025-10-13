<?php

namespace App\Exports;

use App\Fuga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FugasExport implements FromCollection, WithHeadings,ShouldAutoSize
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
        return DB::table('fugas')
        ->join('incidentes','incidentes.id','=','fugas.incidente_id')
        ->join('stations','stations.id','=','fugas.station_id')
        ->join('parroquias','parroquias.id','=','fugas.parroquia_id')
        ->select(
            'fugas.id',
            'fugas.incidente_id',
            'incidentes.nombre_incidente',
            'fugas.tipo_escena',
            'fugas.station_id',
            'fugas.fecha',
            'fugas.direccion',
            'fugas.parroquia_id',
            'parroquias.nombre',
            'fugas.geoposicion',
            'fugas.ficha_ecu911',
            'fugas.hora_fichaecu911',
            'fugas.hora_salida_a_emergencia',
            'fugas.hora_llegada_a_emergencia',
            'fugas.hora_fin_emergencia',
            'fugas.hora_en_base',
            'fugas.informacion_inicial',
            'fugas.detalle_emergencia',
            'fugas.usuario_afectado',
            'fugas.danos_estimados')
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull('fugas.deleted_at')
        ->get();
    }
}
