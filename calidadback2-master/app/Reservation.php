<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = [];

    public function commonArea()
    {
        return $this->belongsTo('App\CommonArea');
    }

    public function resident()
    {
        return $this->belongsTo('App\Resident');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
