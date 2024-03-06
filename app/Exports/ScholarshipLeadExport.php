<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
class ScholarshipLeadExport implements  FromQuery, WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            // 'Employee id',
            'Name',
            'Gurdian',
            'Occupation',
            'Mobile',
            'Email',
            'School',
            'Class',
            'State',
            'City',
        ];
    }

    public function query()
    {
        return User::where(['user_type'=>'2','is_scholorship_user'=>'1']);
    }

    /**
     * 
     * @var User $user
     */
    public function map($user): array
    {
        return [
            // $user->user_id,
            ucwords($user->name),
            parentDetails($user->id, 'father_name'),
            parentDetails($user->id, 'father_occupation'),
            $user->mobile,
            $user->email,
            parentDetails($user->id, 'name', 'schoolDetails'),
            parentDetails($user->id, 'class'),
            parentDetails($user->id, 'name','stateDetails'),
            parentDetails($user->id, 'name','cityDetails'),
        ];
    }
}
