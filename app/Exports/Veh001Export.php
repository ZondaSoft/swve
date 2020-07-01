<?php

namespace App\Exports;

use App\Veh001;
use Maatwebsite\Excel\Concerns\FromCollection;

class Veh001Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Veh001::all();
    }
}
