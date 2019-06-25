<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edifice extends Model
{
    protected $guarded = [];
    
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function commonAreas()
    {
        return $this->hasMany('App\CommonArea');
    }

    public function departments()
    {
        return $this->hasMany('App\Department');
    }
}
