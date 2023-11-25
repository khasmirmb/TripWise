<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Fares;
use App\Models\Schedules;
use Illuminate\Http\Request;

class FaresController extends Controller
{

    /**
     * Get all the fares AJAX.
     */
    public function getFares(Request $request)
    {
        // Retrieve the schedule ID from the request
        $scheduleId = $request->input('scheduleId');

        $bookingId = $request->input('bookingId');

        $booking = Booking::find($bookingId);

        // Initialize an array to store accommodations
        $accommodations = [];

        foreach ($booking->passengers as $passenger) {
            // Assuming there is a relationship between Passenger and Accommodation
            $accommodation = $passenger->accommodation;

            // Check if accommodation is available and add it to the array
            if ($accommodation) {
                $accommodations[] = $accommodation->type;
            }
        }

        $schedule = Schedules::find($scheduleId);

        $fare = Fares::where('ferry_id', $schedule->ferry_id)
            ->where('type', $accommodation)
            ->first();


        // Return JSON response with the fares
        return response()->json(['fare' => $fare]);
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
    public function show(Fares $fares)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fares $fares)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fares $fares)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fares $fares)
    {
        //
    }
}
