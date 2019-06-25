<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invitation;
use App\Event;

class EventController extends Controller
{
    public function get($id)
    {
        $event = Event::find($id);

        return response()->json([
            'event' => $event,
            'invitations' => $event->invitations
        ], 201);
    }
}
