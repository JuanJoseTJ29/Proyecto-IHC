<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'profile_id', 'title', 'description', 'price', 'picture_path'
    ];

    /**
     * Get the profile for the service
     */
    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    /**
     * Set the scope search
     */
    public function scopeSearch($query,$search){
        if($search){
            return $query->where  ('title','LIKE',"%$search%")
                         ->orWhere('description','LIKE',"%$search%");
        }
    }

    /**
     * Get the comments for the blog post.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * Get the purchases for the service
     */
    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }
}
