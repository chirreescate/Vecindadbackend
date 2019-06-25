<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Reservation;
use App\User;
use App\CommonArea;
use App\Event;

class ReservationController extends Controller
{
    public function list()
    {
        $user = $request->user();
        $role = $user->role->id;
        $reservationsCollection = collect([]);
        $reservations = Reservation::all();

        if( $role == 1)
        {
            $reservations = Reservation::all();

            foreach ($reservations as $reservation) {
                $r = [
                    'id' => $reservation->id,
                    'reservation_start_date' => $reservation->reservation_start_date,
                    'reservation_end_date' => $reservation->reservation_end_date,
                    'user' => $reservation->resident->user,
                    'status' => $reservation->status,
                    'commonArea' => $reservation->commonArea
                ];
    
                $reservationsCollection->push($r);
            }
        }
        else if ($role == 2 || $role == 4)
        {
            $users = User::where('edifice_id', $user->edifice->id)->get();

            $residents = Resident::whereIn('user_id', $users->pluck('id'))->get();

            foreach ($reservations as $reservation) {
                $r = [
                    'id' => $reservation->id,
                    'reservation_start_date' => $reservation->reservation_start_date,
                    'reservation_end_date' => $reservation->reservation_end_date,
                    'user' => $reservation->resident->user,
                    'status' => $reservation->status,
                    'commonArea' => $reservation->commonArea
                ];
    
                $reservationsCollection->push($r);
            }
        }

        else if($role == 3)
        {
            $reservations = Reservation::where('resident_id',$user->resident->id)->get();

            foreach ($reservations as $reservation) {
                $r = [
                    'id' => $reservation->id,
                    'reservation_start_date' => $reservation->reservation_start_date,
                    'reservation_end_date' => $reservation->reservation_end_date,
                    'user' => $reservation->resident->user,
                    'status' => $reservation->status,
                    'commonArea' => $reservation->commonArea
                ];
    
                $reservationsCollection->push($r);
            }
        }

        return response()->json([
            'reservations' => $reservationsCollection
        ], 201);
    }

    public function reserve(Request $request)
    {

        $user = $request->user();
        $reservation = new Reservation();
        $commonArea = CommonArea::find($request->common_area_id);
        $event = new Event();

        if($commonArea->available == false)
        {
            return response()->json([
                'message' => 'Common Area not available'
            ], 401);
        }

        if($user->role_id == 3)
        {
            $reservation->resident_id = $user->resident->id;
            $reservation->common_area_id = $request->common_area_id;
            $reservation->reservation_start_date = $request->reservation_start_date;
            $reservation->reservation_end_date = $request->reservation_end_date;
            
            $reservation->save();

            $commonArea->available = false;
            $commonArea->update();

            if($request->hasEvent)
            {
                $event->title = $request->title;
                $event->details = $request->details;
                $event->reservation_id = $reservation->id;

                $event->save();
            }
    
            return response()->json([
                'message' => 'Successfully created reservation!'
            ], 201);
        }
        else
        {
            return response()->json([
                'message' => 'Only one resident can make a reservation'
            ], 401);
        }
    }

    public function change_status($id)
    {
        $reservation = Reservation::find($id);

        $reservation->status = false;

        $commonArea = CommonArea::find($reservation->common_area_id);
        $commonArea->available = true;

        $reservation->update();
        $commonArea->update();

        return response()->json([
            'message' => 'Successfully updated reservation!'
        ], 201);
    }

    public function reservation($id)
    {
        $reservation = Reservation::find($id);

        return response()->json([
            'reservation' => $reservation
        ], 201);
    }

    public function delete($id)
    {
        $reservation = Reservation::where('id',$id)->delete();
    
        return response()->json([
            'message' => 'Successfully deleted'
        ], 201);
    }
    
}
