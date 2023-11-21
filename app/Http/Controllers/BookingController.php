<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ports;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = Ports::all();

        return view('booking.index', ['ports' => $data]);
    }

    /**
     * View all the booking of the user.
     */
    public function manageBooking()
    {
        return view('manage.index');
    }

    /**
     * View all the booking of the user.
     */
    public function findBooking(Request $request)
    {
        // Validate the form data
        $request->validate([
            'booking_reference' => 'required|string',
            'email' => 'required|email',
        ]);

        // Retrieve the input data
        $bookingReference = $request->input('booking_reference');
        $email = $request->input('email');

        $booking = Booking::where('reference_number', $bookingReference)->first();

        if ($booking) {
            // Booking found, now check if the provided email matches
            if ($booking->contactPerson->email == $email) {

                return redirect()->back()->with('success', 'Booking found successfully!');
            } else {
                // Email doesn't match the booking
                return redirect()->back()->withInput()->with('error', 'Invalid email for the provided booking reference.');
            }
        } else {
            // Booking not found
            return redirect()->back()->withInput()->with('error', 'Booking not found with the provided reference number.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
