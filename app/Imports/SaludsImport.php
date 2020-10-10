<?php

namespace App\Imports;

use App\Salud;
use Maatwebsite\Excel\Concerns\ToModel;

class SaludsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Salud([
            //
        ]);
    }
}
