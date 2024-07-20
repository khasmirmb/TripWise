<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Booking;
use App\Models\Fares;
use App\Models\Schedules;
use Illuminate\Http\Request;

class FaresController extends Controller
{

    public function addAccommodation(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if ($validatedData) {
            // Create a new Fare record
            $accommodation = new Accommodation();
            $accommodation->acc_type = $request->name;
    
            // Save the accommodation to the database
            $accommodation->save();
    
            return redirect()->back()->with('success', 'Accommodation added successfully');
        } else {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
    }

    // Delete Accommodation
    public function deleteAcommodation(Accommodation $accommodation)
    {
        // Delete the port
        $accommodation->delete();
    
        // Redirect to a success page or return a success message
        return back()->with('success', 'Accommodation deleted successfully.');
    }

    // Edit Accommodation
    public function editAccommodation(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|string|max:255',
        ]);

        if ($validatedData) {
            
            $accommodation = Accommodation::where('id', $request->id)->first();

            if ($accommodation) {
                // Update the accommodation record
                $accommodation->acc_type = $request->name;

                // Save the changes
                $accommodation->save();

                return redirect()->back()->with('success', 'Accommodation updated successfully');
            } else {
                return redirect()->back()->with('error', 'Accommodation not found');
            }
        } else {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
    }
}
