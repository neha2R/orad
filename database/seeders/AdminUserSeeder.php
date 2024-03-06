<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'rahul modi',
            'email'=>'admin@orad.in',
            'mobilecode'=>'+91',
            'mobile'=>'9024829041',
            'department'=>0,
            'role'=>1,
            'password' => Hash::make('123456'),
        ]);
    }
}
