<?php

use Illuminate\Database\Seeder;
use Seeds\Akedu\Views\ViewsTableSeeder;

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
        $this->call(FacilityTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(InterestsTableSeeder::class);
        $this->call(SubInterestsTableSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(ViewsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
