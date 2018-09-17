<?php

namespace App\Models\Image;

use App\Models\College\College;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    /**
     * Get all of the colleges that are associated with this image.
     */
    public function courses()
    {
        return $this->morphedByMany(College::class, 'imageable');
    }

    // Relationship
    //Get all the models for the profile image
    public function imageable()
    {
        return $this->morphTo();
    }

}
