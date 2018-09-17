<?php

namespace App\Models\Course;

use App\Models\College\College;
use App\Models\Course\Profile\CourseProfile;
use App\Models\Intakes\Intakes;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['course_name', 'college_id', 'course_intake'];


    public function profile()
    {
        return $this->hasOne(CourseProfile::class,'course_id');
    }

    public function intakes()
    {
        return $this->hasMany(Intakes::class, 'id', 'course_intake');
    }

    /**
     * Get all of the colleges that are associated with this course.
     */
    public function colleges()
    {
        return $this->morphedByMany(College::class, 'courseable');
    }

}
