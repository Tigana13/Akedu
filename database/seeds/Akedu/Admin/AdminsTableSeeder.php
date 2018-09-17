<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{

    protected $faker;


    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin\Admin::create([
            'name'  => 'Tigana Ochieng',
            'email' => 'tiganaoch@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('secret')
        ]);


       $x = 0;

       while ($x < 4){
           \App\Models\Admin\Admin::create([
               'name'  => $this->faker->name,
               'email' => $this->faker->safeEmail,
               'password' => \Illuminate\Support\Facades\Hash::make('secret')
           ]);
           $x++;
       }
    }
}
