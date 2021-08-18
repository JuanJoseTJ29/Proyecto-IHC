<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeRating extends Model
{
    /**
     * Get the purchases for the service
     */
    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }
}
