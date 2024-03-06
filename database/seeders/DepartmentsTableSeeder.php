<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('departments')->delete();
        
        \DB::table('departments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Administrator',
                'is_active' => 1,
                'created_at' => '2021-03-26 09:56:11',
                'updated_at' => '2021-03-26 09:56:11',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Marketing',
                'is_active' => 1,
                'created_at' => '2021-03-26 09:56:21',
                'updated_at' => '2021-03-26 09:56:21',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Training',
                'is_active' => 1,
                'created_at' => '2021-04-02 06:16:36',
                'updated_at' => '2021-04-02 06:16:36',
            ),
        ));
        
        
    }
}