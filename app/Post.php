<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = [
        'profile_id', 'service_id', 'body'
    ];

    /**
     * Get the service that owns the post
     */
    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    /**
     * Get the profile that owns the post
     */
    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    /**
     * Get the comments for the post
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
