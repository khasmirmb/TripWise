<?php

namespace App\Http\Controllers;

use App\Models\Schedules;
use App\Models\Seat;
use Illuminate\Http\Request;

class AdminSeatController extends Controller
{
    public function seatList($scheduleId)
    {
        // Retrieve the schedule by ID
        $schedules = Schedules::find($scheduleId);

        // Check if the schedule exists
        if (!$schedules) {
            return redirect()->back()->with('error', 'No schedule was found.');
        }

        // Get all seats related to the schedule
        $seats = Seat::where('schedule_id', $schedules->id)
        ->orderBy('id', 'desc')
        ->paginate(10);

        if(!$seats){
            return redirect()->back()->with('error', 'No seat was found.');
        }

        // Pass the seats and schedule to the view
        return view('admin.schedules.seats.seat', compact('seats', 'schedules'));
    }
}
