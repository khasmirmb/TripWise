<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use App\Mail\ReturnBookingConfirmation;
use App\Models\Booking;
use App\Models\ContactPerson;
use App\Models\Passenger;
use App\Models\Payment;
use App\Models\Schedules;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentMethod extends Controller
{
    /**
     * Payment when it's a OTC
     */
    public function OTCBooking(Request $request)
    {
        // Payment Info ID
        $paymentId = session('payment_id');

        // Booking Contact Info ID
        $contactPersonId = session('contact_person_id');

        // Depart Booking Passenger and ID
        $departBookId = session('depart_book_id');

        $departSchedId = session('dep_sched_id');

        // Return Booking Passenger and ID
        $returnBookId = session('return_book_id');

        $returnSchedId = session('ret_sched_id');

        // Remove all the session that is being use after completed
        $request->session()->forget(['ret_total', 'totalDiscount', 'dep_total']);
        $request->session()->forget('contactPerson');
        $request->session()->forget('passengers');
        $request->session()->forget([
            'trip_type',
            'origin',
            'destination',
            'passenger',
            'depart_date',
            'return_date',
            'dep_sched_type',
            'dep_sched_price',
            'ret_sched_type',
            'ret_sched_price'
        ]);

        // Fetch the necessary data based on the IDs
        // One way only
        $payment = Payment::find($paymentId);

        $contactPerson = ContactPerson::find($contactPersonId);

        $departBooking = Booking::find($departBookId);
        $departPassengers = Passenger::where('booking_id', $departBookId)->get();
        
        $depSchedData = Schedules::find($departSchedId);

        // If there's a round trip
        if ($returnBookId) {

            $returnBooking = Booking::find($returnBookId);

            $returnPassengers = Passenger::where('booking_id', $returnBookId)->get();

            $retSchedData = Schedules::find($returnSchedId);

        } else {
            $retSchedData = null;
            $returnBooking = null;
            $returnPassengers = [];
        }
        
        return view('booking.complete', compact(
            'payment',
            'contactPerson',
            'departBooking',
            'depSchedData',
            'departPassengers',
            'returnBooking',
            'retSchedData',
            'returnPassengers',
            'paymentId',
            'contactPersonId',
            'departBookId',
            'returnBookId'
        ));
    }

    /**
     * WebHook (Not Done) -Need Deployment-
     */
    public function handleWebhook(Request $request)
    {
        dd($request->all());
    }

    /**
     * Online Payment when it's successful
     */
    public function paymentSuccess()
    {
        $sessionId = session('paymongo_session');

        $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions/'. $sessionId)
        ->withHeader('accept: application/json')
        ->withHeader('Authorization: Basic ' . env('PAYMONGO_SECRET_KEY'))
        ->asJson()
        ->get();

        $payments = $response->data->attributes->payments;

        foreach ($payments as $payment) {
            $paymongo_id = $payment->id;

            $attributes = $payment->attributes;

            $payment_status = $attributes->status;
            $payment_timestamp = $attributes->paid_at;
        }

        if(!$paymongo_id){
            return view('partials.404');
        }

        $trip_type = session('trip_type');
        $dep_sched_id = session('dep_sched_id');
        $dep_sched_type = session('dep_sched_type');
        $ret_sched_id = session('ret_sched_id');
        $ret_sched_type = session('ret_sched_type');
        $payment_method = $response->data->attributes->payment_method_used;
        $ret_total = session('ret_total');
        $dep_total = session('dep_total');
        $totalDiscount = session('totalDiscount');
        $total_amount = session('total_amount');
        $service_charge = session('service_charge');

        $payment_method = ucfirst($payment_method);
        $payment_status = ucfirst($payment_status);
        $payment_date = date("Y-m-d H:i:s", $payment_timestamp);

        $contactPersonData = session('contactPerson');

        if (Payment::where('paymongo_id', $paymongo_id)->exists()) {
            return redirect()->route('booking.online');
        }

        $payment = new Payment();
        $payment->payment_amount = $total_amount;
        $payment->depart_total = $dep_total;
        $payment->return_total = $ret_total;
        $payment->discount_total = $totalDiscount;
        $payment->service_total = $service_charge;
        $payment->payment_date = $payment_date;
        $payment->payment_method = $payment_method;
        $payment->payment_status = $payment_status;
        $payment->paymongo_id = $paymongo_id;

        $payment->save(); // Save the record to the database

        $paymentId = $payment->id;

        session(['payment_id' => $paymentId]);

        if (!empty($contactPersonData)) {
            $contactPerson = new ContactPerson();
            $contactPerson->name = $contactPersonData['name'];
            $contactPerson->phone = $contactPersonData['phone'];
            $contactPerson->email = $contactPersonData['email'];
            $contactPerson->address = $contactPersonData['address'];

            $contactPerson->save(); // Save the record to the database

            $newContactPersonId = $contactPerson->id;

            session(['contact_person_id' => $newContactPersonId]);
        }

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
        $booking->contact_person_id = $newContactPersonId;
        $booking->schedule_id = $dep_sched_id;
        $booking->payment_id = $paymentId;
        $booking->trip_type = $trip_type;
        $booking->status = $payment_status;
        $booking->reference_number = $referenceNumber;

        $booking->save(); // Save the record to the database

        Mail::to($contactPersonData['email'])->send(new BookingConfirmation($booking));

        $newBookingId = $booking->id;

        session(['depart_book_id' => $newBookingId]);

        $passengers = session('passengers');


        if (!empty($passengers)) {
            foreach ($passengers as $passengerData) {
                $passenger = new Passenger();
                $passenger->first_name = $passengerData['firstname'];
                $passenger->middle_name = $passengerData['middlename'];
                $passenger->last_name = $passengerData['lastname'];
                $passenger->gender = $passengerData['gender'];
                $passenger->birthdate = $passengerData['birthday'];
                $passenger->accommodation = $dep_sched_type;
                $passenger->discount_type = $passengerData['classification'];
                $passenger->booking_id = $newBookingId;
                
                // Save the passenger record to the database
                $passenger->save();

            }
        }

        if ($ret_sched_id) {
            // Generate random 4 letters
            $letters = Str::random(4);
            // Generate random 10 numbers
            $numbers = Str::random(11);
            
            // Check for uniqueness
            do {
                $referenceNumber = $letters . '-' . $numbers;
            } while (Booking::where('reference_number', $referenceNumber)->exists());
        
            $bookingReturn = new Booking();
            $bookingReturn->contact_person_id = $newContactPersonId;
            $bookingReturn->schedule_id = $ret_sched_id;
            $bookingReturn->payment_id = $paymentId;
            $bookingReturn->trip_type = $trip_type;
            $bookingReturn->status = $payment_status;
            $bookingReturn->reference_number = $referenceNumber;
        
            $bookingReturn->save(); // Save the record to the database

            Mail::to($contactPersonData['email'])->send(new ReturnBookingConfirmation($bookingReturn));

            $newbookingReturnid = $bookingReturn->id;

            session(['return_book_id' => $newbookingReturnid]);

            if (!empty($passengers)) {
                foreach ($passengers as $passengerData) {
                    $passenger = new Passenger();
                    $passenger->first_name = $passengerData['firstname'];
                    $passenger->middle_name = $passengerData['middlename'];
                    $passenger->last_name = $passengerData['lastname'];
                    $passenger->gender = $passengerData['gender'];
                    $passenger->birthdate = $passengerData['birthday'];
                    $passenger->accommodation = $ret_sched_type;
                    $passenger->discount_type = $passengerData['classification'];
                    $passenger->booking_id = $newbookingReturnid;
                    
                    // Save the passenger record to the database
                    $passenger->save();
                }
            }

        }
        
        return redirect()->route('booking.online');
    }
    
    /**
     * Payment when it's done and for seating
     */
    public function OnlinePaymentBooking(Request $request)
    {
        // Payment Info ID
        $paymentId = session('payment_id');

        // Booking Contact Info ID
        $contactPersonId = session('contact_person_id');

        // Depart Booking Passenger and ID
        $departBookId = session('depart_book_id');

        $departSchedId = session('dep_sched_id');

        // Return Booking Passenger and ID
        $returnBookId = session('return_book_id');

        $returnSchedId = session('ret_sched_id');
        
        $request->session()->forget(['ret_total', 'totalDiscount', 'dep_total', 'total_amount', 'service_charge']);
        $request->session()->forget('contactPerson');
        $request->session()->forget('passengers');
        $request->session()->forget([
            'trip_type',
            'origin',
            'destination',
            'passenger',
            'depart_date',
            'return_date',
            'dep_sched_type',
            'dep_sched_price',
            'ret_sched_type',
            'ret_sched_price',
        ]);
        

        // Fetch the necessary data based on the IDs
        // One way only
        $payment = Payment::find($paymentId);

        $contactPerson = ContactPerson::find($contactPersonId);

        $departBooking = Booking::find($departBookId);

        $departPassengers = Passenger::where('booking_id', $departBookId)->get();
        
        $depSchedData = Schedules::find($departSchedId);

        $departFerry = $depSchedData->ferries;

        $depart_accommodation = [];

        foreach ($departPassengers as $passenger) {
            $depart_accommodation[] = $passenger->accommodation;
        }

        $departSeats = Seat::where('ferry_id', $departFerry->id)
        ->where('schedule_id', $depSchedData->id)
        ->where('class', $depart_accommodation)
        ->get();

        // If there's a round trip
        if ($returnBookId) {
            $returnBooking = Booking::find($returnBookId);

            $returnPassengers = Passenger::where('booking_id', $returnBookId)->get();

            $retSchedData = Schedules::find($returnSchedId);

            $returnFerry = $retSchedData->ferries;

            $return_accommodation = [];

            foreach ($returnPassengers as $passenger) {
                $return_accommodation[] = $passenger->accommodation;
            }

            $returnSeats = Seat::where('ferry_id', $returnFerry->id)
            ->where('schedule_id', $retSchedData->id)
            ->where('class', $return_accommodation)
            ->get();

        } else {
            $returnFerry = null;
            $retSchedData = null;
            $returnBooking = null;
            $returnSeats = null;
            $returnPassengers = [];
        }

        return view('booking.seating', compact(
            'paymentId',
            'contactPersonId',
            'departFerry',
            'returnFerry',
            'departBookId',
            'returnBookId',
            'departPassengers',
            'departSeats',
            'returnPassengers',
            'returnSeats',
        ));
    }
}