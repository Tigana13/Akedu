<?php

namespace App\Console\Commands\Course;

use App\Models\Comments\Comments;
use App\Models\Course\Course;
use Google\Cloud\Core\ServiceBuilder;
use Illuminate\Console\Command;

class RecalibrateSentimentRatings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course:recalibrate_rating {course_id} {comment_id}';
    protected $course_id;
    protected $comment_id;
    protected $language_kit;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->language_kit = new ServiceBuilder([
            'keyFilePath' => env('GCP_KEY_FILE_PATH'),
            'projectId' => env('GOOGLE_LANGUAGE_PROJECT_ID')
        ]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->course_id = $this->argument('course_id');
        $this->comment_id = $this->argument('comment_id');

        $course = Course::findorFail($this->course_id);
        $comment = Comments::findOrFail($this->comment_id);

        $sentiment_score = $this->language_kit->language()->analyzeSentiment($comment->body)->sentiment()['score'];
        $magnitude_score = $this->language_kit->language()->analyzeSentiment($comment->body)->sentiment()['magnitude'];

        $course->sentiment_score_average = ($course->sentiment_score_average += $sentiment_score) / ($course->comments->count() + 0.001);
        $course->sentiment_magnitude_average = ($course->sentiment_magnitude_average += $magnitude_score) / ($course->comments->count() + 0.001);

        //save
        $course->save();
        $this->info($course->course_name.' recalibrated successfully');
    }
}
