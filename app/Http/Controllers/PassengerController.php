<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Schedules;
use App\Models\Seat;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Shows the input contact and passenger page and collect all data and error handling
     */
    public function input(Request $request)
    {

        // Retrieve session variables
        $trip_type = session('trip_type');
        $origin = session('origin');
        $destination = session('destination');
        $passenger = session('passenger');

        $depart_date = old('depart_depart_valid', $request->input('depart_depart_valid'));
        $return_date = old('return_depart_valid', $request->input('return_depart_valid'));

        session([
            'depart_date' => $depart_date,
            'return_date' => $return_date,
        ]);
        
        $dep_sched_id = session('dep_sched_id');
        $dep_sched_type = session('dep_sched_type');
        $dep_sched_price = session('dep_sched_price');

        $ret_sched_id = session('ret_sched_id');
        $ret_sched_type = session('ret_sched_type');
        $ret_sched_price = session('ret_sched_price');
        
    
        return view('booking.passenger', compact(
            'trip_type',
            'origin',
            'destination',
            'depart_date',
            'return_date',
            'passenger',
            'dep_sched_id',
            'dep_sched_type',
            'dep_sched_price',
            'ret_sched_id',
            'ret_sched_type',
            'ret_sched_price'
        ));
    }

    public function storeOneInfo(Request $request)
    {
        $scheduleId = $request->input('scheduleId');
        $scheduleType = $request->input('scheduleType');
        $schedulePrice = $request->input('schedulePrice');

        // Store the data in the session
        session([
            'dep_sched_id' => $scheduleId,
            'dep_sched_type' => $scheduleType,
            'dep_sched_price' => $schedulePrice,
        ]);
    }
    public function storeRoundInfo(Request $request)
    {
        $scheduleId = $request->input('scheduleId');
        $scheduleType = $request->input('scheduleType');
        $schedulePrice = $request->input('schedulePrice');

        // Store the data in the session
        session([
            'ret_sched_id' => $scheduleId,
            'ret_sched_type' => $scheduleType,
            'ret_sched_price' => $schedulePrice,
        ]);
    }

    public function updateSeat(Request $request)
    {
        $passengerId = $request->input('passengerId');
        $seatId = $request->input('selectedSeat');

        $seat = Seat::find($seatId);

        if ($seat) {
            // Update the passenger's seat_number in the database
            $passenger = Passenger::find($passengerId);
            $passenger->seat_id = $seat->id;
            $passenger->save();
        
            // Update the seat_status to 'booked'
            $seat->seat_status = 'booked';
            $seat->save();
        } else {
            // Handle the case where the seat with the provided seatId was not found
            return response()->json(['error' => 'Seat not found'], 404);
        }

        // You can return a success response
        return response()->json(['message' => 'Seat updated successfully']);
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
    public function show(Passenger $passenger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Passenger $passenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Passenger $passenger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Passenger $passenger)
    {
        //
    }
}
