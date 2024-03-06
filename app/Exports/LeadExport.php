<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
class LeadExport implements  FromQuery, WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            // 'Employee id',
            'Name',
            'Mobile',
            'Email',
            'Gender',
            'Edu Level',
            'Growth',
            'State',
        ];
    }

    public function query()
    {
        return User::where(['user_type'=>'2','is_scholorship_user'=>'0']);
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
            $user->mobile,
            $user->email,
            userDetails($user->id, 'gender') ? 'Female' : 'Male',
            educationDetails(userDetails($user->id, 'edulevel')),
            growthDetails(userDetails($user->id, 'growth')),
            userDetails($user->id, 'state')
        ];
    }
}
