<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resident;
use App\User;
use App\Edifice;
use App\Department;

class ResidentController extends Controller
{
    public function list(Request $request)
    {
        $user = $request->user();

        $residents = Resident::select('users.*', 'residents.*')->join('users', 'users.id', '=', 'residents.user_id')
        ->where('users.edifice_id', $user->edifice_id)
        ->search($request->search)
        ->paginate($request->rowsPerPage);

        $residentsCollection = collect([]);

        foreach ($residents as $resident) {
            $residentsCollection->push([
                'id' => $resident->id,
                'department' => $resident->department,
                'user' => $resident->user,
                'created_at' => $resident->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        return response()->json([
            'residents' => $residentsCollection,
            'total' => $residents->total()
        ]);
    }
}
