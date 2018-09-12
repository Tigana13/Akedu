<?php

namespace App\Models\Course;

use App\Models\Course\Profile\CourseProfile;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function profile()
    {
        return $this->hasOne(CourseProfile::class,'course_id');
    }
}
