<?php

namespace App\Console;

use App\Console\Commands\CalibrateCoursesApproval;
use App\Console\Commands\Course\ExitSurveyRecalibrate;
use App\Console\Commands\Course\RecalibrateSentimentRatings;
use App\Console\Commands\RecommendCourse;
use App\Console\Commands\Recommender\Vectorize;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CalibrateCoursesApproval::class,
        Vectorize::class,
        RecalibrateSentimentRatings::class,
        ExitSurveyRecalibrate::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
