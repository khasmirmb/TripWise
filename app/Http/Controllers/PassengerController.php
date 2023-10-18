<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Schedules;
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
     * Shows the input contact and passenger page and collect all data.
     */
    public function input(Request $request)
    {
        // Use old() to retrieve old input data
        $trip_type = old('trip_type', $request->input('trip_type'));
        $origin = old('origin', $request->input('origin'));
        $destination = old('destination', $request->input('destination'));
        $depart_date = old('depart_depart_valid', $request->input('depart_depart_valid'));
        $return_date = old('return_depart_valid', $request->input('return_depart_valid'));
        $passenger = old('passenger', $request->input('passenger'));
        $dep_sched_id = old('dep_sched_id', $request->input('dep_sched_id'));
        $dep_sched_type = old('dep_sched_type', $request->input('dep_sched_type'));
        $dep_sched_price = old('dep_sched_price', $request->input('dep_sched_price'));
        $ret_sched_id = old('ret_sched_id', $request->input('ret_sched_id'));
        $ret_sched_type = old('ret_sched_type', $request->input('ret_sched_type'));
        $ret_sched_price = old('ret_sched_price', $request->input('ret_sched_price'));
    
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
