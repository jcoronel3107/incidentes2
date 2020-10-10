<?php

namespace App\Exports;

use App\Vehiculo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class VehiculosExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function headings(): array
    {
        return [
            '#',
            'Codigodis',
            'placa',
            'tipo',
            'marca',
            'modelo',
            'clase',
            'pais_orig',
            'anio_fab',
            'carroceria',
            'color1',
            'color2',
            'tonelaje',
            'cilindraje',
            'motor',
            'chasis',
            'station_id',
            'responsab',
            'estado',
            'activo',
            'codigoinv',
            'fechacomp',
            'facturacomp',
            'valorcomp',
            'fechabaja',
            'concepbaja',
            'observacion',
            'kmmantrut',
            'usuacrea',
            'usuaedit',
            'combustible',
            'created_at',
            'updated_at'
        ];
    }

    public function collection()
    {
        return DB::table('vehiculos')
        ->join('stations','stations.id','=','vehiculos.station_id')
        ->select(
        	'vehiculos.id',
        	'vehiculos.codigodis',
        	'vehiculos.placa',
        	'vehiculos.tipo',
        	'vehiculos.marca',
        	'vehiculos.modelo',
        	'vehiculos.clase',
        	'vehiculos.pais_orig',
        	'vehiculos.anio_fab',
        	'vehiculos.carroceria',
        	'vehiculos.color1',
        	'vehiculos.color2',
        	'vehiculos.tonelaje',
        	'vehiculos.cilindraje',
        	'vehiculos.motor',
        	'vehiculos.chasis',
        	'vehiculos.station_id',
        	'vehiculos.responsab',
            'vehiculos.estado',
            'vehiculos.activo',
            'vehiculos.codigoinv',
            'vehiculos.fechacomp',
            'vehiculos.facturacomp',
            'vehiculos.valorcomp',
            'vehiculos.fechabaja',
            'vehiculos.concepbaja',
            'vehiculos.observacion',
            'vehiculos.kmmantrut',
            'vehiculos.usuacrea',
            'vehiculos.usuaedit',
            'vehiculos.combustible',
            'vehiculos.created_at',
            'vehiculos.updated_at',)
        ->get();
    }
}
