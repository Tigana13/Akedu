<?php

use Illuminate\Database\Seeder;

class InterestsTableSeeder extends Seeder
{
    protected $faker;
    protected $users;

    public function __construct()
    {
        $this->users = \App\User::all();
        $this->faker = Faker\Factory::create();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($x=0; $x<20; $x++){
            \App\Models\Interests\Interests::create([
                'user_id' => $this->users->random()->id,
                'interest_name' => $this->faker->name,
                'interest_icon' => $this->faker->imageUrl(200,200)
            ]);
        }
    }
}
