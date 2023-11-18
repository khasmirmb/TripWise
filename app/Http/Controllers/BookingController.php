<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ports;
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
    public function manageBooking($user)
    {
        // Retrieve the user with their bookings
        $user = User::with('bookings')->find($user);

        if (!$user) {
            // Handle the case where the user is not found
            return back()->with('error', 'User not found.');
        }

        $bookings = $user->bookings()->latest()->paginate(10);

        return view('manage.index', compact('user', 'bookings'));
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
