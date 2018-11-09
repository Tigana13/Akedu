<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{

    protected $faker;
    protected $colleges;


    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
        $this->colleges = \App\Models\College\College::all();
    }
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<5; $i++){
            $role = Role::where('name', 'admin')->firstOrFail();
            $user = \App\User::create([
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => str_random(60),
                'role_id'        => $role->id,
            ]);

            $user_profile = new \App\Models\User\UserProfile();
            $user_profile->user_id = $user->id;
            $user_profile->dob = $this->faker->dateTime;
            $user_profile->occupation = $this->faker->word;
            $user_profile->college_id = $this->colleges->random()->id;
            $user_profile->completion_year = $this->faker->dateTime;

            $user->profile()->save($user_profile);

        }

        for ($i=0; $i<5; $i++){
            $role = Role::where('name', 'user')->firstOrFail();
            $user = User::create([
                'name'           => $this->faker->name,
                'email'          => $this->faker->safeEmail,
                'password'       => bcrypt('password'),
                'remember_token' => str_random(60),
                'role_id'        => $role->id,
            ]);

            $user_profile = new \App\Models\User\UserProfile();
            $user_profile->user_id = $user->id;
            $user_profile->dob = $this->faker->dateTime;
            $user_profile->occupation = $this->faker->word;
            $user_profile->college_id = $this->colleges->random()->id;
            $user_profile->completion_year = $this->faker->dateTime;

            $user->profile()->save($user_profile);
        }
    }
}
