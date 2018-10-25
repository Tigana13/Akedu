<?php
namespace Seeds\Akedu\Views;

use Illuminate\Database\Seeder;

class ViewsTableSeeder extends Seeder
{
    private $users;
    private $colleges;
    private $courses;
    private $faker;


    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
        $this->users = \App\User::all();
        $this->colleges = \App\Models\College\College::all();
        $this->courses = \App\Models\Course\Course::all();

    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x < 30 ; $x++){
            \App\Models\Views\Views::create([
               'user_id' => $this->users->random()->id,
                'view_medium' => 'mobile',
                'viewable_type' => collect([\App\Models\College\College::class, \App\Models\Course\Course::class, \App\Models\Threads\Threads::class])->random(),
                'viewable_id' => rand(0,20)
            ]);
        }
    }
}
