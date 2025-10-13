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
            'Codigo Dis',
            'Placa',
            'Tipo',
            'Marca',
            'Modelo',
            'Clase',
            'País Origen',
            'Año Fabricación',
            'Carroceria',
            'Color 1',
            'Color 2',
            'Tonelaje',
            'Cilindraje',
            'Motor',
            'Chasis',
            'Estación ID',
            'Responsable',
            'Estado',
            'Activo',
            'codigoinv',
            'Fecha Compra',
            'Factura Compra',
            'Valor Compra',
            'Fecha Baja',
            'Concepto Baja',
            'Observación',
            'Km Ant Rut',
            'Usuario Creación',
            'Usuario Edición',
            'Combustible',
            'Fecha Creación',
            'Fecha Actualización',
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
