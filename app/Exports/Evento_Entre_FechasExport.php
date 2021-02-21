<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Responsable;

class Evento_Entre_FechasExport implements FromQuery, Responsable, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    /** @var null */
    private $fileName = null;
    public function __construct()
    {
        $this->setFileName();
    }

    public function query()
    {
        $downloadbusquedaentrefechas = DB::table($tabla)
        ->join('incidentes', $tabla . '.incidente_id', '=', 'incidentes.id')
        /* ->select('nombre_incidente', DB::raw('count(station_id) salidas')) */
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull($tabla . '.deleted_at')
        ->whereBetween('fecha', array($fechaD, $fechaH))
        ->groupBy('nombre_incidente')
        ->havingRaw('count(station_id) >= ?', [1])
        ->get();
        return $downloadbusquedaentrefechas;
    }

    public function setFileName(): void
    {
        $this->fileName = sprintf('users-export-%s.xlsx', now()->timestamp);
    }

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
            
        ];
    }

   
}
