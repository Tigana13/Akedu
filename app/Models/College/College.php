<?php

namespace App\Models\College;

use App\Models\College\Profile\CollegeProfile;
use App\Models\Course\Course;
use App\Models\Facility\Facility;
use App\Models\Intakes\Intakes;
use App\Models\Locations\Locations;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Category;

class College extends Model
{
    public function profile()
    {
        return $this->hasOne(CollegeProfile::class, 'college_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'college_id');
    }

    public function intakes()
    {
        return $this->hasMany(Intakes::class, 'college_id');
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class, 'college_id');
    }

    public function locations()
    {
        return $this->morphToMany(Locations::class, 'locatable');
    }

}
