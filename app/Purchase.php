<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'service_id',
        'profile_id',
        'rating_id',
        'code',
        'due_date',
        'seller_confirmation',
        'customer_confirmation',
        'status'
    ];

    /**
     * Get the service for the purchase
     */
    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    /**
     * Get the profile for the purchase
     */
    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    /**
     * Get the rating for the purchase
     */
    public function rating()
    {
        return $this->belongsTo('App\Rating');
    }
}
