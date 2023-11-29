<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Fee;
use App\Models\Passenger;
use App\Models\Schedules;
use App\Models\Seat;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function editBookingForm($booking)
    {
        $booking = Booking::find($booking);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        $fee = Fee::firstOrNew();

        $schedule = $booking->schedule;

        $schedules = Schedules::where('departure_port', $schedule->departure_port)
            ->where('arrival_port', $schedule->arrival_port)
            ->where('ferry_id', $schedule->ferry_id)
            ->get();

        $passengers = $booking->passengers;

        $accommodation = [];

        foreach ($passengers as $passenger) {
            $accommodation[] = $passenger->accommodation;
        }

        $seats = Seat::where('ferry_id', $schedule->ferry_id)
            ->where('schedule_id', $schedule->id)
            ->where('class', $accommodation)
            ->get();
        

        // Pass the user data to the view for editing
        return view('admin.bookings.crud.edit-booking', compact('booking', 'schedules', 'fee', 'seats'));
    }

    public function changeSeat(Request $request, $passenger, $booking)
    {
        // Validation rules
        $rules = [
            'seats' => 'required|exists:seats,id',
        ];

        // Validation messages
        $messages = [
            'seats.required' => 'Please select a seat.',
            'seats.exists' => 'Invalid seat selection.',
        ];

        // Validate the request
        $request->validate($rules, $messages);

        // Retrieve the selected seat
        $selected_seat = $request->input('seats');

        $booking = Booking::find($booking);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        $passenger = Passenger::find($passenger);

        if (!$passenger) {
            return redirect()->back()->with('error', 'Passenger not found.');
        }

        if($passenger->seat_id){

            $seat = Seat::find($passenger->seat_id);
            if ($seat) {
                // Update the seat_status to "available"
                $seat->seat_status = 'available';
                $seat->save();
            }
        }

        $seat = Seat::find($selected_seat);

        if ($seat) {

            $passenger->seat_id = $seat->id;
            $passenger->save();

            $seat->seat_status = 'booked';
            $seat->save();
        }

        return redirect()->back()->with('success', 'Passenger seat changed successfully');
    }

    public function updateBooking(Request $request, $bookingId)
    {
        // Validate the request
        $request->validate([
            'booking-status' => 'required|in:Pending,Canceled,Paid',
            'payment-method' => 'required|in:otc,gcash,paymaya,card,grab_pay',
            'payment-date' => 'required|date',
            'schedule' => 'required|exists:schedules,id',
            'contact-name' => 'required|string|max:255',
            'contact-email' => 'required|email|max:255',
            'contact-phone' => 'required|numeric',
            'contact-address' => 'required|string|max:255',

        ], [
            'schedule.required' => 'Please select a schedule.',
            'schedule.exists' => 'Invalid schedule selection.',
        ]);

        // Find the booking
        $booking = Booking::findOrFail($bookingId);

        if($request->input('booking-status') == 'Canceled')
        {
            // Clear Passenger Seat if Cancel
            foreach($booking->passengers as $passenger){

                $seat = Seat::find($passenger->seat_id);

                $seat->seat_status = 'available';
                $seat->save();

                $passenger = Passenger::find($passenger->id);

                $passenger->seat_id = null;
                $passenger->save();

            }

            $booking->status = $request->input('booking-status');
            $booking->status = $request->input('schedule');

            // Contact Info
            $booking->contactPerson->name = ucwords($request->input('contact-name'));
            $booking->contactPerson->email = $request->input('contact-email');
            $booking->contactPerson->phone = $request->input('contact-phone');
            $booking->contactPerson->address = $request->input('contact-address');

            // Payment
            $booking->payment->payment_status = $request->input('booking-status');
            $booking->payment->payment_method = ucwords($request->input('payment-method'));
            $booking->payment->payment_date = $request->input('payment-date');

            // Save changes
            $booking->contactPerson->save();
            $booking->payment->save();
            $booking->save();

            // Redirect back with success message
            return redirect()->route('admin.booking')->with('success', 'Booking canceled successfully');

        }

        if($booking->schedule->id != $request->input('schedule'))
        {
            // Clear Passenger Seat if Schedule Changed
            foreach($booking->passengers as $passenger){

                if ($passenger->seat_id) {
                    $seat = Seat::find($passenger->seat_id);
            
                    $seat->seat_status = 'available';
                    $seat->save();
            
                    $passenger = Passenger::find($passenger->id);
            
                    $passenger->seat_id = null;
                    $passenger->save();
                }
            }

            // Add Fee
            $total = $booking->payment->payment_amount;

            $fee = Fee::firstOrNew();

            $total_amount = $total + $fee->rebooking_fee;

            $booking->status = $request->input('booking-status');
            $booking->schedule_id = $request->input('schedule');

            // Contact Info
            $booking->contactPerson->name = ucwords($request->input('contact-name'));
            $booking->contactPerson->email = $request->input('contact-email');
            $booking->contactPerson->phone = $request->input('contact-phone');
            $booking->contactPerson->address = $request->input('contact-address');

            // Payment
            $booking->payment->payment_amount = $total_amount;
            $booking->payment->payment_status = $request->input('booking-status');
            $booking->payment->payment_method = ucwords($request->input('payment-method'));
            $booking->payment->payment_date = $request->input('payment-date');

        } else {

            $booking->status = $request->input('booking-status');

            // Contact Info
            $booking->contactPerson->name = ucwords($request->input('contact-name'));
            $booking->contactPerson->email = $request->input('contact-email');
            $booking->contactPerson->phone = $request->input('contact-phone');
            $booking->contactPerson->address = $request->input('contact-address');

            // Payment
            $booking->payment->payment_status = $request->input('booking-status');
            $booking->payment->payment_method = ucwords($request->input('payment-method'));
            $booking->payment->payment_date = $request->input('payment-date');
        }

        // Save changes
        $booking->contactPerson->save();
        $booking->payment->save();
        $booking->save();

        return redirect()->route('admin.booking')->with('success', 'Booking updated successfully');
    }
}
