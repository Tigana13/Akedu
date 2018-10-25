<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    protected $faker;
    protected $courses;
    protected $colleges;
    protected $users;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->courses = \App\Models\Course\Course::all();
        $this->colleges = \App\Models\College\College::all();
        $this->users = \App\User::all();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->colleges as $college) {
            for ($x=0; $x < 5; $x++){
                $comment = new \App\Models\Comments\Comments();
                $comment->user_id = $this->users->random()->id;
                $comment->body = $this->faker->sentence;
                $comment->commentable_type = \App\Models\College\College::class;
                $comment->commentable_id = $college->id;

                $college->comments()->save($comment);
            }
        }

        foreach ($this->courses as $course) {
            for ($x=0; $x < 5; $x++){
                $comment = new \App\Models\Comments\Comments();
                $comment->user_id = $this->users->random()->id;
                $comment->body = $this->faker->sentence;
                $comment->commentable_type = \App\Models\Course\Course::class;
                $comment->commentable_id = $course->id;

                $course->comments()->save($comment);
            }
        }
    }
}
