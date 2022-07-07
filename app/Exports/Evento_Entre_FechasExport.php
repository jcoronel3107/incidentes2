<?php

namespace App\Exports;

use App\Incendio;

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
    public function __construct(string $tabla, string $fechaD, string $fechaH)
    {
        
        $this->fechaD = $fechaD;
        $this->fechaH = $fechaH;
        $this->modelo = ucwords( substr($tabla, 0, -1));
        $this->tabla =  $tabla;
        $this->setFileName();
        return $this;
    }

    public function query()
    {
        if($this->tabla == '*'){
            $salud =  DB::table('saluds')
            ->join('incidentes', 'saluds.incidente_id', '=', 'incidentes.id')
            ->join('stations', 'saluds.station_id', '=', 'stations.id')
            ->select(
                    'fecha',
                    'nombre_incidente',
                    'direccion',
                    'geoposicion',
                    'ficha_ecu911',
                    'nombre',
                    'informacion_inicial',
                    'detalle_emergencia',
                    'hora_fichaecu911',
                    'hora_salida_a_emergencia',
                    'hora_llegada_a_emergencia',
                    'hora_fin_emergencia',
                    'hora_en_base'
            )
            ->whereNull('saluds.deleted_at')
            ->whereBetween('fecha', array($this->fechaD, $this->fechaH))
            ->orderByDesc('fecha');

            $incendio =  DB::table('incendios')
            ->join('incidentes', 'incendios.incidente_id', '=', 'incidentes.id')
            ->join('stations', 'incendios.station_id', '=', 'stations.id')
            ->select(
                    'fecha',
                    'nombre_incidente',
                    'direccion',
                    'geoposicion',
                    'ficha_ecu911',
                    'nombre',
                    'informacion_inicial',
                    'detalle_emergencia',
                    'hora_fichaecu911',
                    'hora_salida_a_emergencia',
                    'hora_llegada_a_emergencia',
                    'hora_fin_emergencia',
                    'hora_en_base'
            )
            ->whereNull('incendios.deleted_at')
            ->whereBetween('fecha', array($this->fechaD, $this->fechaH))
            ->orderByDesc('fecha');

            $derrames =  DB::table('derrames')
            ->join('incidentes', 'derrames.incidente_id', '=', 'incidentes.id')
            ->join('stations', 'derrames.station_id', '=', 'stations.id')
            ->select(
                    'fecha',
                    'nombre_incidente',
                    'direccion',
                    'geoposicion',
                    'ficha_ecu911',
                    'nombre',
                    'informacion_inicial',
                    'detalle_emergencia',
                    'hora_fichaecu911',
                    'hora_salida_a_emergencia',
                    'hora_llegada_a_emergencia',
                    'hora_fin_emergencia',
                    'hora_en_base'
            )
            ->whereNull('derrames.deleted_at')
            ->whereBetween('fecha', array($this->fechaD, $this->fechaH))
            ->orderByDesc('fecha');

            $inundacions =  DB::table('inundacions')
            ->join('incidentes', 'inundacions.incidente_id', '=', 'incidentes.id')
            ->join('stations', 'inundacions.station_id', '=', 'stations.id')
            ->select(
                    'fecha',
                    'nombre_incidente',
                    'direccion',
                    'geoposicion',
                    'ficha_ecu911',
                    'nombre',
                    'informacion_inicial',
                    'detalle_emergencia',
                    'hora_fichaecu911',
                    'hora_salida_a_emergencia',
                    'hora_llegada_a_emergencia',
                    'hora_fin_emergencia',
                    'hora_en_base'
            )
            ->whereNull('inundacions.deleted_at')
            ->whereBetween('fecha', array($this->fechaD, $this->fechaH))
            ->orderByDesc('fecha');

            $transitos =  DB::table('transitos')
            ->join('incidentes', 'transitos.incidente_id', '=', 'incidentes.id')
            ->join('stations', 'transitos.station_id', '=', 'stations.id')
            ->select(
                    'fecha',
                    'nombre_incidente',
                    'direccion',
                    'geoposicion',
                    'ficha_ecu911',
                    'nombre',
                    'informacion_inicial',
                    'detalle_emergencia',
                    'hora_fichaecu911',
                    'hora_salida_a_emergencia',
                    'hora_llegada_a_emergencia',
                    'hora_fin_emergencia',
                    'hora_en_base'
            )
            ->whereNull('transitos.deleted_at')
            ->whereBetween('fecha', array($this->fechaD, $this->fechaH))
            ->orderByDesc('fecha');
            
            $incendio->union($salud);
            $incendio->union($transitos);
            $incendio->union($derrames);
            $incendio->union($inundacions);
           $downloadbusquedaentrefechas = $incendio;
           return $downloadbusquedaentrefechas;
           }
           else{        
                $downloadbusquedaentrefechas =  DB::table($this->tabla)
                ->join('incidentes', $this->tabla . '.incidente_id', '=', 'incidentes.id')
                ->join('stations', $this->tabla .'.station_id', '=', 'stations.id')
                ->select(
                    'fecha',
                    'nombre_incidente',
                    'direccion',
                    'geoposicion',
                    'ficha_ecu911',
                    'nombre',
                    'informacion_inicial',
                    'detalle_emergencia',
                    'hora_fichaecu911',
                    'hora_salida_a_emergencia',
                    'hora_llegada_a_emergencia',
                    'hora_fin_emergencia',
                    'hora_en_base'
                )
                
                ->whereNull($this->tabla . '.deleted_at')
                ->whereBetween('fecha', array($this->fechaD, $this->fechaH))
                ->orderByDesc('fecha');
                return $downloadbusquedaentrefechas;
           }
        
    }

    public function setFileName(): void
    {
        $this->fileName = sprintf('consulta-export-%s.xlsx', now()->timestamp);
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Nombre_incidente',
            'Direccion',
            'Geoposicion',
            'Ficha_ecu911',
            'Estacion',
            'Informacion_inicial',
            'Detalle_emergencia',
            'Hora_fichaecu911',
            'Hora_salida_a_emergencia',
            'Hora_llegada_a_emergencia',
            'Hora_fin_emergencia',
            'Hora_en_base',   
        ];
    }

   
}
