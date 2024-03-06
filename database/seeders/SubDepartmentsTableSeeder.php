<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubDepartmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sub_departments')->delete();
        
        \DB::table('sub_departments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'CEO',
                'department' => 1,
                'is_active' => 1,
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Admin',
                'department' => 1,
                'is_active' => 1,
                'created_at' => '2021-03-26 09:56:46',
                'updated_at' => '2021-03-26 09:56:46',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Sales',
                'department' => 2,
                'is_active' => 1,
                'created_at' => '2021-03-26 09:56:58',
                'updated_at' => '2021-03-26 09:56:58',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Training',
                'department' => 3,
                'is_active' => 1,
                'created_at' => '2021-04-02 06:16:50',
                'updated_at' => '2021-04-02 06:16:50',
            ),
        ));
        
        
    }
}