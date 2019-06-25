<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommonArea extends Model
{
    protected $guarded = [];

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function edifice()
    {
        return $this->belongsTo('App\Edifice');
    }
}
