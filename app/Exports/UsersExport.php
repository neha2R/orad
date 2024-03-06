<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class UsersExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('id','email','mobile')->where(['department'=>3,'role'=>2])->get();
    }

    public function headings(): array
    {
        return [
            'User Id',
            'Email',
            'Mobile'
        ];
    }
}
