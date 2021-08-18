<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'firstname', 'lastname', 'address', 'phone_number' ,'profession'
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the services record associated with the user
     */
    public function services()
    {
        return $this->hasMany('App\Service');
    }

    /**
     * Get the posts fot the profile
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * Get the comments for the profile
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get the purchases for the profile
     */
    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }
}
