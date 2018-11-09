<?php

namespace App\Console\Commands\Recommender;

use Illuminate\Console\Command;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WordTokenizer;

class Vectorize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $word_samples;
    protected $signature = 'words:vectorize {word_samples}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vectorize a given set of words';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

    }
}
