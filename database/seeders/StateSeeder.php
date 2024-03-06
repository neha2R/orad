<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            [
                'id'=>1,
                'name'=>'JAMMU AND KASHMIR',
                'status'=>'1'
            ],
                    
            [
                'id'=>2,
                'name'=>'HIMACHAL PRADESH',
                'status'=>'1'
            ],
                    
            [
                'id'=>3,
                'name'=>'PUNJAB',
                'status'=>'1'
            ],
                    
            [
                'id'=>4,
                'name'=>'CHANDIGARH',
                'status'=>'1'
            ],
                    
            [
                'id'=>5,
                'name'=>'UTTARAKHAND',
                'status'=>'1'
            ],
                    
            [
                'id'=>6,
                'name'=>'HARYANA',
                'status'=>'1'
            ],
                    
            [
                'id'=>7,
                'name'=>'DELHI',
                'status'=>'1'
            ],
                    
            [
                'id'=>8,
                'name'=>'RAJASTHAN',
                'status'=>'1'
            ],
                    
            [
                'id'=>9,
                'name'=>'UTTAR PRADESH',
                'status'=>'1'
            ],
                    
            [
                'id'=>10,
                'name'=>'BIHAR',
                'status'=>'1'
            ],
                    
            [
                'id'=>11,
                'name'=>'SIKKIM',
                'status'=>'1'
            ],
                    
            [
                'id'=>12,
                'name'=>'ARUNACHAL PRADESH',
                'status'=>'1'
            ],
                    
            [
                'id'=>13,
                'name'=>'NAGALAND',
                'status'=>'1'
            ],
                    
            [
                'id'=>14,
                'name'=>'MANIPUR',
                'status'=>'1'
            ],
                    
            [
                'id'=>15,
                'name'=>'MIZORAM',
                'status'=>'1'
            ],
                    
            [
                'id'=>16,
                'name'=>'TRIPURA',
                'status'=>'1'
            ],
                    
            [
                'id'=>17,
                'name'=>'MEGHALAYA',
                'status'=>'1'
            ],
                    
            [
                'id'=>18,
                'name'=>'ASSAM',
                'status'=>'1'
            ],
                    
            [
                'id'=>19,
                'name'=>'WEST BENGAL',
                'status'=>'1'
            ],
                    
            [
                'id'=>20,
                'name'=>'JHARKHAND',
                'status'=>'1'
            ],
                    
            [
                'id'=>21,
                'name'=>'ODISHA',
                'status'=>'1'
            ],
                    
            [
                'id'=>22,
                'name'=>'CHHATTISGARH',
                'status'=>'1'
            ],
                    
            [
                'id'=>23,
                'name'=>'MADHYA PRADESH',
                'status'=>'1'
            ],
                    
            [
                'id'=>24,
                'name'=>'GUJARAT',
                'status'=>'1'
            ],
                    
            [
                'id'=>25,
                'name'=>'DAMAN AND DIU',
                'status'=>'1'
            ],
                    
            [
                'id'=>26,
                'name'=>'DADRA AND NAGAR HAVELI',
                'status'=>'1'
            ],
                    
            [
                'id'=>27,
                'name'=>'MAHARASHTRA',
                'status'=>'1'
            ],
                    
            [
                'id'=>28,
                'name'=>'ANDHRA PRADESH',
                'status'=>'1'
            ],
                    
            [
                'id'=>29,
                'name'=>'KARNATAKA',
                'status'=>'1'
            ],
                    
            [
                'id'=>30,
                'name'=>'GOA',
                'status'=>'1'
            ],
                    
            [
                'id'=>31,
                'name'=>'LAKSHADWEEP',
                'status'=>'1'
            ],
                    
            [
                'id'=>32,
                'name'=>'KERALA',
                'status'=>'1'
            ],
                    
            [
                'id'=>33,
                'name'=>'TAMIL NADU',
                'status'=>'1'
            ],
                    
            [
                'id'=>34,
                'name'=>'PUDUCHERRY',
                'status'=>'1'
            ],
                    
            [
                'id'=>35,
                'name'=>'ANDAMAN AND NICOBAR ISLANDS',
                'status'=>'1'
            ],
                    
            [
                'id'=>36,
                'name'=>'TELANGANA',
                'status'=>'1'
            ],
                    
            [
                'id'=>37,
                'name'=>'LADAKH',
                'status'=>'1'
            ],
        ]);
    }
}
