<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CitySeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\StateSeeder;
use Database\Seeders\LeadStatusSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            // SlotSeeder::class,
            // AdminUserSeeder::class,
            // DepartmentsTableSeeder::class,
            // SubDepartmentsTableSeeder::class,
            // LeaddurationSeeder::class
            // DiscountManager::class
            // StateSeeder::class,
            // CitySeeder::class
            // RoleSeeder::class
            LeadStatusSeeder::class
        ]);
    }
}
