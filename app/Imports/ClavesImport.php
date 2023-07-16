<?php

namespace App\Imports;

use App\Clave;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class ClavesImport extends DefaultValueBinder implements WithCustomValueBinder, ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
         return new Clave([
            'id'                  =>$row[0],
            'km_salida'           =>$row[2],
            'km_gasolinera'       =>$row[3],
            'km_llegada'          =>$row[4],
            'dolares'             =>$row[5],
            'galones'             =>$row[6],
            'combustible'         =>$row[7],
            'gasolinera_id'       =>$row[10],
            'user_id'             =>$row[15],
            'vehiculo_id'         =>$row[12],
            'Orden'               =>$row[8],
            'factura'             =>$row[9],
            'usr_creador'         =>$row[14],
            'usr_editor'          =>$row[17]
        ]);
        
    }
}
