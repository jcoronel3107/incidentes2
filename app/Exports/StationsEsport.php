<?php

namespace App\Exports;

use App\Station;
use Maatwebsite\Excel\Concerns\FromCollection;

class StationsEsport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Station::all();
    }
}
