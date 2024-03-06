<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('departments')->insert([
            [
                'id'         =>'1',
                'title'      =>'Administrator',
                'name'       =>'CEO',
                'created_at' =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'         =>'2',
                'title'      =>'Administrator',
                'name'       =>'Admin',
                'created_at' =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'         =>'3',
                'title'      =>'Marketing',
                'name'       =>'Sales',
                'created_at' =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'         =>'4',
                'title'      =>'Tranning',
                'name'       =>'Tranner',
                'created_at' =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'         =>'5',
                'title'      =>'Content',
                'name'       =>'Content',
                'created_at' =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'         =>'6',
                'title'      =>'Accounts',
                'name'       =>'Accounts',
                'created_at' =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'         =>'7',
                'title'      =>'Human Resource',
                'name'       =>'HR',
                'created_at' =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
        
    }
}