<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketCategory;

class TicketCategoryController extends Controller
{
    public function list()
    {
        $ticketCategories = TicketCategory::all();

        return response()->json([
            'ticketCategories' => $ticketCategories
        ], 201);
    }
}
