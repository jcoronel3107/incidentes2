<?php

namespace App\Exports;



use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Responsable;

class ActVehiculos_Entre_FechasExport implements FromQuery, Responsable, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    /** @var null */
    private $fileName = null;
    public function __construct(string $vehiculo, string $fechaD, string $fechaH)
    {
        
        $this->fechaD = $fechaD;
        $this->fechaH = $fechaH;
        $this->vehiculo =  $vehiculo;
        return $this;
    }

    public function query()
    {

            $cant_actividades_vehiculo_entre_fechas = DB::table('movilizacions')
            ->join('actividads','movilizacion_id','=','movilizacions.id')
            ->join('vehiculos','vehiculo_id','=','vehiculos.id')
            ->select('movilizacions.id','movilizacions.fecha_salida','movilizacions.fecha_retorno','movilizacions.km_salida','movilizacions.km_retorno','movilizacions.vehiculo_id','vehiculos.codigodis','movilizacions.observaciones','actividads.descripcion', 'detalle')
            ->where('vehiculo_id','=',$this->vehiculo)
            ->whereNull('movilizacions.deleted_at')
            ->whereBetween('fecha_salida', array($this->fechaD, $this->fechaH))
            
            ->orderByDesc('fecha_salida');
           
            return $cant_actividades_vehiculo_entre_fechas;
        
    }

    public function headings(): array
    {
        return [
            'id',
            'Fecha_salida',
            'Fecha_retorno',
            'Km_salida',
            'Km_retorno',
            'Vehiculo_id',
            'CodigoDis',
            'Observaciones',
            'Actividad',
            'Detalle',   
        ];
    }

   
}
