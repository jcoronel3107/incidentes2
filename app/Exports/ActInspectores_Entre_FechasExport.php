<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Responsable;

class ActInspectores_Entre_FechasExport implements FromQuery, Responsable, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    /** @var null */
    private $fileName = null;
    public function __construct( string $fechaD, string $fechaH)
    {
        
        $this->fechaD = $fechaD;
        $this->fechaH = $fechaH;
        return $this;
    }

    public function query()
    {

            $cant_actividades_usuario_entre_fechas = DB::table('movilizacions')
            ->join('actividads','movilizacion_id','=','movilizacions.id')
            ->join('users','user_id','=','users.id')
            ->join('vehiculos','vehiculo_id','=','vehiculos.id')
            ->select('movilizacions.id','movilizacions.fecha_salida','movilizacions.fecha_retorno','movilizacions.km_salida','movilizacions.km_retorno','movilizacions.user_id','users.name','movilizacions.vehiculo_id','vehiculos.codigodis','movilizacions.observaciones','actividads.descripcion', 'detalle')
            ->whereNull('movilizacions.deleted_at')
            ->whereBetween('fecha_salida', array($this->fechaD, $this->fechaH))
            ->whereYear('fecha_salida', '=', date('Y'))
            ->orderByDesc('fecha_salida');
            //dd($cant_actividades_usuario_entre_fechas);
            return $cant_actividades_usuario_entre_fechas;
        
    }

    public function headings(): array
    {
        return [
            'id',
            'Fecha_salida',
            'Fecha_retorno',
            'Km_salida',
            'Km_retorno',
            'User_id',
            'Name',
            'Vehiculo_id',
            'Codigo_Dis',
            'Observaciones',
            'Actividad',
            'Detalle',   
        ];
    }

   
}
