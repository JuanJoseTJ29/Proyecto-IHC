<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'profile_id', 'post_id', 'body'
    ];

    /**
     * Get the comment that owns the profile
     */
    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    /**
     * Get the comment that owns the post
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
