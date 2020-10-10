<?php

namespace App\Exports;

use App\Fuga;
use Maatwebsite\Excel\Concerns\FromCollection;

class FugasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Fuga::all();
    }
}
