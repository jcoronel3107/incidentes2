<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Responsable;

class TallerBitacoraExport implements FromQuery, Responsable, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function __construct( string $fechaD, string $fechaH,string $vehiculoid,string $aprob,string $liquidad)
    {
        
        $this->fechaD = $fechaD;
        $this->fechaH = $fechaH;
        $this->vehiculoid =  $vehiculoid;
        $this->aprobado = $aprob;
        $this->liquidado = $liquidad;
        return $this;
    }

    public function headings(): array
    {
        return [
            'numero',
            'referencia',
            'taller',
            'codigodis',
            'estacion',
            'kilometraje',
            'descripcion',
            'usuaemite',
            'fechaemite',
            'aprobado',
            'liquidado',
            'usuaaprueba',
            'total',
        ];
    }

    public function query()
    {
        $consulta = DB::connection('mysql2')->table('v_mantenimientos')
        ->join('v_vehiculos','v_mantenimientos.vehiculo','=','v_vehiculos.codigo')
        ->join('v_facturas','v_mantenimientos.factura','=','v_facturas.id')
        ->select('numero','referencia','taller','codigodis','v_mantenimientos.estacion','kilometraje','descripcion','usuaemite','fechaemite','aprobado','liquidado','usuaaprueba','total')
        ->where('v_mantenimientos.vehiculo',$this->vehiculoid)
        ->whereBetween('fechaemite',[$this->fechaD, $this->fechaH])
        ->where('aprobado',$this->aprobado)
        ->where('liquidado',$this->liquidado)
        ->orderByDesc('fechaemite');
        return $consulta;
    }
}
