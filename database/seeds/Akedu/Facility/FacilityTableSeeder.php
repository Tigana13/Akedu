<?php

use Illuminate\Database\Seeder;

class FacilityTableSeeder extends Seeder
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
        for ($i=0; $i<40; $i++){
            \App\Models\Facility\Facility::create([
                'college_id' => $this->colleges->random()->id,
                'facility_name' => $this->_faker->name,
                'facility_description' => $this->_faker->text,
                'credits' => $this->_faker->numberBetween(1, 100),
                'certified' => $this->_faker->boolean,
                'active' => $this->_faker->boolean
            ]);
        }
    }
}
