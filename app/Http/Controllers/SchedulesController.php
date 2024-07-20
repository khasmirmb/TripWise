<?php

namespace App\Http\Controllers;

use App\Models\Booking;
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

        // Check for existing schedule
        $departureSchedule = Schedules::where('departure_port', $request->input('origin'))
            ->where('arrival_port', $request->input('destination'))
            ->where('departure_date', '>=', \Carbon\Carbon::createFromFormat('d/m/Y', $request->input('depart_date'))->format('Y-m-d'))
            ->first();

        if (!$departureSchedule) {
            // No schedule found, return back with an error
             return redirect()->back()->withInput()->with('error', 'No schedule found for the selected trip.');
        }

        // Check for return schedule only if it's a round trip
        if ($request->input('type') == 'Round Trip') {

            $returnSchedule = Schedules::where('departure_port', $request->input('destination'))
            ->where('arrival_port', $request->input('origin'))
            ->where('departure_date', '>=', \Carbon\Carbon::createFromFormat('d/m/Y', $request->input('return_date'))->format('Y-m-d'))
            ->first();

            if (!$returnSchedule) {
                // No schedule found, return back with an error
                 return redirect()->back()->withInput()->with('error', 'No schedule found for the return trip.');
            }

        }

    
        $validated_date = $this->convertToDate($request->input('depart_date'));
        $now = Carbon::now(new DateTimeZone('Asia/Manila'));
        $today = $now->format('Y-m-d');
    
        $depart_schedule = $this->getSchedules($inputs['origin'], $inputs['destination'], $validated_date, $today);
    
        $return_schedule = null;
    
        if (!is_null($inputs['return_date'])) {
            $ret_validated_date = $this->convertToDate($inputs['return_date']);
            $return_schedule = $this->getSchedules($inputs['destination'], $inputs['origin'], $ret_validated_date, $today);
        }


        session([
            'passenger' => $inputs['passenger'],
            'origin' => $inputs['origin'],
            'trip_type' => $inputs['type'],
            'destination' => $inputs['destination'],
        ]);
    
        return view('booking.schedule', [
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
    
    protected function convertToDate($date)
    {
        return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }
    
    protected function getSchedules($departure_port, $arrival_port, $validated_date, $today)
    {
        return DB::table('schedules')
            ->join('ferries', 'schedules.ferry_id', '=', 'ferries.id')
            ->where('departure_port', '=', $departure_port)
            ->where('arrival_port', '=', $arrival_port)
            ->where('departure_date', '>=', $validated_date)
            ->where('departure_date', '>=', $today)
            ->where('schedule_status', '=', 'In Progress')
            ->whereRaw("CONCAT(departure_date, ' ', departure_time) > ?", [Carbon::now(new DateTimeZone('Asia/Manila'))->toDateTimeString()])
            ->select('schedules.id', 'ferry_id', 'departure_port', 'arrival_port', 'departure_date', 'arrival_date', 'departure_time', 'arrival_time', 'name', 'capacity', 'description', 'image')
            ->orderBy('departure_date', 'asc')
            ->orderBy('departure_time', 'asc')
            ->get();
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
