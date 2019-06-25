<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketStatus;

class TicketStatusController extends Controller
{
    public function create(Request $request)
    {
        $ticketStatus = new TicketStatus();

        $ticketStatus->name = $request->name;

        $ticketStatus->save();

        return response()->json([
            'message' => 'Successfully created ticket status!'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $ticketStatus = TicketStatus::find($id);

        $ticketStatus->name = $request->name;

        $ticketStatus->update();

        return response()->json([
            'message' => 'Successfully updated ticket status!'
        ], 201);
    }

    public function list()
    {
        $ticketStates = TicketStatus::all();

        return response()->json([
            'ticketStates' => $ticketStates
        ], 201);
    }

    public function ticketStatus($id)
    {
        $ticketStatus = TicketStatus::find($id);

        return response()->json([
            'ticketStatus' => $ticketStatus
        ], 201);
    }
}
