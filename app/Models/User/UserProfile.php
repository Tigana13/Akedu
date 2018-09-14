<?php

namespace App\Models\User;

use App\Models\College\College;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = ['user_id', 'dob', 'occupation', 'college_id', 'completion_year'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }

}
