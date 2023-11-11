<?php

namespace App\Http\Controllers;

use App\Models\Fares;
use App\Models\Ferries;
use App\Models\Ports;
use App\Models\Schedules;
use App\Models\Seat;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use When\When;

class AdminScheduleController extends Controller
{
    // Add Schedule Form
    public function addScheduleForm()
    {
        $ports = Ports::all();
        $ferries = Ferries::all();

        return view('admin.schedules.crud.add-schedule', ['ports' => $ports , 'ferries' => $ferries]);
    }
    // Get Ferry Info on Add Schedule Form
    public function ferryInfo(Request $request)
    {
        $ferry_id = $request->ferry_id;

        $ferry = Ferries::find($ferry_id);

        $fares = Fares::where('ferry_id', $ferry_id)->get();

        return response()->json(['ferry' => $ferry, 'fares' => $fares]);
    }

    public function createSchedule(Request $request)
    {
        $validate = $request->validate([
            'origin' => 'required|different:destination',
            'destination' => 'required|different:origin',
            'start_date' => 'required|date_format:m/d/Y',
            'end_date' => 'required|date_format:m/d/Y|after:start_date',
            'day' => 'required|in:mo,tu,we,th,fr,sa,su',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'vessel' => 'required|exists:ferries,id',
            'seats.*' => 'required|integer|min:1',
        ]);


        if($validate){

            $origin = $request->input('origin');
            $destination = $request->input('destination');
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $day = $request->input('day');
            $departure_time = $request->input('departure_time');
            $arrival_time = $request->input('arrival_time');
            $vessel = $request->input('vessel');
            $seats = $request->input('seats');

            $ferry = Ferries::find($vessel);

            if (!$ferry) {
                return redirect()->back()->with('error', 'Ferry not found.');
            }
    
            $totalseat = 0;
            $seatings = [];
    
            $capacity = $ferry->capacity;
            
            foreach ($seats as $fareType => $seatCount) {
                // Perform your validation or other logic here if needed
                $totalseat += $seatCount;
                $seatings[$fareType] = [
                    'count' => $seatCount,
                    'type' => $fareType,
                ];
            }
    
            if($totalseat > $capacity){
                return redirect()->back()->with('error', 'Total seat is greater than capacity!');
            }
    
            $r = new When();
            $r->RFC5545_COMPLIANT = When::IGNORE;
            $r->startDate(new DateTime($start_date))
            ->until(new DateTime($end_date))
            ->freq('weekly')
            ->byday($day)
            ->generateOccurrences();

            $occurrences = $r->occurrences;

            foreach ($occurrences as $date) {
                $date = $date->format('Y-m-d');
            
                $schedule = new Schedules();
                $schedule->ferry_id = $vessel;
                $schedule->departure_port = $origin;
                $schedule->arrival_port = $destination;
                $schedule->departure_date = $date;
            
                // Convert departure and arrival times to Carbon instances
                $departureTime = Carbon::createFromFormat('H:i', $departure_time);
                $arrivalTime = Carbon::createFromFormat('H:i', $arrival_time);
            
                // If arrival time is earlier than departure time, add 1 day to arrival date
                if ($arrivalTime->lt($departureTime)) {
                    $schedule->arrival_date = Carbon::parse($date)->addDay()->format('Y-m-d');
                } else {
                    $schedule->arrival_date = $date;
                }
            
                $schedule->departure_time = $departure_time;
                $schedule->arrival_time = $arrival_time;
                $schedule->save(); // Save the schedule to the database
            
                $scheduleId = $schedule->id;
            
                $seatsToInsert = [];
            
                foreach ($seatings as $seating) {
                    // Retrieve the last seat for the current class and schedule
                    $lastSeat = Seat::where('schedule_id', $scheduleId)
                        ->where('class', $seating['type'])
                        ->orderBy('id', 'desc')
                        ->first();
            
                    // If there is a last seat, extract the seat number and continue from the next one
                    if ($lastSeat) {
                        $lastSeatNumber = $lastSeat->seat_number;
                        preg_match('/([A-Za-z]+)(\d+)/', $lastSeatNumber, $matches);
                        $prefix = $matches[1];
                        $lastNumber = (int)$matches[2];
            
                        // Continue the loop from the next seat number
                        for ($i = 1; $i <= $seating['count']; $i++) {
                            $nextSeatNumber = $prefix . ($lastNumber + $i);
                            $seatsToInsert[] = [
                                'ferry_id' => $vessel,
                                'schedule_id' => $scheduleId,
                                'seat_number' => $nextSeatNumber,
                                'class' => $seating['type'],
                                'seat_status' => 'available',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        }
                    } else {
                        // If no last seat, start from the beginning
                        for ($i = 1; $i <= $seating['count']; $i++) {
                            $seatsToInsert[] = [
                                'ferry_id' => $vessel,
                                'schedule_id' => $scheduleId,
                                'seat_number' => $seating['type'][0] . $i,
                                'class' => $seating['type'],
                                'seat_status' => 'available',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        }
                    }
                }
                // Save seat to the database by batch processing
                Seat::insert($seatsToInsert);
            }

            return redirect()->route('admin.schedule')->with('success', 'Schedule created successfully');

        } else {
            // Validation failed, return to the form with errors
            return redirect()->back()->withInput()->withErrors($request->validated());
        }
    }
}
