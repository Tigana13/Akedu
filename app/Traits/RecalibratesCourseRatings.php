<?php
/**
 * Created by PhpStorm.
 * User: tiganaochieng
 * Date: 05/11/2018
 * Time: 02:30
 */

namespace App\Traits;


use App\Models\Comments\Comments;
use App\Models\Course\Course;
use Illuminate\Support\Facades\Artisan;

trait RecalibratesCourseRatings
{
    protected $course_id;
    protected $comment_id;


    public function recalibrateCourseRating(Course $course, Comments $comment)
    {
        Artisan::call('course:recalibrate_rating', [
            'course_id' => $course->id,
            'comment_id' => $comment->id
        ]);
    }
}
