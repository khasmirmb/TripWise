<?php

namespace App\Http\Controllers;

use App\Models\Fares;
use Illuminate\Http\Request;

class AdminFerryController extends Controller
{
    // Add Ferry Fare
    public function addFare(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'ferry_id' => 'required|numeric',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);
    
        if ($validatedData) {
            // Create a new Fare record
            $fare = new Fares();
            $fare->ferry_id = $request->ferry_id;
            $fare->type = $request->type;
            $fare->price = $request->price;
            $fare->notes = $request->notes;
    
            // Save the fare to the database
            $fare->save();
    
            return redirect()->back()->with('success', 'Fare added successfully');
        } else {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
    }

    // Edit Ferry Fare
    public function fareEdit(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        if ($validatedData) {
            // Retrieve the fare based on the ferry_id
            $fare = Fares::where('id', $request->id)->first();

            if ($fare) {
                // Update the fare record
                $fare->type = $request->type;
                $fare->price = $request->price;
                $fare->notes = $request->notes;

                // Save the changes
                $fare->save();

                return redirect()->back()->with('success', 'Fare updated successfully');
            } else {
                return redirect()->back()->with('error', 'Fare not found');
            }
        } else {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
    }

    // Delete Ferry Fare
    public function fareDelete($id)
    {
        $fare = Fares::find($id);

        if (!$fare) {
            return redirect()->back()->with('error', 'Fare not found.');
        }

        $fare->delete();

        return redirect()->back()->with('success', 'Fare deleted successfully.');
    }   
}
