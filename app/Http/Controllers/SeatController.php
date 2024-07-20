<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;
use App\Models\Fares;
use App\Models\Ferries;
use App\Models\Schedules;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Check for Depart
     */
    public function DepartCheckAvailability(Request $request)
    {
        $scheduleId = $request->input('scheduleId');
        $fareType = $request->input('fareType');
        $passengerCount = $request->input('passengerCount');

        // Retrieve the schedule and fare based on the scheduleId and fareType
        $schedule = Schedules::find($scheduleId);
        $fare = Fares::where('ferry_id', $schedule->ferry_id)
            ->where('type', $fareType)
            ->first();

        if (!$schedule || !$fare) {
            return response()->json(['available' => false]);
        }

        // Calculate the available seats for the given schedule, fare, and passenger count
        $availableSeats = $this->checking($schedule, $fare);

        $isAvailable = $availableSeats >= $passengerCount;

        return response()->json(['available' => $isAvailable]);
    }
    /**
     * Check for return
     */
    public function ReturnCheckAvailability(Request $request)
    {
        $scheduleId = $request->input('scheduleId');
        $fareType = $request->input('fareType');
        $passengerCount = $request->input('passengerCount');

        // Retrieve the schedule and fare based on the scheduleId and fareType
        $schedule = Schedules::find($scheduleId);
        $fare = Fares::where('ferry_id', $schedule->ferry_id)
            ->where('type', $fareType)
            ->first();

        if (!$schedule || !$fare) {
            return response()->json(['available' => false]);
        }

        // Calculate the available seats for the given schedule, fare, and passenger count
        $availableSeats = $this->checking($schedule, $fare);

        $isAvailable = $availableSeats >= $passengerCount;

        return response()->json(['available' => $isAvailable]);
    }
    /**
     * Function call to check seats
     */
    private function checking($schedule, $fare)
    {
        $totalCapacity = $fare->seats;

        // Calculate the number of seats already booked for the specific schedule and fare
        $bookedSeatsCount = Seat::where('ferry_id', $schedule->ferry_id)
            ->where('schedule_id', $schedule->id)
            ->where('class', $fare->type)
            ->where('seat_status', 'booked')
            ->count();

        // Calculate the available seats
        $availableSeats = $totalCapacity - $bookedSeatsCount;

        return $availableSeats;
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seat $seat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seat $seat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seat $seat)
    {
        //
    }
}
