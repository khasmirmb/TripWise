<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ContactPerson;
use App\Models\Passenger;
use App\Models\Payment;
use App\Models\Schedules;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Support\Str;
use Curl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the payment page and collect all data.
     */
    public function payment(Request $request)
    {
        // Define validation rules for the form fields
        $rules = [
            'contact-person' => 'required|string',
            'phone' => 'required|regex:/^09\d{9}$/',
            'email' => 'required|email',
            'confirm-email' => 'required|email|same:email',
            'address' => 'required|string',
        ];
    
        $passengerCount = session('passenger');

        $contactPerson = [
            'name' => $request->input('contact-person'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
        ];
    
        $passengers = []; // Initialize an array to store passenger data
    
        for ($x = 1; $x <= $passengerCount; $x++) {
            $rules["firstname{$x}"] = 'required|string';
            $rules["middlename{$x}"] = 'string';
            $rules["lastname{$x}"] = 'required|string';
            $rules["gender{$x}"] = ['required', Rule::in(['Male', 'Female'])];
            $rules["birthday{$x}"] = 'required|date';
    
            if ($request->has("discountToggle{$x}")) {
                $rules["dis_type{$x}"] = 'required|string';
                $rules["id_front{$x}"] = 'required|image';
                $rules["id_back{$x}"] = 'required|image';
            }
        }

        $messages = [];

        for ($x = 1; $x <= $passengerCount; $x++) {
            $messages["firstname{$x}.required"] = "The first name for passenger {$x} is required.";
            $messages["firstname{$x}.string"] = "The first name for passenger {$x} must be a string.";
            $messages["middlename{$x}.string"] = "The middle name for passenger {$x} must be a string.";
            $messages["lastname{$x}.required"] = "The last name for passenger {$x} is required.";
            $messages["lastname{$x}.string"] = "The last name for passenger {$x} must be a string.";
            $messages["gender{$x}.required"] = "The gender for passenger {$x} is required.";
            $messages["gender{$x}.in"] = "The selected gender for passenger {$x} is invalid.";
            $messages["birthday{$x}.required"] = "The date of birth for passenger {$x} is required.";
            $messages["birthday{$x}.date"] = "The date of birth for passenger {$x} must be a valid date.";
        
            if ($request->has("discountToggle{$x}")) {
                $messages["dis_type{$x}.required"] = "The discount type for passenger {$x} is required.";
                $messages["dis_type{$x}.string"] = "The discount type for passenger {$x} must be a string.";
                $messages["id_front{$x}.required"] = "The front of ID for passenger {$x} is required.";
                $messages["id_front{$x}.image"] = "The front of ID for passenger {$x} must be an image.";
                $messages["id_back{$x}.required"] = "The back of ID for passenger {$x} is required.";
                $messages["id_back{$x}.image"] = "The back of ID for passenger {$x} must be an image.";
            }
        }

        $validator = $request->validate($rules, $messages);
    
        // Perform image classification and add more validation
        for ($x = 1; $x <= $passengerCount; $x++) {
            if ($request->has("discountToggle{$x}")) {
                // Get the uploaded image files
                $idFrontFile = $request->file("id_front{$x}");
                $idBackFile = $request->file("id_back{$x}");
    

                // Perform OCR on the images
                $idFrontText = (new TesseractOCR($idFrontFile))->lang('eng')->run();
                $idBackText = (new TesseractOCR($idBackFile))->lang('eng')->run();
    
                // Initialize the classification based on dis_type
                $classification = '';
    
                // Check for dis_type classifications
                if ($request->input("dis_type{$x}") === 'Student') {
                    if (preg_match('/\b\d{4}-\d{4}\b/', $idFrontText) || preg_match('/\b\d{4}-\d{4}\b/', $idBackText)) {
                        $classification = 'Student';
                    }
                } elseif ($request->input("dis_type{$x}") === 'Senior') {
                    if (stripos($idFrontText, 'senior') !== false || stripos($idBackText, 'senior') !== false) {
                        $classification = 'Senior';
                    }
                } elseif ($request->input("dis_type{$x}") === 'PWD') {
                    if (stripos($idFrontText, 'disability') !== false || stripos($idBackText, 'disability') !== false) {
                        $classification = 'PWD';
                    }
                }

                if (empty($classification)) {
                    // If none of the classifications matched, you may handle it as an error
                    return redirect()->back()->withInput()->withErrors([
                        "dis_type{$x}" => 'Image does not match the selected discount type.',
                    ]);
                }
    
                // Store passenger data in the array
                $passengerData = [
                    'firstname' => $request->input("firstname{$x}"),
                    'middlename' => $request->input("middlename{$x}"),
                    'lastname' => $request->input("lastname{$x}"),
                    'gender' => $request->input("gender{$x}"),
                    'birthday' => $request->input("birthday{$x}"),
                    'classification' => $classification,
                ];
    
                $passengers[] = $passengerData;

            } else {
                // Handle passengers with no classification (e.g., store them as 'Unclassified')
                $passengerData = [
                    'firstname' => $request->input("firstname{$x}"),
                    'middlename' => $request->input("middlename{$x}"),
                    'lastname' => $request->input("lastname{$x}"),
                    'gender' => $request->input("gender{$x}"),
                    'birthday' => $request->input("birthday{$x}"),
                    'classification' => 'Regular',
                ];
    
                $passengers[] = $passengerData;
            }
        }

        // Store in a session Passenger and Contact Person
        session(['passengers' => $passengers]);

        session(['contactPerson' => $contactPerson]);

        // Retrieve session variables
        $trip_type = session('trip_type');
        $origin = session('origin');
        $destination = session('destination');
        $passenger = session('passenger');

        $depart_date = session('depart_date');
        $return_date = session('return_date');
        
        $dep_sched_id = session('dep_sched_id');
        $dep_sched_type = session('dep_sched_type');
        $dep_sched_price = session('dep_sched_price');

        $ret_sched_id = session('ret_sched_id');
        $ret_sched_type = session('ret_sched_type');
        $ret_sched_price = session('ret_sched_price');
        
        return view('booking.payment', compact(
            'trip_type',
            'origin',
            'destination',
            'depart_date',
            'return_date',
            'passenger',
            'dep_sched_id',
            'dep_sched_type',
            'dep_sched_price',
            'ret_sched_id',
            'ret_sched_type',
            'ret_sched_price'
        ), ['contactPerson' => $contactPerson, 'passengers' => $passengers]);
    }


    /**
     * Payment Process
     */
    public function paymentProcess(Request $request)
    {
        
        $payment_method = $request->input('payment_method');

        $ret_total = session('ret_total');
        $dep_total = session('dep_total');
        $totalDiscount = session('totalDiscount');

        session()->forget(['ret_total', 'totalDiscount', 'dep_total']);
        
        $total_amount = ($dep_total + $ret_total) - $totalDiscount;
        
        // Adjust the total based on the payment method
        if ($payment_method === 'gcash') {
            $total_amount += $total_amount * 0.025; // Increase by 2.5% for 'gcash'
        } elseif ($payment_method === 'paymaya') {
            $total_amount += $total_amount * 0.020; // Increase by 2.0% for 'paymaya'
        } elseif ($payment_method === 'grab_pay') {
            $total_amount += $total_amount * 0.022; // Increase by 2.2% for 'grab_pay'
        } elseif ($payment_method === 'card') {
            $total_amount += $total_amount * 0.035; // Increase by 3.5% for 'card'
        }
        
        // Convert the adjusted total_amount to cents
        $total = intval($total_amount * 100);

        // If over the counter payment
        if($payment_method == "counter"){

            $user = Auth::id();

            $dep_sched_id = session('dep_sched_id');

            $ret_sched_id = session('ret_sched_id');

            $contactPersonData = session('contactPerson');

            if (!empty($contactPersonData)) {
                $contactPerson = new ContactPerson();
                $contactPerson->name = $contactPersonData['name'];
                $contactPerson->phone = $contactPersonData['phone'];
                $contactPerson->email = $contactPersonData['email'];
                $contactPerson->address = $contactPersonData['address'];

                $contactPerson->save(); // Save the record to the database

                $newContactPersonId = $contactPerson->id;
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
            $booking->user_id = $user;
            $booking->contact_person_id = $newContactPersonId;
            $booking->schedule_id = $dep_sched_id;
            $booking->payment_id = null;
            $booking->status = 'Pending';
            $booking->reference_number = $referenceNumber;

            $booking->save(); // Save the record to the database

            $newBookingId = $booking->id;

            $passengers = session('passengers');

            if (!empty($passengers)) {
                foreach ($passengers as $passengerData) {
                    $passenger = new Passenger();
                    $passenger->first_name = $passengerData['firstname'];
                    $passenger->middle_name = $passengerData['middlename'];
                    $passenger->last_name = $passengerData['lastname'];
                    $passenger->gender = $passengerData['gender'];
                    $passenger->birthdate = $passengerData['birthday'];
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
                $bookingReturn->user_id = $user;
                $bookingReturn->contact_person_id = $newContactPersonId;
                $bookingReturn->schedule_id = $ret_sched_id;
                $bookingReturn->payment_id = null;
                $bookingReturn->status = 'Pending';
                $bookingReturn->reference_number = $referenceNumber;
            
                $bookingReturn->save(); // Save the record to the database

                $newbookingReturnid = $bookingReturn->id;

                if (!empty($passengers)) {
                    foreach ($passengers as $passengerData) {
                        $passenger = new Passenger();
                        $passenger->first_name = $passengerData['firstname'];
                        $passenger->middle_name = $passengerData['middlename'];
                        $passenger->last_name = $passengerData['lastname'];
                        $passenger->gender = $passengerData['gender'];
                        $passenger->birthdate = $passengerData['birthday'];
                        $passenger->discount_type = $passengerData['classification'];
                        $passenger->booking_id = $newbookingReturnid;
                        
    
                        // Save the passenger record to the database
                        $passenger->save();
                    }
                }

            }

            $request->session()->forget('contactPerson');
                /// Where I Stopped
            $request->session()->forget('passengers');

            $request->session()->forget([
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
                'ret_sched_price'
            ]);
            
            return redirect()->route('booking.otc');
        }
        // If its over the counter payment
        else{

            $data = [
                'data' => [
                    'attributes' => [
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
                        'success_url' => 'http://localhost:8000/booking/success',
                        'cancel_url' => 'http://localhost:8000/booking/search',
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
    }

    /**
     * Payment when it's a OTC
     */
    public function OTCBooking()
    {
        return view('booking.complete');
    }

    /**
     * Payment when it's successful
     */
    public function paymentSuccess()
    {
        $sessionId = Session::get('session_id');

        $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions/'. $sessionId)
                        ->withHeader('accept: application/json')
                        ->withHeader('Authorization: Basic ' . env('PAYMONGO_SECRET_KEY'))
                        ->asJson()
                        ->get();
        dd($response);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
