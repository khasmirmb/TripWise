<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use App\Models\Booking;
use App\Models\ContactPerson;
use App\Models\Fares;
use App\Models\Fee;
use App\Models\Passenger;
use App\Models\Payment;
use App\Models\Ports;
use App\Models\Schedules;
use App\Models\Seat;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function changeSeat(Request $request)
    {

        $passengerId = $request->input('passengerId');

        $seatId = $request->input('selectedSeat');

        $passenger = Passenger::find($passengerId);

        if (!$passenger) {
            return response()->json(['error' => 'No passenger found'], 404);
        }

        if($passenger->seat_id){

            $seat = Seat::find($passenger->seat_id);
            if ($seat) {
                // Update the seat_status to "available"
                $seat->seat_status = 'available';
                $seat->save();
            }
        }

        $seat = Seat::find($seatId);

        if ($seat) {

            $passenger->seat_id = $seat->id;
            $passenger->save();

            $seat->seat_status = 'booked';
            $seat->save();
        } else {
            // Handle the case where the seat with the provided seatId was not found
            return response()->json(['error' => 'Seat not found'], 404);
        }

        // You can return a success response
        return response()->json(['message' => 'Seat updated successfully']);
    }
    // Update Booking
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

            $service = $booking->payment->service_total;

            $fee = Fee::firstOrNew();

            $total_amount = $total + $fee->rebooking_fee;

            $service_total = $service + $fee->rebooking_fee;

            $booking->status = $request->input('booking-status');
            $booking->schedule_id = $request->input('schedule');

            // Contact Info
            $booking->contactPerson->name = ucwords($request->input('contact-name'));
            $booking->contactPerson->email = $request->input('contact-email');
            $booking->contactPerson->phone = $request->input('contact-phone');
            $booking->contactPerson->address = $request->input('contact-address');

            // Payment
            $booking->payment->payment_amount = $total_amount;
            $booking->payment->service_total = $service_total;
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

    // Scheulde Add Form
    public function addBookingForm()
    {
        $ports = Ports::all();

        $schedules = Schedules::all();

        return view('admin.bookings.crud.add-booking', compact('schedules', 'ports'));
    }
    // AJAX Get Schedules
    public function getSchedules(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');

        $today = Carbon::now('Asia/Manila')->format('Y-m-d');

        $schedules = Schedules::join('ferries', 'schedules.ferry_id', '=', 'ferries.id')
        ->where('schedules.departure_port', $origin)
        ->where('schedules.arrival_port', $destination)
        ->whereDate('schedules.departure_date', '>=', $today)
        ->select('schedules.*', 'ferries.name as ferry_name')
        ->get();

        return response()->json(['schedules' => $schedules]);
    }
    // AJAX get Fares
    public function getFares(Request $request)
    {
        $scheduleId = $request->input('schedule_id');

        $schedule = Schedules::find($scheduleId);

        $fares = $schedule->ferries->fares;

        return response()->json(['fares' => $fares]);
    }

    public function createBooking(Request $request)
    {
        //dd($request->all());

        $request->validate([

            // Validation for schedule and fare
            'schedule' => 'required|exists:schedules,id',
            'fare' => 'required|exists:fares,id',

            // Validation for contact information
            'contact-name' => 'required|string|max:255',
            'contact-email' => 'required|email|max:255',
            'contact-phone' => 'required|numeric|digits:11',
            'contact-address' => 'required|string|max:255',

            // Validation for passenger information
            'firstname.*' => 'required|string|max:255',
            'middlename.*' => 'nullable|string|max:255',
            'lastname.*' => 'required|string|max:255',
            'birthday.*' => 'required|date',
            'gender.*' => 'required|in:Male,Female',

            // Validation for payment information
            'payment-method' => 'required|in:otc,gcash,paymaya,card,grab_pay',
            'payment-date' => 'required|date',
        ]);

        // Retrieve schedule data
        $schedule = Schedules::findOrFail($request->input('schedule'));

        // Retrieve fare data
        $fare = Fares::findOrFail($request->input('fare'));

        // Retrieve available seats based on schedule_id and class
        $availableSeats = Seat::where('schedule_id', $schedule->id)
        ->where('class', $fare->type)
        ->where('seat_status', 'available')
        ->get();

        // Check if there are enough available seats for the total number of passengers
        $totalPassengers = count($request->input('firstname'));

        if (count($availableSeats) < $totalPassengers) {
            // Redirect back with an error message
            return redirect()->back()->withInput()->with('error', 'Not enough available seats for the selected schedule and fare type.');
        }

        // Calculate total fare based on the fare price
        $totalFare = $totalPassengers * $fare->price;
        
        $payment = new Payment();
        $payment->payment_amount = $totalFare;
        $payment->depart_total = $totalFare;
        $payment->return_total = 0;
        $payment->discount_total = 0;
        $payment->service_total = 0;
        $payment->payment_date = $request->input('payment-date');
        $payment->payment_method = ucfirst($request->input('payment-method'));
        $payment->payment_status = 'Paid';

        $payment->save(); // Save the record to the database
        // Get ID
        $paymentId = $payment->id;

        // Create a new ContactPerson instance
        $contactPerson = new ContactPerson();
        $contactPerson->name = $request->input('contact-name');
        $contactPerson->email = $request->input('contact-email');
        $contactPerson->phone = $request->input('contact-phone');
        $contactPerson->address = $request->input('contact-address');

        $contactPerson->save(); // Save the record to the database
        // Get ID
        $contactPersonId = $contactPerson->id;

        // Generate random 4 letters
        $letters = Str::random(4);
        // Generate random 10 numbers
        $numbers = Str::random(11);

        $referenceNumber = $letters . '-' . $numbers;

        // Check for uniqueness
        do {
            $referenceNumber = $letters . '-' . $numbers;
        } while (Booking::where('reference_number', $referenceNumber)->exists());

        $booking = new Booking();
        $booking->contact_person_id = $contactPersonId;
        $booking->schedule_id = $schedule->id;
        $booking->payment_id = $paymentId;
        $booking->trip_type = 'One Way';
        $booking->status = 'Paid';
        $booking->reference_number = $referenceNumber;

        $booking->save(); // Save the record to the database

        Mail::to($request->input('contact-email'))->send(new BookingConfirmation($booking));
        
        // Get ID
        $bookingId = $booking->id;

        // Save each passenger to the database
        foreach ($request->input('firstname') as $index => $firstname) {
            $passenger = new Passenger([
                'first_name' => ucfirst($firstname),
                'middle_name' => ucfirst($request->input('middlename')[$index]),
                'last_name' => ucfirst($request->input('lastname')[$index]),
                'birthdate' => $request->input('birthday')[$index],
                'gender' => $request->input('gender')[$index],
                'accommodation' => $fare->type,
                'seat_id' => null,
                'discount_type' => 'Regular',
                'booking_id' => $bookingId,
            ]);

            $passenger->save(); // Save the record to the database
        }

        // Redirect back with success message
        return redirect()->route('admin.booking')->with('success', 'Booking created successfully');
    }
}
