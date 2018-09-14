<?php

use App\Models\Locations\Locatable;
use Illuminate\Database\Seeder;

class FacilityTableSeeder extends Seeder
{
    protected $_faker;
    protected $colleges;
    protected $countries;
    protected $locatable_type;

    public function __construct()
    {
        $this->_faker = Faker\Factory::create();
        $this->colleges = \App\Models\College\College::all();
        $this->countries = \App\Models\College\College::all();
        $this->locatable_type = \App\Models\Facility\Facility::class;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<40; $i++){
            $facility = \App\Models\Facility\Facility::create([
                'college_id' => $this->colleges->random()->id,
                'facility_name' => $this->_faker->name,
                'facility_description' => $this->_faker->text,
                'credits' => $this->_faker->numberBetween(1, 100),
                'certified' => $this->_faker->boolean,
                'active' => $this->_faker->boolean
            ]);

            $this->createFacilityLocations($facility->id);
        }
    }


    public function createFacilityLocations($facility_id)
    {
        //Create random number of branches for the college
        $location = \App\Models\Locations\Locations::firstOrCreate([
            'latitude' => $this->_faker->latitude(-1,0),
            'longitude' => $this->_faker->longitude(36,37),
        ], [
            'latitude' => $this->_faker->latitude(-1.163848, -1.442544),
            'longitude' => $this->_faker->longitude(36.648945,37.047199),
            'address' => $this->_faker->address,
            'country_id' => $this->countries->random()->id,
            'city' => $this->_faker->city,
        ]);

        $location->save();

        //Create the locatable
        Locatable::create([
            'locations_id' => $location->id,
            'locatable_type' => $this->locatable_type,
            'locatable_id' => $facility_id
        ]);
    }

}
