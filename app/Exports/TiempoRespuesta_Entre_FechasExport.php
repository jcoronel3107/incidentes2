<?php

namespace App\Exports;

use App\Incendio;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Responsable;

class TiempoRespuesta_Entre_FechasExport implements FromQuery, Responsable, WithHeadings, ShouldAutoSize
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
        
        $Busquedaentrefechas_TiempoRespuesta = DB::table($this->tabla)
            ->join('incidentes', $this->tabla . '.incidente_id', '=', 'incidentes.id')
            ->join('stations', $this->tabla .'.station_id', '=', 'stations.id')
            ->select(
                $this->tabla . '.id',
                'fecha',
                'incidente_id',
                'nombre_incidente',
                'stations.nombre',
                'direccion',
                'hora_salida_a_emergencia',
                'hora_llegada_a_emergencia',
                 DB::raw('TIMESTAMPDIFF(second, Hora_salida_a_emergencia, Hora_llegada_a_emergencia) as Tiempo_Respuesta'))
            ->whereYear('fecha', '=', date('Y'))
            ->whereNull($this->tabla . '.deleted_at')
            ->whereNotNull($this->tabla . '.hora_llegada_a_emergencia')
            ->whereNotNull($this->tabla . '.hora_fin_emergencia')
            ->whereBetween('fecha', array($this->fechaD, $this->fechaH))
            ->orderByDesc('fecha');
         return $Busquedaentrefechas_TiempoRespuesta;
        
    }

    public function setFileName(): void
    {
        $this->fileName = sprintf('consulta-export-%s.xlsx', now()->timestamp);
    }

    public function headings(): array
    {
        return [
            'id',
            'Fecha',
            'incidente_id',
            'Nombre_incidente',
            'Estacion',
            'Direccion',
            'hora_salida_a_emergencia',
            'hora_llegada_a_emergencia',
            'Tiempo_Respuesta/sec',
        ];
    }

   
}
