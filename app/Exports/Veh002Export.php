<?php

namespace App\Exports;

use App\Veh002;
use Maatwebsite\Excel\Concerns\FromCollection;

class Veh002Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Veh002::all();
    }
}
