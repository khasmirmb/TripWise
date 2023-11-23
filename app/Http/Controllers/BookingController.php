<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use App\Models\Ports;
use App\Models\Schedules;
use App\Models\Seat;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = Ports::all();

        $sessionKeys = [
            'payment_id',
            'contact_person_id',
            'depart_book_id',
            'return_book_id',
            'ret_total',
            'totalDiscount',
            'dep_total',
            'contactPerson',
            'passengers',
            'trip_type',
            'origin',
            'destination',
            'passenger',
            'depart_date',
            'return_date',
            'dep_sched_id',
            'dep_sched_type',
            'dep_sched_price',
            'ret_sched_id',
            'ret_sched_type',
            'ret_sched_price',
        ];
        
        foreach ($sessionKeys as $key) {
            session()->forget($key);
        }

        return view('booking.index', ['ports' => $data]);
    }

    /**
     * View all the booking of the client.
     */
    public function manageBooking()
    {
        session()->forget('booking');

        return view('manage.index');
    }

    /**
     * View all the booking of client
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

                return view('manage.manage', compact('booking'));
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
     * Select seat if not selected
    */
    public function bookingSeat($booking, $reference)
    {

        $booking = Booking::find($booking);

        if (!$booking) {
            // Handle the case where the booking is not found
            return back()->with('error', 'Booking not found.');
        }

        if($booking->reference_number != $reference){
            return back()->with('error', 'Reference Number not the same.');
        }

        $payment = $booking->payment;

        $contact = $booking->contactPerson;

        $passengers = $booking->passengers;

        $schedule = $booking->schedule;

        $ferry = $schedule->ferries;

        $accommodation = [];

        foreach ($passengers as $passenger) {
            $accommodation[] = $passenger->accommodation;
        }

        $seats = Seat::where('ferry_id', $ferry->id)
        ->where('schedule_id', $schedule->id)
        ->where('class', $accommodation)
        ->get();

        return view('manage.seat', compact('booking', 'payment', 'contact', 'passengers', 'schedule', 'ferry', 'seats'));

    }

    /**
     * Select seat if not selected
    */
    public function bookingRebook($booking, $reference, $schedule)
    {

        $booking = Booking::find($booking);

        if (!$booking) {
            return back()->with('error', 'Booking not found.');
        }

        if($booking->reference_number != $reference){
            return back()->with('error', 'Reference Number not the same.');
        }

        if($booking->schedule->schedule_number != $schedule){
            return back()->with('error', 'Schedule Number not the same.');
        }

        $payment = $booking->payment;

        $contact = $booking->contactPerson;

        $passengers = $booking->passengers;

        $schedule = $booking->schedule;

        $ferry = $schedule->ferries;

        $sched = Schedules::where('departure_port', $schedule->departure_port)
        ->where('arrival_port', $schedule->arrival_port)
        ->where('ferry_id', $ferry->id)
        ->where('departure_date', '>=', Carbon::today()->toDateString())
        ->whereRaw("CONCAT(departure_date, ' ', departure_time) > ?", [Carbon::now(new DateTimeZone('Asia/Manila'))->toDateTimeString()])
        ->get();

        $sched_list = $sched->sortBy('departure_date');

        return view('manage.rebook', compact('booking', 'schedule', 'sched_list'));

    }

    /**
     * Display the payment page rebook.
     */
    public function processBooking(Request $request, $booking, $reference, $schedule)
    {
        // Validate the form data
        $request->validate([
            'schedule' => 'required|exists:schedules,id',
        ]);

        $booking = Booking::find($booking);

        if (!$booking) {
            return back()->with('error', 'Booking not found.');
        }

        if($booking->reference_number != $reference){
            return back()->with('error', 'Reference Number not the same.');
        }

        if($booking->schedule->schedule_number != $schedule){
            return back()->with('error', 'Schedule Number not the same.');
        }

        $schedule = Schedules::findOrFail($request->input('schedule'));

        $payment = $booking->payment->payment_amount;

        $percentageAmount = $payment * 0.05;

        $final_amount = $percentageAmount + 110;
  
        // Redirect to a success page or perform other actions
        return view('manage.payment', compact('booking', 'schedule', 'final_amount'));
    }

    /**
     * Payment Process for rebooking.
     */
    public function processPayment(Request $request, $booking, $schedule)
    {
        $payment_method = $request->input('payment_method');

        $booking = Booking::find($booking);

        if (!$booking) {
            return back()->with('error', 'Booking not found.');
        }

        $schedule = Schedules::find($schedule);

        if (!$schedule) {
            return back()->with('error', 'Schedule not found.');
        }

        $payment = $booking->payment->payment_amount;

        $percentageAmount = $payment * 0.05;

        $final_amount = $percentageAmount + 110;

        $total_amount = $final_amount;

        // Adjust the total based on the payment method
        $service_charge = 0; // Initializing the service charge

        if ($payment_method === 'gcash') {
            $service_charge = $total_amount * 0.025;
            $total_amount += $service_charge; // Increase by 2.5% for 'gcash'
        } elseif ($payment_method === 'paymaya') {
            $service_charge = $total_amount * 0.020;
            $total_amount += $service_charge; // Increase by 2.0% for 'paymaya'
        } elseif ($payment_method === 'grab_pay') {
            $service_charge = $total_amount * 0.022;
            $total_amount += $service_charge; // Increase by 2.2% for 'grab_pay'
        } elseif ($payment_method === 'card') {
            $service_charge = $total_amount * 0.035;
            $total_amount += $service_charge; // Increase by 3.5% for 'card'
        }

        // Convert the adjusted total_amount to cents
        $total = intval($total_amount * 100);


        session(['booking_id' => $booking->id, 'schedule_id' => $schedule->id, 'service' => $total_amount]);

        $data = [
            'data' => [
                'attributes' => [
                    'billing' => [
                        'name' => $booking->contactPerson->name,
                        'email' => $booking->contactPerson->email,
                        'phone' => $booking->contactPerson->phone,
                    ],
                    'line_items' =>[

                        [
                            'currency'      => 'PHP',
                            'amount'        => $total,
                            'name'          => 'TripWise Fare',
                            'quantity'      => 1,
                        ]
                    
                    ],
                    'payment_method_types' => [
                        $payment_method
                    ],
                    'success_url' => 'http://trip-wise.online/booking/manage/success',
                    'cancel_url' => 'http://trip-wise.online/booking/manage',
                    'description'   => 'TripWise Fare Booking',
                    'send_email_receipt' => true,
                ],
                
            ]
        ];

        $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions')
        ->withHeader('Content-Type: application/json')
        ->withHeader('accept: application/json')
        ->withHeader('Authorization: Basic ' . env('PAYMONGO_SECRET_KEY'))
        ->withData($data)
        ->asJson()
        ->post();
                        
        Session::put('session_id', $response->data->id);

        return redirect()->to($response->data->attributes->checkout_url);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function rebookSuccess()
    {
        $sessionId = Session::get('session_id');

        $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions/'. $sessionId)
        ->withHeader('accept: application/json')
        ->withHeader('Authorization: Basic ' . env('PAYMONGO_SECRET_KEY'))
        ->asJson()
        ->get();

        $payment_data = $response->data->attributes->payments;

        foreach ($payment_data as $payment) {
            $paymongo_id = $payment->id;

            $attributes = $payment->attributes;

            $payment_status = $attributes->status;
            $payment_timestamp = $attributes->paid_at;
        }

        $payment_method = ucfirst($response->data->attributes->payment_method_used);
        $payment_status = ucfirst($payment_status);
        $payment_date = date("Y-m-d H:i:s", $payment_timestamp);


        $booking_id = session('booking_id');
        $schedule_id = session('schedule_id');
        $service = session('service');

        $booking = Booking::find($booking_id);

        if (!$booking) {
            return back()->with('error', 'Booking not found.');
        }

        $passengers = $booking->passengers;

        foreach($passengers as $passenger){
            if ($passenger->seat_id) {
                // Find the corresponding seat and update it to available
                $seat = Seat::find($passenger->seat_id);
        
                if ($seat) {
                    $seat->update(['seat_status' => 'available']);
                }

                $passenger->seat_id = null;
                $passenger->save();
            }
        }

        $payment = $booking->payment;

        if ($payment) {
            $payment->update([
                'service_total' => $service,
                'payment_date' => $payment_date,
                'payment_status' => $payment_status,
                'payment_method' => $payment_method,
                'paymongo_id' => $paymongo_id,
            ]);

            // Generate random 4 letters
            $letters = Str::random(4);
            // Generate random 10 numbers
            $numbers = Str::random(11);

            $referenceNumber = $letters . '-' . $numbers;

            // Check for uniqueness
            do {
                $referenceNumber = $letters . '-' . $numbers;
            } while (Booking::where('reference_number', $referenceNumber)->exists());

            $booking->update([
                'schedule_id' => $schedule_id,
                'reference_number' => $referenceNumber,
            ]);
        }
        
        Mail::to($booking->contactPerson->email)->send(new BookingConfirmation($booking));

        session()->forget(['booking_id', 'schedule_id', 'service']);

        return redirect()->route('booking.seats', ['booking' => $booking_id, 'reference' => $referenceNumber]);
    }
}
