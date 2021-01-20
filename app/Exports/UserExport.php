<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection
{

    use Exportable;
    public function collection()
    {
        // TODO: Implement collection() method.
        return User::all();
    }
}
