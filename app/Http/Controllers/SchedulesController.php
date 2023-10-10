<?php

namespace App\Http\Controllers;

use App\Models\Schedules;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('booking.schedule');
    }

    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $inputs = $request->all();

        $this->validate($request, [
            'type' => 'required',
            'origin' => 'required|different:destination',
            'destination' => 'required|different:origin',
            'depart_date' => 'required|date_format:d/m/Y',
            'return_date' => 'nullable|date_format:d/m/Y|after:depart_date',
            'passenger' => 'required|integer',
        ]);

        $data = DB::table('schedules')
        ->where([
            ['departure_port', $inputs['origin']],
            ['arrival_port', $inputs['destination']],
            ['departure_date', '>=' , $inputs['depart_date']],
            ])
        ->get();

        return view('booking.schedule',[
            'origin' => $inputs['origin'],
            'destination' => $inputs['destination'],
            'depart_date' => $inputs['depart_date'],
            'return_date' => $inputs['return_date'],
            'passenger' => $inputs['passenger'],
            'schedules' => $data,
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
    public function show(Schedules $schedules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedules $schedules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedules $schedules)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedules $schedules)
    {
        //
    }
}
