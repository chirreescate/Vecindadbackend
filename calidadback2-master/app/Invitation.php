<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $guarded = [];

    public function resident()
    {
        return $this->belongsTo('App\Resident');
    }

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
