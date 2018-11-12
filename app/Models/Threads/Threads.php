<?php

namespace App\Models\Threads;

use App\Models\Comments\Comments;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Threads extends Model
{

    public function threadable()
    {
        return $this->morphTo();
    }

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
