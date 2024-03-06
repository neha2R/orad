<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DiscountManagment;

class DiscountManager extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dep=[2];
        $role=[2,3];
        foreach ($dep as $key => $value) {
            foreach ($role as $key => $value1) {
                DiscountManagment::create(['role'=>$value1,'department'=>$value]);
            }
        }

      
    }
}
