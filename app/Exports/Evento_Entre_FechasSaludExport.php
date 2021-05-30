<?php

namespace App\Exports;

use App\Salud;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Responsable;

class Evento_Entre_FechasSaludExport implements FromQuery, Responsable, WithHeadings, ShouldAutoSize
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
        
        
            $downloadbusquedaentrefechas =  DB::table($this->tabla)
            ->join('incidentes', $this->tabla . '.incidente_id', '=', 'incidentes.id')
            ->join('stations', $this->tabla .'.station_id', '=', 'stations.id')
            ->join('pacientes',$this->tabla .'.id', '=', 'pacientes.salud_id')
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
                'hora_en_base',
                'paciente',
                'edad',
                'genero',
                'presion1',
                'presion2',
                'temperatura',
                'glasglow',
                'saturacion','Frecuencia_Cardiaca','Frecuencia_Respiratoria','Glicemia','hojapre','casasalud'
            )
            ->whereYear('fecha', '=', date('Y'))
            ->whereNull($this->tabla . '.deleted_at')
            ->whereBetween('fecha', array($this->fechaD, $this->fechaH))
            ->orderByDesc('fecha');
            return $downloadbusquedaentrefechas;
        
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
            'Paciente',
                'Edad',
                'Genero',
                'Presion1',
                'Presion2',
                'Temperatura',
                'Glasglow',
                'Saturacion','Frecuencia_Cardiaca','Frecuencia_Respiratoria','Glicemia','Hoja-Prehospitalaria','Casa-salud' 
        ];
    }

   
}
