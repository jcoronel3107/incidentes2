<?php

namespace App\Imports;
use App\Cie;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class CieImport extends DefaultValueBinder implements WithCustomValueBinder, ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Cie([
            'codigo'                  =>$row[0],
            'padre'                   =>$row[1],
            'concepto'                =>$row[2],
            'nivel'                   =>$row[3]
        ]);
    }
}
