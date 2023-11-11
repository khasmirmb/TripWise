<?php

namespace App\Http\Controllers;

use App\Models\Fares;
use App\Models\Ferries;
use App\Models\Schedules;
use App\Models\Seat;
use Illuminate\Http\Request;

class AdminSeatController extends Controller
{
    public function seatList($scheduleId)
    {
        // Retrieve the schedule by ID
        $schedules = Schedules::find($scheduleId);

        // Check if the schedule exists
        if (!$schedules) {
            return redirect()->back()->with('error', 'No schedule was found.');
        }

        // Get all seats related to the schedule
        $seats = Seat::where('schedule_id', $schedules->id)
        ->orderBy('class', 'asc')
        ->paginate(10);

        if(!$seats){
            return redirect()->back()->with('error', 'No seat was found.');
        }

        // Get the ferry_id from the schedule
        $ferryId = $schedules->ferry_id;

        $seatCount = Seat::where('schedule_id', $scheduleId)->count();

        // Retrieve all fares based on the ferry_id
        $fares = Fares::where('ferry_id', $ferryId)->get();

        // Pass the seats and schedule to the view
        return view('admin.schedules.seats.seat', compact('seats', 'schedules', 'seatCount', 'fares'));
    }

    public function seatDeleteAll($scheduleId)
    {
        // Retrieve the schedule by ID
        $schedules = Schedules::find($scheduleId);
    
        // Check if the schedule exists
        if (!$schedules) {
            return redirect()->back()->with('error', 'No schedule was found.');
        }
    
        // Check if there are booked seats for the schedule
        $bookedSeatsCount = Seat::where('schedule_id', $scheduleId)->where('seat_status', 'booked')->count();
    
        if ($bookedSeatsCount > 0) {
            return redirect()->back()->with('error', 'Cannot delete seats. There are booked seats for the schedule.');
        }
    
        // Delete all seats with the specified schedule_id
        Seat::where('schedule_id', $scheduleId)->delete();
    
        return redirect()->back()->with('success', 'All seats for the schedule have been deleted.');
    }

    public function seatAddForm($scheduleId)
    {
        // Retrieve the schedule by ID
        $schedules = Schedules::find($scheduleId);

        // Check if the schedule exists
        if (!$schedules) {
            return redirect()->back()->with('error', 'No schedule was found.');
        }

        $seatCount = Seat::where('schedule_id', $scheduleId)->count();

        if($seatCount >= $schedules->ferries->capacity){
            return redirect()->back()->with('error', 'Max capacity already reached!');
        }

        // Get the ferry_id from the schedule
        $ferryId = $schedules->ferry_id;

        // Retrieve all fares based on the ferry_id
        $fares = Fares::where('ferry_id', $ferryId)->get();

        // Pass the seats and schedule to the view
        return view('admin.schedules.seats.crud.add-seat', compact('schedules', 'fares', 'seatCount'));
    }

    public function createSeats(Request $request, $scheduleId)
    {
        $validate = $request->validate([
            'seats.*' => 'required|integer',
            'seatCount' => 'required|integer',
        ]);

        if($validate){
            $seats = $request->input('seats');
            $seatingCounts = $request->input('seatCount');
    
            // Retrieve the schedule by ID
            $schedule = Schedules::find($scheduleId);
    
            // Check if the schedule exists
            if (!$schedule) {
                return redirect()->back()->with('error', 'No schedule was found.');
            }
    
            $ferry = Ferries::find($schedule->ferry_id);
    
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

            $total_counts = $seatingCounts + $totalseat;

            if($total_counts > $capacity){
                return redirect()->back()->with('error', 'Total seat is greater than capacity!');
            }
    
            if($totalseat > $capacity){
                return redirect()->back()->with('error', 'Total seat is greater than capacity!');
            }
    
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
                                'ferry_id' => $ferry->id,
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
                                'ferry_id' => $ferry->id,
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
        
                return redirect()->route('admin.schedule.seats', compact('schedule'))->with('success', 'Seats created successfully');

        } else{
             // Validation failed, return to the form with errors
             return redirect()->back()->withInput()->withErrors($request->validated());
        }
    }

    public function deleteSeat(Seat $seat)
    {
        // Delete the seat
        $seat->delete();
    
        // Redirect to a success page or return a success message
        return back()->with('success', 'Seat deleted successfully.');
    }

    public function editSeat(Request $request, $seatId)
    {
        // Validate the form data
        $request->validate([
            'seat_number' => 'required|string',
            'class' => 'required|string',
            'seat_status' => 'required|string|in:available,booked',
        ]);

        // Find the seat by ID
        $seat = Seat::find($seatId);

        // Check if the seat exists
        if (!$seat) {
            return redirect()->back()->with('error', 'Seat not found.');
        }

        // Update seat attributes
        $seat->seat_number = $request->input('seat_number');
        $seat->class = $request->input('class');
        $seat->seat_status = $request->input('seat_status');

        // Save the changes
        $seat->save();

        return redirect()->back()->with('success', 'Seat updated successfully');
    }

}
