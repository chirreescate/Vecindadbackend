<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    protected $guarded = [];

    protected $table = 'ticket_states';

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
