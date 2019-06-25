<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = [];
    
    public function edifice()
    {
        return $this->belongsTo('App\Edifice');
    }

    public function residents()
    {
        return $this->hasMany('App\Resident');
    }
}
