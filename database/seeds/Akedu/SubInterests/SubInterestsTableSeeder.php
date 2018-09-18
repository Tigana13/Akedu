<?php

use Illuminate\Database\Seeder;

class SubInterestsTableSeeder extends Seeder
{
    protected $faker;
    protected $interests;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->interests = \App\Models\Intakes\Intakes::all();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $x = 0;

        while ($x  < 20){
            $sub_interest = \App\Models\Interests\SubInterests::create([
                'interest_id' => $this->interests->random()->id,
                'sub_interest' => $this->faker->name,
                'sub_interest_icon' => $this->faker->imageUrl(200,200)
            ]);
        }
    }
}
