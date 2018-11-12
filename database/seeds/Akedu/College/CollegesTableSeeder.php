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
    protected $imageable_type;
protected  $image_urls = [
'https://images.pexels.com/photos/933964/pexels-photo-933964.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=350',
'https://images.pexels.com/photos/207691/pexels-photo-207691.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=350',
'https://images.pexels.com/photos/7096/people-woman-coffee-meeting.jpg?auto=compress&cs=tinysrgb&dpr=2&h=350',
'https://images.pexels.com/photos/159844/cellular-education-classroom-159844.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
'https://images.pexels.com/photos/289740/pexels-photo-289740.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=350',
'https://images.pexels.com/photos/545068/pexels-photo-545068.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=350',
'https://images.pexels.com/photos/1122865/pexels-photo-1122865.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=350',
'https://images.pexels.com/photos/798721/pexels-photo-798721.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=350',
'https://images.pexels.com/photos/159490/yale-university-landscape-universities-schools-159490.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=350',
'https://images.pexels.com/photos/207729/pexels-photo-207729.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=350',
];

protected $college_names = [
    'Adams State College',
    'Balsina Hospital College of Health Sciences',
    'University of the State of Machakos',
    'Methodist University',
    'Associated Mennonite Biblical Seminary',
    'Academy of Oriental Medicine at Austin',
    'Tempe Normal School'
];


    public function __construct()
    {
        $this->locatable_type = College::class;
        $this->faker = Faker\Factory::create();
        $this->countries = \App\Models\Countries\Countries::all();
        $this->imageable_type = College::class;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach ($this->college_names as $college_name) {
            $college = College::create([
                'college_name' => $college_name,
                'college_email' => $faker->unique()->safeEmail,
                'password' => \Illuminate\Support\Facades\Hash::make('secret'),
                'active' => $faker->boolean,
                'certified' => $faker->boolean
            ]);

            $college_profile = \App\Models\College\Profile\CollegeProfile::create([
                'college_id' => $college->id,
                'college_description' => 'Sample Description. \n I will describe how many of these seemingly esoteric topics touch on your everyday life and have led to most of the technological developments of the past century. Your view of the world will never be the same!',
                'date_founded' => $faker->date
            ]);


            $college->profile()->save($college_profile);

            //Create Locations (Branches) for the college
            $this->createCollegeLocations($college->id);

            //Create Images for the college
            $this->createCollegeImages($college->id);

            //Create Banner Images for the college
            $this->createBannerImages($college->id);
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
                'locations_id' => $location->id,
                'locatable_type' => $this->locatable_type,
                'locatable_id' => $college_id
            ]);
        }
    }

    public function createBannerImages($college_id)
    {


        for ($x = 0; $x < 2; $x++){
            $image = \App\Models\Image\Image::create([
                'image' => collect($this->image_urls)->random(),
                'college_id' => $college_id
            ]);

            $image->save();
        }
    }


    public function createCollegeImages($college_id)
    {
        //Create random number of branches for the college
        for ($x = mt_rand(4,15); $x < 20; $x++){
            $image = \App\Models\Image\Image::create([
                'image' => collect($this->image_urls)->random(),
            ]);

            $image->save();

            //Create the locatable
            \App\Models\Image\Imageable::create([
                'image_id' => $image->id,
                'imageable_type' => $this->imageable_type,
                'imageable_id' => $college_id
            ]);
        }
    }
}
