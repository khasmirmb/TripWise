<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Schedules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Support\Str;

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
    
        $passengerCount = $request->input('passenger');

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

        // Use old() to retrieve old input data
        $trip_type = old('trip_type', $request->input('trip_type'));
        $origin = old('origin', $request->input('origin'));
        $destination = old('destination', $request->input('destination'));
        $depart_date = old('depart_depart_valid', $request->input('depart_depart_valid'));
        $return_date = old('return_depart_valid', $request->input('return_depart_valid'));
        $passenger = old('passenger', $request->input('passenger'));
        $dep_sched_id = old('dep_sched_id', $request->input('dep_sched_id'));
        $dep_sched_type = old('dep_sched_type', $request->input('dep_sched_type'));
        $dep_sched_price = old('dep_sched_price', $request->input('dep_sched_price'));
        $ret_sched_id = old('ret_sched_id', $request->input('ret_sched_id'));
        $ret_sched_type = old('ret_sched_type', $request->input('ret_sched_type'));
        $ret_sched_price = old('ret_sched_price', $request->input('ret_sched_price'));
    
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
