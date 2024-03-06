<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id'=>'1',
                'role_id'=>'0',
                'name'=>'CEO',
                'description'=>'CEO or superadmin',
                'created_at' =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'=>'2',
                'role_id'=>'1',
                'name'=>'Admin',
                'description'=>'Admin panel',
                'created_at' =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'=>'3',
                'role_id'=>'2',
                'name'=>'Senior',
                'description'=>'BDE TeamLead, BDM TeamLead, Tranning Demo Manager, QA Manager, Senior Content writter',
                'created_at' =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'=>'4',
                'role_id'=>'3',
                'name'=>'Junior',
                'description'=>'BDE Tranner, BDE, Tranning Demo Tranner, Class Tranner, Junior Content writter',
                'created_at' =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
                    
    }
}
