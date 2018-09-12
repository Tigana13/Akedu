<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $this->call(CollegesTableSeeder::class);
        $this->call(IntakesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(FacilityTableSeeder::class);

    }
}
