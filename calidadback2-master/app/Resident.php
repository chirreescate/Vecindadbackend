<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function invitations()
    {
        return $this->hasMany('App\Invitation');
    }

    public function scopeSearch($query, $term) {
        if (!$term) return $query;

        return $query->when(!$this->isJoined($query, 'users'), function($query) {
            return $query->join('users', 'users.id', '=', 'residents.user_id');
        })
        ->whereRaw("LOWER(users.name) LIKE ? ", '%'.strtolower(trim($term)).'%')
        ->orWhereRaw("LOWER(users.email) LIKE ? ", '%'.strtolower(trim($term)).'%');
    }

    public static function isJoined($query, $table)
    {
        $joins = $query->getQuery()->joins;
        if($joins == null) {
            return false;
        }
        foreach ($joins as $join) {
            if ($join->table == $table) {
                return true;
            }
        }
        return false;
    }
}
