<?php

namespace App\Http\Controllers;

use App\Models\Fares;
use App\Models\Schedules;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'passenger' => 'required|integer|max:20|min:1',
        ]);


        $validated_date = Carbon::createFromFormat('d/m/Y', $inputs['depart_date'])->format('Y-m-d');

        $now = Carbon::now(new DateTimeZone('Asia/Manila'));
        $today = $now->format('Y-m-d');
        
        $depart_schedule = DB::table('schedules')
            ->join('ferries', 'schedules.ferry_id', '=', 'ferries.id')
            ->where('departure_port', '=', $inputs['origin'])
            ->where('arrival_port', '=', $inputs['destination'])
            ->where('departure_date', '>=', $validated_date)
            ->where('departure_date', '>=', $today)
            ->where('schedule_status', '=', 'In Progress')
            ->whereRaw("CONCAT(departure_date, ' ', departure_time) > ?", [$now])
            ->select('schedules.id', 'ferry_id', 'departure_port', 'arrival_port', 'departure_date', 'arrival_date', 'departure_time', 'arrival_time', 'name', 'capacity', 'description', 'image')
            ->orderBy('departure_date', 'asc')
            ->orderBy('departure_time', 'asc')
            ->get();

        $return_schedule = null;
        
        if(!is_null($inputs['return_date'])){

            $ret_validated_date = \Carbon\Carbon::createFromFormat('d/m/Y', $inputs['return_date'])->format('Y-m-d');

            $return_schedule = DB::table('schedules')
            ->join('ferries', 'schedules.ferry_id', '=', 'ferries.id')
            ->where('departure_port', '=', $inputs['destination'])
            ->where('arrival_port', '=', $inputs['origin'])
            ->where('departure_date', '>=', $ret_validated_date)
            ->where('schedule_status', '==', 'In Progress')
            ->whereRaw("CONCAT(departure_date, ' ', departure_time) > ?", [$now])
            ->select('schedules.id', 'ferry_id', 'departure_port', 'arrival_port', 'departure_date', 'arrival_date', 'departure_time', 'arrival_time', 'name', 'capacity', 'description', 'image')
            ->orderBy('departure_date', 'asc')
            ->orderBy('departure_time', 'asc')
            ->get();
        }


        return view('booking.schedule',[
            'trip_type' => $inputs['type'],
            'origin' => $inputs['origin'],
            'destination' => $inputs['destination'],
            'depart_date' => $inputs['depart_date'],
            'return_date' => $inputs['return_date'],
            'passenger' => $inputs['passenger'],
            'depart_schedules' => $depart_schedule,
            'return_schedules' => $return_schedule,
        ]);
    }

    public function getSchedule(Request $request) {
        $scheduleId = $request->input('scheduleId');
        $fareId = $request->input('fareId');
    
        $schedule = Schedules::find($scheduleId);
        $fare = Fares::find($fareId);
    
        if ($schedule && $fare) {
            return response()->json([
                'departure_port' => $schedule->departure_port,
                'arrival_port' => $schedule->arrival_port,
                'departure_date' => date("j F Y", strtotime($schedule->departure_date)),
                'departure_time' => date('g:i a', strtotime($schedule->departure_time)),
                'price' => $fare->price,
                'type' => $fare->type
            ]);
        } else {
            return response()->json(['error' => 'Schedule information not found'], 404);
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
