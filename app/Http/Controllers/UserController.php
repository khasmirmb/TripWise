<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function QRScanStaff()
    {
        return view('staff.scan.scan');
    }

    public function QRScanAdmin()
    {
        return view('admin.scan.scan');
    }

    public function staffcheckBooking(Request $request)
    {
        $request->validate([
            'reference' => 'required|string',
        ]);

        $referenceNumber = $request->input('reference');

        // Find the booking based on the reference number
        $booking = Booking::where('reference_number', $referenceNumber)->first();

        if ($booking) {
            // Check if the status is not equal to "Paid"
            if ($booking->status !== 'Paid') {
                return back()->withInput()->with('error', 'Booking is not paid.');
            }

            $passengers = $booking->passengers;

            $schedule = $booking->schedule;
            
            // Redirect or return a response as needed
            return view('staff.scan.sucess', compact('passengers', 'schedule'));
        }

        // If no booking is found, return back with an error
        return back()->withInput()->with('error', 'Booking not found.');
    }

    public function admincheckBooking(Request $request)
    {
        $request->validate([
            'reference' => 'required|string',
        ]);

        $referenceNumber = $request->input('reference');

        // Find the booking based on the reference number
        $booking = Booking::where('reference_number', $referenceNumber)->first();

        if ($booking) {
            // Check if the status is not equal to "Paid"
            if ($booking->status !== 'Paid') {
                return back()->withInput()->with('error', 'Booking is not paid.');
            }

            $passengers = $booking->passengers;

            $schedule = $booking->schedule;
            
            // Redirect or return a response as needed
            return view('admin.scan.sucess', compact('passengers', 'schedule'));
        }

        // If no booking is found, return back with an error
        return back()->withInput()->with('error', 'Booking not found.');
    }
}
