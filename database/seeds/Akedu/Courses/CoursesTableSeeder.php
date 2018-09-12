<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    protected $_faker;
    protected $colleges;
    protected $intakes;

    public function __construct()
    {
        $this->_faker = Faker\Factory::create();
        $this->colleges = \App\Models\College\College::all();
        $this->intakes = \App\Models\Intakes\Intakes::all();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 40; $i++){
            $course = \App\Models\Course\Course::create([
                'course_name' => (rand(0,1)) ? 'Degree in ': 'Diploma in '.$this->_faker->word,
                'college_id' => $this->colleges->random()->id,
                'course_intake' => $this->intakes->random()->id,
                'active' => $this->_faker->boolean,
                'certified' => $this->_faker->boolean
            ]);

            $course_profile = new \App\Models\Course\Profile\CourseProfile([
                'course_id' => $course->id,
                'course_description' => $this->_faker->text,
                'course_credits' => $this->_faker->numberBetween(1,5),
                'course_qualifications' => $this->_faker->text,
                'course_duration' => $this->_faker->numberBetween(1,6)
            ]);

            $course->profile()->save($course_profile);
        }
    }
}
