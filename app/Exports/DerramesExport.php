<?php

namespace App\Exports;

use App\Derrame;
use Maatwebsite\Excel\Concerns\FromCollection;

class DerramesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Derrame::all();
    }
}
