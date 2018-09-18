<?php

namespace App;

use App\Models\Favorites\Favorites;
use App\Models\User\UserProfile;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function searchableAs()
    {
        return 'users_index';
    }

    public function toSearchableArray()
    {

        $array = ['name', 'email'];

        return $array;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    // Each user may several favorite records
    public function favorites()
    {
        return $this->morphToMany(Favorites::class, 'favoritable');
    }

}
