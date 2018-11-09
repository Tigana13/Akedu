<?php

use App\Models\Locations\Locatable;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Location;

class LocationsTableSeeder extends Seeder
{
    private $locatable_id;
    private $locatable_type;
    private $faker;

    public function __construct($_locatable_id, $_locatable_type)
    {
        $this->locatable_id = $_locatable_id;
        $this->locatable_type = $_locatable_type;
        $this->faker = \Faker\Factory::create('en_UG');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create the location
        $location = Location::firstOrCreate([
            'latitude' => $this->faker->latitude(-1,0),
            'longitude' => $this->faker->longitude(36,37),
        ], [
            'latitude' => $this->faker->latitude(-1.163848, -1.442544),
            'longitude' => $this->faker->longitude(36.648945,37.047199),
            'address' => $this->faker->address,
            'country_id' => CountriesTableSeeder::where('country_name', 'Kenya')->value('id'),
            'city' => $this->faker->city,
        ]);

        $location->save();

        //Create the locatable
        Locatable::create([
            'location_id' => $location->id,
            'locatable_type' => $this->locatable_type,
            'locatable_id' => $this->locatable_id
        ]);
    }
}
