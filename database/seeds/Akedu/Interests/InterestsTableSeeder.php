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
        $interests = collect(['Arts','Design & Performance', 'Business', 'Communications & Media Education', 'Entrepreneurship',' Health & Wellness Public', 'Social & Human Services',
            'Science', 'Technology','Engineering & Mathematics', 'Sustainability', 'Environmental & Natural Resources']);

        $interests->map(function ($interest, $key){
            \App\Models\Interests\Interests::create([
                'user_id' => ($this->users->isNotEmpty()) ? $this->users->random()->id : 1,
                'interest_name' => $interest,
                'interest_icon' => $this->faker->imageUrl(200,200)
            ]);
        });
    }
}
