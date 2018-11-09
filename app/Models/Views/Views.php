<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    protected $fillable = [
        'user_id',
        'view_medium',
        'viewable_type',
        'viewable_id',
    ];

}
