<?php

namespace App\Http\Controllers;

use App\Models\Ferries;
use App\Models\Schedules;
use Illuminate\Http\Request;

class FerriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getFerryInfo(Request $request) {
        $scheduleId = $request->input('scheduleId');
    
        // Retrieve the schedule based on the provided $scheduleId
        $schedule = Schedules::find($scheduleId);
    
        if ($schedule) {
            // Get the ferry information based on the schedule's ferry_id
            $ferry = Ferries::find($schedule->ferry_id);
    
            if ($ferry) {
                return response()->json([
                    'ferry_name' => $ferry->name,
                ]);
            } else {
                return response()->json(['error' => 'Ferry information not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Schedule not found'], 404);
        }
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
    public function show(Ferries $ferries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ferries $ferries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ferries $ferries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ferries $ferries)
    {
        //
    }
}
