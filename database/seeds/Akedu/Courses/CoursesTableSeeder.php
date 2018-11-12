<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    protected $_faker;
    protected $colleges;
    protected $intakes;
    protected $coursable_type;
    protected $course_names = [
        'Biology', 'Chemistry', 'Physics', 'Engineering', 'Environmental Science', 'Macroeconomics',
        'Microeconomics', 'Algebra-Based', 'Business Math'
    ];

    public function __construct()
    {
        $this->_faker = Faker\Factory::create();
        $this->colleges = \App\Models\College\College::all();
        $this->intakes = \App\Models\Intakes\Intakes::all();
        $this->coursable_type = \App\Models\College\College::class;
    }
    /**
     * Run the database seeds.
     *Seeder
     * @return void
     *
     */

    public function run()
    {
        $i = 0;

        while ($i < 10){
            $course = \App\Models\Course\Course::create([
                'course_name' => ((rand(0,1)) ? 'Degree in ': 'Diploma in ').collect($this->course_names)->random(),
                'course_intake' => $this->intakes->random()->id,
                'active' => $this->_faker->boolean,
                'certified' => $this->_faker->boolean
            ]);

            $course_profile = new \App\Models\Course\Profile\CourseProfile([
                'course_id' => $course->id,
                'course_description' => 'Sample Description. \n I will describe how many of these seemingly esoteric topics touch on your everyday life and have led to most of the technological developments of the past century. Your view of the world will never be the same!',
                'course_credits' => $this->_faker->numberBetween(1,5),
                'course_qualifications' => $this->_faker->text,
                'course_duration' => $this->_faker->numberBetween(1,6)
            ]);

            $course->profile()->save($course_profile);

            //Create the coursables
            $x = 0;
            while ($x < 4){
                \App\Models\Course\Courseable::create([
                    'course_id' => $course->id,
                    'courseables_type' => $this->coursable_type,
                    'courseables_id' => $this->colleges->random()->id
                ]);

                $x++;
            }

            $i++;
        }
    }
}
