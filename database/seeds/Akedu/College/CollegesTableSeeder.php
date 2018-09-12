<?php

use App\Models\College\College;
use App\Models\Locations\Locatable;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Location;

class CollegesTableSeeder extends Seeder
{
    protected $locatable_type;
    protected $faker;
    protected $countries;


    public function __construct()
    {
        $this->locatable_type = College::class;
        $this->faker = Faker\Factory::create();
        $this->countries = \App\Models\Countries\Countries::all();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 25; $i++) {
            $college = College::create([
                'college_name' => $faker->word. ' University',
                'college_email' => $faker->unique()->safeEmail,
                'password' => \Illuminate\Support\Facades\Hash::make('secret'),
                'active' => $faker->boolean,
                'certified' => $faker->boolean
            ]);

            $college_profile = \App\Models\College\Profile\CollegeProfile::create([
                'college_id' => $college->id,
                'college_description' => $faker->text,
                'date_founded' => $faker->date
            ]);

            $college->profile()->save($college_profile);

            //Create Locations (Branches) for the college
            $this->createCollegeLocations($college->id);
        }

    }

    public function createCollegeLocations($college_id)
    {
        //Create random number of branches for the college
        for ($x = mt_rand(1,5); $x < 6; $x++){
            $location = \App\Models\Locations\Locations::firstOrCreate([
                'latitude' => $this->faker->latitude(-1,0),
                'longitude' => $this->faker->longitude(36,37),
            ], [
                'latitude' => $this->faker->latitude(-1.163848, -1.442544),
                'longitude' => $this->faker->longitude(36.648945,37.047199),
                'address' => $this->faker->address,
                'country_id' => $this->countries->random()->id,
                'city' => $this->faker->city,
            ]);

            $location->save();

            //Create the locatable
            Locatable::create([
                'location_id' => $location->id,
                'locatable_type' => $this->locatable_type,
                'locatable_id' => $college_id
            ]);
        }
    }
}
