<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function create(Request $request)
    {
        $role = new Role();

        $role->name = $request->name;

        $role->save();

        return response()->json([
            'message' => 'Successfully created role!'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        $role->name = $request->name;

        $role->update();

        return response()->json([
            'message' => 'Successfully updated role!'
        ], 201);
    }

    public function list()
    {
        $roles = Role::all();

        return response()->json([
            'roles' => $roles
        ], 201);
    }

    public function role($id)
    {
        $role = Role::find($id);

        return response()->json([
            'role' => $role
        ], 201);
    }
}
