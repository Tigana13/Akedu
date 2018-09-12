<?php

use Illuminate\Database\Seeder;

class IntakesTableSeeder extends Seeder
{

    protected $_faker;
    protected $colleges;


    public function __construct()
    {
        $this->_faker = Faker\Factory::create();
        $this->colleges = \App\Models\College\College::all();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<=20; $i++){
            $intake = \App\Models\Intakes\Intakes::create([
                'college_id' => $this->colleges->random()->id,
                'intake_alias' => $this->_faker->month.' Intake',
                'intake_description' => $this->_faker->text,
                'intake_start' => $this->_faker->month,
                'intake_finish' => $this->_faker->month
            ]);
        }
    }
}
