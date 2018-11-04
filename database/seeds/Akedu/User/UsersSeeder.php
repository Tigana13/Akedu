<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    protected $faker;
    protected $subinterests;
    protected $interests;

    protected  $college_favoritable_type;
    protected  $course_favoritable_type;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
        $this->subinterests = \App\Models\Interests\SubInterests::all();
        $this->interests = \App\Models\Interests\Interests::all();

        $this->college_favoritable_type = \App\Models\College\College::class;
        $this->course_favoritable_type = \App\Models\Course\Course::class;

    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pilot_user = \App\User::create([
            'name'  => 'Akedu Pilot',
            'email' => 'tiganaoch@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('secret')
        ]);

        $this->createInterests($pilot_user);
        $this->createFavorites($pilot_user);

        $x = 0;

        while ($x < 15){
            $user = \App\User::create([
                'name'  => $this->faker->name,
                'email' => $this->faker->safeEmail,
                'password' => \Illuminate\Support\Facades\Hash::make('secret')
            ]);

            $this->createInterests($user);
            $this->createFavorites($user);

            $x++;
        }
    }


    public function createFavorites($user)
    {
        //Create user Favorites
        $i = 0;
        while ($i < 7){
            $favorite = \App\Models\Favorites\Favorites::create([
                'favorite_type' => (mt_rand(0,1)) ? $this->college_favoritable_type : $this->course_favoritable_type,
                'favorite_id' => $this->faker->numberBetween(1,28),
                'description' => $this->faker->paragraph,
            ]);

            \App\Models\Favorites\Favoritable::create([
                'favorites_id' => $favorite->id,
                'user_id' => $user->id,
                'favoritable_id' => $this->faker->numberBetween(1,28),
                'favoritable_type' => (mt_rand(0,1)) ? $this->college_favoritable_type : $this->course_favoritable_type
            ]);

            $i++;
        }
    }


    public function createInterests($user)
    {
        for ($x=0; $x < 10; $x++){
            \App\Models\Interests\Interestable::create([
                'interests_id' => $this->interests->random()->id,
                'interestables_id' => $user->id,
                'interestables_type' => \App\User::class
            ]);
        }
    }
}
