<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    protected $faker;
    protected $courses;
    protected $colleges;
    protected $users;

    protected $comments = [
        'his is a book',
        'This is not a book',
        ' Is this a book',
        ' What is it',
        ' That is a pencil',
        ' That is not a pencil',
        ' Is that a pencil',
        ' What is that',
        ' These are books',
        ' These are not books',
        ' Are these books',
        ' What are these',
        ' Those are pencils',
        ' Those are not pencils ',
        ' Are those pencils',
        ' What are thos',
        ' What is your addres',
        ' What’s your nam',
        ' What color is thi',
        ' What size is tha',
        ' What day is toda',
        ' Milk is good to ea',
        ' Milk is good for you toea',
        ' This yard is full of childre',
        ' What is this in the pictur',
        ' One is strong The other is weak.',
        ' That’s a good idea',
        ' That’s very kind of you',
        ' What he said is something',
        ' All you have to do is add the letters',
        ' This is mygirl going into the door',
        ' To do as you suggest would be out of the question',
        ' That isexactly what we want to learn',
        ' he verb to be',
        ' am You are hesheit is we areyou are they are ',
        ' was You were heshit was we were you were they were past',
        ' will be I should be You will be hesheit will be we will be you will be they will be',
        ' would be you would be hesheit would be we would be',
        'ou would be they would be',
        ' I am a girl',
        ' I am not a girl',
        ' Are you agirl',
        ' Who are you',
        ' How old are you',
        ' How are you',
        ' Where are you',
        ' My father is in his office',
        ' Who’s that man over there',
        ' I’m eight',
        ' It is seven.It must be seven',
        ' It’sverycold',
        ' It is difficult',
        ' It is wonderful',
        ' It’s ten o’clock',
        ' It is time for you to get up',
        ' I’m interested in this book',
        ' I’m very fond to you as a friend',
        ' I’m thirsty',
        ' I’m busy just now',
        ' I’m afraid. I’m sure. I’m sorry',
        ' I’m glad you like it.(I’m glad to hear your good news.',
        ' I’m ready for breakfast',
        ' I’m good at tennis',
        ' What time is it',
        ' It’s two minutes past six',
        't’s half past seven. It’s a quarter past five. It’s two minutes to six. It’s two sharp',
        't’s 6:30',
        ' How many are they',
        ' How many flowers are they',
        ' How much rice are they',
        ' What is your father',
        ' Are you sure',
        ' What are you afraid of',
        ' It’s in the sky. ',
        ' The car is near the tree',
        ' Your hat looks very nice',
        'he verb to have I have, you have,  has, we have, you have, they have I had, you had,  had ...',
        'I have a pencil and two books. ',
        ' I have not',
        ' Do you have any pencils',
        ' What do you have',
        ' How many sisters doyou have',
        ' Do you have anything to eat',
        ' He has some letters for your father',
        ' My sister has a cup',
        ' I have a lot of thing to eat',
        ' I have toothache sore',
        ' I have no time to see you',
        ' We have a car waiting outside',
        ' I’ll have some soup',
        ' There is, There are There was, There were There will be; There would be; There must be',
        ' There is book on the table',
        'There is not any book on the table.',
        'Is there any book on the table',
        'What is there on the table',
        'There are two pencils in my box',
        'There are not any pencils in my box',
        'Are there any pencils in your box?',
        'What aret here in your bo',
        'There are seven days in a w eek',
        'How much rice is there',
        'Here is a few letters for you to learn',
        'There’s a telephonecall for you',

    ];

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->courses = \App\Models\Course\Course::all();
        $this->colleges = \App\Models\College\College::all();
        $this->users = \App\User::all();

        \App\Models\Comments\Comments::truncate();
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
                $comment->body = collect($this->comments)->random();
                $comment->commentable_type = \App\Models\College\College::class;
                $comment->commentable_id = $college->id;

                $college->comments()->save($comment);
            }
        }

        foreach ($this->courses as $course) {
            for ($x=0; $x < 5; $x++){
                $comment = new \App\Models\Comments\Comments();
                $comment->user_id = $this->users->random()->id;
                $comment->body = collect($this->comments)->random();
                $comment->commentable_type = \App\Models\Course\Course::class;
                $comment->commentable_id = $course->id;

                $course->comments()->save($comment);
            }
        }
    }
}
