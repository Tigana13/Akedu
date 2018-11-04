<?php

namespace App\Console\Commands;

use App\Models\Course\Course;
use Google\Auth\Credentials\AppIdentityCredentials;
use Google\Cloud\Core\ServiceBuilder;
use Google\Cloud\Language\LanguageClient;
use Google\Cloud\Language\V1beta2\LanguageServiceClient;
use Google_Client;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Phpml\Classification\NaiveBayes;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\Dataset\ArrayDataset;
use Phpml\Dataset\CsvDataset;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WordTokenizer;

class CalibrateCoursesApproval extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course:calibrate_sentiments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recommend courses to a student';
    protected $language_kit;

    /**
     * Create a new command instance.
     *
     * @throws \Google\ApiCore\ValidationException
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
                $sentiment_scores = array();
                $magnitude_scores = array();
                foreach ($course->comments as $comment) {
                    try {
                        $sentiment = $this->language_kit->analyzeSentiment($comment->body);
                        $magnitude_score = $sentiment->sentiment()['magnitude'];
                        $sentiment_score = $sentiment->sentiment()['score'];

                        array_push($sentiment_scores, $sentiment_score);
                        array_push($magnitude_scores, $magnitude_score);
                    }
                    catch (Google\Cloud\Core\Exception\BadRequestException $exception) {
                        continue;
                    }
                }

                $course->sentiment_score_average = collect($sentiment_scores)->average();
                $course->sentiment_magnitude_average = collect($magnitude_scores)->average();

                $this->info('Saving');
                $course->save();
            }
        });
    }

}
