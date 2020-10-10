<?php

namespace App\Imports;

use App\Vehiculo;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class VehiculosImport extends DefaultValueBinder implements WithCustomValueBinder, ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Vehiculo([
            'codigodis'             =>$row[0],
            'placa'                 =>$row[1],
            'tipo'                  =>$row[2],
            'marca'                 =>$row[3],
            'modelo'                 =>$row[4],
            'clase'                  =>$row[5],
            'pais_orig'              =>$row[6],
            'anio_fab'              =>$row[7],
            'carroceria'              =>$row[8],
            'color1'                =>$row[9],
            'color2'                =>$row[10],
            'tonelaje'                =>$row[11],
            'cilindraje'              =>$row[12],
            'motor'                    =>$row[13],
            'chasis'                 =>$row[14],
            'station_id'                =>$row[15],
            'responsab'            =>$row[16],
            'estado'             =>$row[17],
            'activo'                =>$row[18],
            'codigoinv'                =>$row[19],
            'fechacomp'             =>$row[20],
            'facturacomp'             =>$row[21],
            'valorcomp'           =>$row[22],
            'fechabaja'             =>$row[23],
            'concepbaja'             =>$row[24],
            'observacion'            =>$row[25],
            'kmmantrut'           =>$row[26],
            'usuacrea'             =>$row[27],
            'usuaedit'              =>$row[28],
            'combustible'              =>$row[29]
        ]);
    }
}