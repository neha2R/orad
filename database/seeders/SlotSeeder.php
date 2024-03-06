<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::today(); // 2017-04-01 00:00:00
        $allTimes = [];
        $from=collect();
        $to=collect();
        $slot=collect();
        array_push($allTimes, $today->toTimeString()); //add the 00:00 time before looping
        for ($i = 0; $i < 23; $i++) { //95 loops will give you everything from 00:00 to 23:45
            $today->addMinutes(60); // add 0, 15, 30, 45, 60, etc...
            array_push($allTimes, $today->toTimeString()); // inserts the time into the array like 00:00:00, 00:15:00, 00:30:00, etc.
        }
        // dd($allTimes);
        foreach ($allTimes as $key => $value) {
                if ($key % 2 == 0) {
                    $from->push($value);
                }else{
                    $to->push($value);
                }
        }
        
        // dd($from,$to);
        
        foreach ($from as $key => $value) {
           
            DB::table('slots')->insert([
                'from' => $value,
                'to' => $to[$key],
                'is_active' => 1,
            ]);
            try {
                  DB::table('slots')->insert([
                'from' => $to[$key],
                'to' => $from[$key+1],
                'is_active' => 1,
            ]);
            } catch (\Throwable $th) {
                DB::table('slots')->insert([
                    'from' => "23:00:00",
                    'to' => "00:00:00",
                    'is_active' => 1,
                ]);
            }   
        }
    }
}
