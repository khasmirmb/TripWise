<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Fee;
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

    public function logoUpdate(Request $request)
    {
        // Validate the request
        $request->validate([
            'picture-upload' => 'required|image|mimes:png|max:2048', // Only allow PNG files, adjust the validation rules as needed
        ]);

        // Check if the uploaded file is a PNG
        $file = $request->file('picture-upload');
        $extension = $file->getClientOriginalExtension();

        if ($extension != 'png') {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Only PNG files are allowed');
        }

        // Handle the file upload
        if ($request->hasFile('picture-upload')) {
            $file = $request->file('picture-upload');
            $fileName = 'tripwise.png'; // Desired file name

            // Delete the old logo
            if (file_exists(public_path('logo/' . $fileName))) {
                unlink(public_path('logo/' . $fileName));
            }

            // Move the new file to the public directory
            $file->move(public_path('logo'), $fileName);
        }

        // Add any other logic or redirect as needed
        return redirect()->back()->with('success', 'Logo updated successfully');
    }

    public function updateRebookingFee(Request $request)
    {
        // Validate the request
        $request->validate([
            'rebooking_fee' => 'required|numeric',
        ]);

        // Retrieve the fee from the database or create a new one if it doesn't exist
        $fee = Fee::firstOrNew();

        // Update the fee amount
        $fee->rebooking_fee = $request->input('rebooking_fee');
        
        // Save the fee to the database
        $fee->save();

        // Add any other logic or redirect as needed
        return redirect()->back()->with('success', 'Rebooking fee updated successfully');
    }

}
