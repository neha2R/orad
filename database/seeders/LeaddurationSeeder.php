<?php

namespace Database\Seeders;

use App\Models\LeadDurations;
use Illuminate\Database\Seeder;

class LeaddurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // LeadDurations::
        $data=['0'=>8,'2'=>5,'3'=>3];
        foreach ($data as $key => $value) {
            LeadDurations::create(['role'=>$key,'days'=>$value]);
        }
    }
}
