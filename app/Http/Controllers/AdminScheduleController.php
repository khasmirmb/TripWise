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

    // Add Schedule By Day Per Week
    public function createSchedule(Request $request)
    {
        $validate = $request->validate([
            'origin' => 'required|different:destination',
            'destination' => 'required|different:origin',
            'start_date' => 'required|date_format:m/d/Y',
            'end_date' => 'required|date_format:m/d/Y|after:start_date',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'vessel' => 'required|exists:ferries,id',
            'days' => 'required|array|min:1',
            'days.*' => 'in:mo,tu,we,th,fr,sa,su',
        ]);
        

        if($validate){

            $origin = $request->input('origin');
            $destination = $request->input('destination');
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $departure_time = $request->input('departure_time');
            $arrival_time = $request->input('arrival_time');
            $vessel = $request->input('vessel');
            $days = $request->input('days');

            $ferry = Ferries::find($vessel);

            if (!$ferry) {
                return redirect()->back()->withInput()->with('error', 'Ferry not found.');
            }

            $fares = $ferry->fares;

            if (!$ferry) {
                return redirect()->back()->withInput()->with('error', 'Fares not found.');
            }
    
            // Loop through each selected day
            foreach ($days as $selectedDay) {
                $r = new When();
                $r->RFC5545_COMPLIANT = When::IGNORE;
                $r->startDate(new DateTime($start_date))
                ->until(new DateTime($end_date))
                ->freq('weekly')
                ->byday($selectedDay)
                ->generateOccurrences();

                $occurrences = $r->occurrences;

                foreach ($occurrences as $date) {
                    $date = $date->format('Y-m-d');

                    // Check if a schedule already exists for the same ferry, date, origin, and destination
                    $existingSchedule = Schedules::where('ferry_id', $vessel)
                        ->where('departure_date', $date)
                        ->where('departure_port', $origin)
                        ->where('arrival_port', $destination)
                        ->first();

                    if ($existingSchedule) {
                        return redirect()->back()->withInput()->with('error', 'Schedule already exists for the selected ferry, date, origin, and destination');
                    }

                    // Check for overlapping time range with existing schedules
                    $overlappingSchedules = Schedules::where('ferry_id', $vessel)
                    ->where('departure_date', '=', $date)
                    ->where(function ($query) use ($departure_time, $arrival_time) {
                        $query->where(function ($query) use ($departure_time, $arrival_time) {
                            $query->where('departure_time', '<', $arrival_time)
                                ->where('arrival_time', '>', $departure_time);
                        })
                        ->orWhere(function ($query) use ($departure_time, $arrival_time) {
                            $query->where('departure_time', '>=', $departure_time)
                                ->where('departure_time', '<', $arrival_time);
                        })
                        ->orWhere(function ($query) use ($departure_time, $arrival_time) {
                            $query->where('arrival_time', '>', $departure_time)
                                ->where('arrival_time', '<=', $arrival_time);
                        });
                    })
                    ->exists();

                    if ($overlappingSchedules) {
                        return redirect()->back()->withInput()->with('error', 'Overlapping schedule found for the selected ferry, date, and time range');
                    }

                    // Generate a unique and not very long schedule number
                    $schedule_number = 'S-' . mt_rand(100000, 999999);

                    // Check if a schedule already exists for the same schedule number
                    $existingSchedule = Schedules::where('schedule_number', $schedule_number)->first();

                    // Loop until a unique schedule number is generated
                    while ($existingSchedule) {
                        $schedule_number = 'S-' . mt_rand(100000, 999999);
                        $existingSchedule = Schedules::where('schedule_number', $schedule_number)->first();
                    }
                
                    $schedule = new Schedules();
                    $schedule->ferry_id = $vessel;
                    $schedule->departure_port = $origin;
                    $schedule->arrival_port = $destination;
                    $schedule->departure_date = $date;
                    $schedule->schedule_number = $schedule_number;
                
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
                
                    foreach ($fares as $fare) {
                        // Retrieve the last seat for the current class and schedule
                        $lastSeat = Seat::where('schedule_id', $scheduleId)
                            ->where('class', $fare->type)
                            ->orderBy('id', 'desc')
                            ->first();
                
                        // If there is a last seat, extract the seat number and continue from the next one
                        if ($lastSeat) {
                            $lastSeatNumber = $lastSeat->seat_number;
                            preg_match('/([A-Za-z]+)(\d+)/', $lastSeatNumber, $matches);
                            $prefix = $matches[1];
                            $lastNumber = (int)$matches[2];
                
                            // Continue the loop from the next seat number
                            for ($i = 1; $i <= $fare->seats; $i++) {
                                $nextSeatNumber = $prefix . ($lastNumber + $i);
                                $seatsToInsert[] = [
                                    'ferry_id' => $vessel,
                                    'schedule_id' => $scheduleId,
                                    'seat_number' => $nextSeatNumber,
                                    'class' => $fare->type,
                                    'seat_status' => 'available',
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ];
                            }
                        } else {
                            // If no last seat, start from the beginning
                            for ($i = 1; $i <= $fare->seats; $i++) {
                                $seatsToInsert[] = [
                                    'ferry_id' => $vessel,
                                    'schedule_id' => $scheduleId,
                                    'seat_number' => $fare->type[0] . $i,
                                    'class' => $fare->type,
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
            }

            return redirect()->route('admin.schedule')->with('success', 'Schedule created successfully');

        } else {
            // Validation failed, return to the form with errors
            return redirect()->back()->withInput()->withErrors($request->validated());
        }
    }

    // Edit Schedule Form
    public function editScheduleForm($scheduleId)
    {
        $schedule = Schedules::find($scheduleId);

        if (!$schedule) {
            return redirect()->back()->with('error', 'Schedule not found.');
        }

        $seatCount = Seat::where('schedule_id', $scheduleId)->count();

        $ports = Ports::all();
        $ferries = Ferries::all();

        return view('admin.schedules.crud.edit-schedule',  compact(
            'seatCount',
            'ports', 
            'ferries', 
            'schedule', 
        ));
    }

    // Update Schedule By Day Per Week
    public function updateSchedule(Request $request, $scheduleId)
    {
        $validate = $request->validate([
            'origin' => 'required|different:destination',
            'destination' => 'required|different:origin',
            'start_date' => 'required|date_format:m/d/Y',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'vessel' => 'required|exists:ferries,id',
            'schedule_status' => 'required|in:In Progress,Canceled,Completed',
        ]);

        if($validate){

            $origin = $request->input('origin');
            $destination = $request->input('destination');
            $departure_date = $request->input('start_date');
            $departure_time = $request->input('departure_time');
            $arrival_time = $request->input('arrival_time');
            $vessel = $request->input('vessel');
            $schedule_status = $request->input('schedule_status');

            $ferry = Ferries::find($vessel);

            if (!$ferry) {
                return redirect()->back()->withInput()->with('error', 'Ferry not found.');
            }

            $schedule = Schedules::find($scheduleId);

            // Check if there are booked seats
            $bookedSeatsCount = Seat::where('schedule_id', $scheduleId)->where('seat_status', 'booked')->count();

            if ($bookedSeatsCount > 0) {
                // If there are booked seats, you can only modify schedule_status
                if ($request->filled('schedule_status') && $request->input('schedule_status') != $schedule->schedule_status) {
                    // Update schedule_status if it's different
                    $schedule->schedule_status = $request->input('schedule_status');
                    $schedule->save();
                    return redirect()->route('admin.schedule')->with('success', 'Schedule status updated successfully.');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Cannot modify other data for a schedule with booked seats.');
                }
            }

            // Convert departure and arrival times to Carbon instances
            $departureTime = Carbon::createFromFormat('H:i', $departure_time);
            $arrivalTime = Carbon::createFromFormat('H:i', $arrival_time);

            $schedule->ferry_id = $vessel;
            $schedule->departure_port = $origin;
            $schedule->arrival_port = $destination;
            $schedule->schedule_status = $schedule_status;
            $schedule->departure_date = Carbon::createFromFormat('m/d/Y', $departure_date);

            // Convert departure and arrival times to Carbon instances
            $departureTime = Carbon::createFromFormat('H:i', $departure_time);
            $arrivalTime = Carbon::createFromFormat('H:i', $arrival_time);
            
            // If arrival time is earlier than departure time, add 1 day to arrival date
            if ($arrivalTime->lt($departureTime)) {
                $schedule->arrival_date = Carbon::parse($departure_date)->addDay()->format('Y-m-d');
            } else {
                $schedule->arrival_date = Carbon::createFromFormat('m/d/Y', $departure_date);;
            }

            $schedule->departure_time = $departure_time;
            $schedule->arrival_time = $arrival_time;
            $schedule->save(); // Save the schedule to the database


            // Delete all seats with the specified schedule_id
            Seat::where('schedule_id', $scheduleId)->delete();
        
            $seatsToInsert = [];

            $fares = $ferry->fares;

            foreach ($fares as $fare) {
                // Retrieve the last seat for the current class and schedule
                $lastSeat = Seat::where('schedule_id', $scheduleId)
                    ->where('class', $fare->type)
                    ->orderBy('id', 'desc')
                    ->first();
        
                // If there is a last seat, extract the seat number and continue from the next one
                if ($lastSeat) {
                    $lastSeatNumber = $lastSeat->seat_number;
                    preg_match('/([A-Za-z]+)(\d+)/', $lastSeatNumber, $matches);
                    $prefix = $matches[1];
                    $lastNumber = (int)$matches[2];
        
                    // Continue the loop from the next seat number
                    for ($i = 1; $i <= $fare->seats; $i++) {
                        $nextSeatNumber = $prefix . ($lastNumber + $i);
                        $seatsToInsert[] = [
                            'ferry_id' => $vessel,
                            'schedule_id' => $scheduleId,
                            'seat_number' => $nextSeatNumber,
                            'class' => $fare->type,
                            'seat_status' => 'available',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                } else {
                    // If no last seat, start from the beginning
                    for ($i = 1; $i <= $fare->seats; $i++) {
                        $seatsToInsert[] = [
                            'ferry_id' => $vessel,
                            'schedule_id' => $scheduleId,
                            'seat_number' => $fare->type[0] . $i,
                            'class' => $fare->type,
                            'seat_status' => 'available',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }

            // Save seat to the database by batch processing
            Seat::insert($seatsToInsert);

            return redirect()->route('admin.schedule')->with('success', 'Schedule updated successfully');

        } else {
            // Validation failed, return to the form with errors
            return redirect()->back()->withInput()->withErrors($request->validated());
        }
    }

    // Delete Schedule
    public function deleteSchedule(Schedules $schedule)
    {
        // Check if the schedule exists
        if (!$schedule) {
            return redirect()->back()->with('error', 'No schedule was found.');
        }
    
        // Check if there are booked seats for the schedule
        $bookedSeatsCount = Seat::where('schedule_id', $schedule->id)->where('seat_status', 'booked')->count();
    
        if ($bookedSeatsCount > 0) {
            return redirect()->back()->with('error', 'Cannot delete schedule. There are booked seats for the schedule.');
        }
    
        // Delete all seats with the specified schedule_id
        Seat::where('schedule_id', $schedule->id)->delete();
    
        // Now, delete the schedule
        $schedule->delete();
    
        // Redirect to a success page or return a success message
        return back()->with('success', 'Schedule deleted successfully.');
    }
    
}
