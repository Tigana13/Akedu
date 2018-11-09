<?php

namespace App\Console\Commands\Course;

use App\Models\Course\Course;
use Google\Cloud\Core\ServiceBuilder;
use Illuminate\Console\Command;

class ExitSurveyRecalibrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course_exit:calibrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calibrate a course\'s rating based on sentiments provided in an exit survey';
    protected $language_kit;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $gcloud = new ServiceBuilder([
            'keyFilePath' => env('GCP_KEY_FILE_PATH'),
            'projectId' => env('GOOGLE_LANGUAGE_PROJECT_ID')
        ]);

        $this->language_kit = $gcloud->language();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Course::chunk(10, function ($courses){
            foreach ($courses as $course){
                foreach ($course->exitSurveys as $survey) {
                    $this->info('Calibrating sentiments for exit survey by: '.strtoupper($survey->user->name). ' on: '.strtoupper($survey->course->course_name));

                    $survey->professional_ethics_rating_score = $this->language_kit->analyzeSentiment($survey->professional_ethics_rating)->sentiment()['score'];
                    $survey->communication_skills_rating_score = $this->language_kit->analyzeSentiment($survey->communication_skills_rating)->sentiment()['score'];
                    $survey->theory_prac_application_rating_score = $this->language_kit->analyzeSentiment($survey->theory_prac_application_rating)->sentiment()['score'];
                    $survey->current_field_trends_rating_score = $this->language_kit->analyzeSentiment($survey->current_field_trends_rating)->sentiment()['score'];
                    $survey->written_communication_rating_score = $this->language_kit->analyzeSentiment($survey->written_communication_rating)->sentiment()['score'];
                    $survey->critical_thinking_rating_score = $this->language_kit->analyzeSentiment($survey->critical_thinking_rating)->sentiment()['score'];
                    $survey->team_member_functionality_rating_score = $this->language_kit->analyzeSentiment($survey->team_member_functionality_rating)->sentiment()['score'];
                    $survey->independent_learner_rating_score = $this->language_kit->analyzeSentiment($survey->independent_learner_rating)->sentiment()['score'];
                    $survey->further_education_career_rating_score = $this->language_kit->analyzeSentiment($survey->further_education_career_rating)->sentiment()['score'];
                    $survey->strong_leadership_skills_rating_score = $this->language_kit->analyzeSentiment($survey->strong_leadership_skills_rating)->sentiment()['score'];
                    $survey->acceptance_at_institution_rating_score = $this->language_kit->analyzeSentiment($survey->acceptance_at_institution_rating)->sentiment()['score'];
                    $survey->faculty_support_rating_score = $this->language_kit->analyzeSentiment($survey->faculty_support_rating)->sentiment()['score'];
                    $survey->return_for_social_activities_rating_score = $this->language_kit->analyzeSentiment($survey->return_for_social_activities_rating)->sentiment()['score'];
                    $survey->employment_preparation_rating_score = $this->language_kit->analyzeSentiment($survey->employment_preparation_rating)->sentiment()['score'];
                    $survey->save();

                    $this->info('Calibrated');
                }
                $this->info($course->course_name.' calibration complete');
                $course->save();
            }
        });
    }
}
