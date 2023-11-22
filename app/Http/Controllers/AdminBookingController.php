<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function editBookingForm($booking)
    {
        $booking = Booking::find($booking);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        // Pass the user data to the view for editing
        return view('admin.bookings.crud.edit-booking', compact('booking'));
    }
}
