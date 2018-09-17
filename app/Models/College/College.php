<?php

namespace App\Models\College;

use App\Models\College\Profile\CollegeProfile;
use App\Models\Course\Course;
use App\Models\Facility\Facility;
use App\Models\Image\Image;
use App\Models\Intakes\Intakes;
use App\Models\Locations\Locations;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    public function profile()
    {
        return $this->hasOne(CollegeProfile::class, 'college_id');
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

    //Each college may be tied to one or more courses aps
    public function courses()
    {
        return $this->morphToMany(Course::class, 'courseables');
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

}
