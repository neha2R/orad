<?php

namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubDepartmentSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('sub_departments')->insert([
            [
                'id'             =>'1',
                'departments_id' =>'3',
                'name'           =>'Business Development Executive',
                'is_active'      =>'1',
                'created_at'     =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'     =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'             =>'2',
                'departments_id' =>'3',
                'name'           =>'Business Development Manager',
                'is_active'      =>'1',
                'created_at'     =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'     =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'             =>'3',
                'departments_id' =>'4',
                'name'           =>'Demo Manager',
                'is_active'      =>'1',
                'created_at'     =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'     =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'             =>'4',
                'departments_id' =>'4',
                'name'           =>'Quality Assurance',
                'is_active'      =>'1',
                'created_at'     =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'     =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'             =>'5',
                'departments_id' =>'7',
                'name'           =>'Talent Hunt',
                'is_active'      =>'1',
                'created_at'     =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'     =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'             =>'6',
                'departments_id' =>'7',
                'name'           =>'Training & Development',
                'is_active'      =>'1',
                'created_at'     =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'     =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'             =>'7',
                'departments_id' =>'7',
                'name'           =>'Performance Management',
                'is_active'      =>'1',
                'created_at'     =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'     =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
        
        
    }
}