<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedules;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function editBookingForm($booking)
    {
        $booking = Booking::find($booking);

        $schedule = $booking->schedule;

        $schedules = Schedules::where('departure_port', $schedule->departure_port)
            ->where('arrival_port', $schedule->arrival_port)
            ->where('ferry_id', $schedule->ferry_id)
            ->get();

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        // Pass the user data to the view for editing
        return view('admin.bookings.crud.edit-booking', compact('booking', 'schedules'));
    }
}
