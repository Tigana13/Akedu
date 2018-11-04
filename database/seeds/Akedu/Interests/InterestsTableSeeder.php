<?php

use Illuminate\Database\Seeder;

class InterestsTableSeeder extends Seeder
{
    protected $faker;
    protected $users;
    protected $interests;

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
        $interests = [
            'Animation', 'Astronomy', 'Criminology', 'Enterpreneurial Studies', 'Robotics technology', 'Zoology'
        ];

        foreach ($interests as $interest){
            \App\Models\Interests\Interests::create([
                'interest_name' => $interest,
                'interest_icon' => $this->faker->imageUrl(200,200)
            ]);
        }

        $this->interests = \App\Models\Interests\Interests::all();

        foreach ($this->users as $user) {
            for ($x=0; $x < 10; $x++){
                \App\Models\Interests\Interestable::create([
                    'interests_id' => $this->interests->random()->id,
                    'interestables_id' => $user->id,
                    'interestables_type' => \App\User::class
                ]);
            }
        }

    }
}
