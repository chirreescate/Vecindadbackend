<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommonArea;

class CommonAreaController extends Controller
{
    public function create(Request $request)
    {
        $commonArea = new CommonArea();

        $commonArea->name = $request->name;
        $commonArea->edifice_id = $request->edifice_id;

        $commonArea->save();

        return response()->json([
            'message' => 'Successfully created common area!'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $commonArea = CommonArea::find($id);

        $commonArea->name = $request->name;

        $commonArea->update();

        return response()->json([
            'message' => 'Successfully updated common area!'
        ], 201);
    }

    public function list(Request $request)
    {
        $user = $request->user();

        if($user->role_id == 1)
        {
            $commonAreas = CommonArea::all();
        }
        else
        {
            $commonAreas = CommonArea::where('edifice_id', $user->edifice_id)->get();
        }
        
        return response()->json([
            'commonAreas' => $commonAreas
        ], 201);
    }

    public function commonArea($id)
    {
        $commonArea = CommonArea::find($id);

        return response()->json([
            'commonArea' => $commonArea
        ], 201);
    }

    public function delete($id)
    {
        
    }
}
