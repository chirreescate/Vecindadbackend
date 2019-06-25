<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];
    
    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }

    public function invitations()
    {
        return $this->hasMany('App\Invitation');
    }
}
