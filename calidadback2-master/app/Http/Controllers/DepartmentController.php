<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    public function listByEdifice(Request $request)
    {
        $user = $request->user();

        $departments = Department::where('edifice_id',$user->edifice_id)->get();

        return response()->json([
            'departments' => $departments
        ], 201);
    }
}
