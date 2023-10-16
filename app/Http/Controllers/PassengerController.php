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
     * Get the selected Date.
     */
    public function input(Request $request)
    {
        $inputs = $request->all();
        $this->validate($request, [
            'return_depart_valid' => 'nullable',
        ]);

        $schedule = Schedules::find($inputs['dep_sched_id']);

        return view('booking.passenger', [
            'trip_type' => $inputs['trip_type'],
            'origin' => $inputs['origin'],
            'destination' => $inputs['destination'],
            'depart_date' => $inputs['depart_depart_valid'],
            'return_date' => $inputs['return_depart_valid'],
            'passenger' => $inputs['passenger'],
        ]);
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
