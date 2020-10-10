<?php

namespace App\Imports;

use App\Fuga;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class FugasImport extends DefaultValueBinder implements WithCustomValueBinder, ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
         return new Fuga([
            'incidente_id'                  =>$row[0],
            'tipo_escena'                   =>$row[1],
            'station_id'                    =>$row[2],
            'fecha'                         =>$row[3],
            'direccion'                     =>$row[4],
            'parroquia_id'                  =>$row[5],
            'geoposicion'                   =>$row[6],
            'ficha_ecu911'                  =>$row[7],
            'hora_fichaecu911'              =>$row[8],
            'hora_salida_a_emergencia'      =>$row[9],
            'hora_llegada_a_emergencia'     =>$row[10],
            'hora_fin_emergencia'           =>$row[11],
            'hora_en_base'                  =>$row[12],
            'informacion_inicial'           =>$row[13],
            'detalle_emergencia'            =>$row[14],
            'usuario_afectado'              =>$row[15],
            'danos_estimados'               =>$row[16],
            'tipo_cilindro'                 =>$row[17],
            'color_cilindro'                =>$row[18],
            'tipo_fallo'                    =>$row[19],
            'usr_creador'                   =>$row[20]
        ]);
    }
}
