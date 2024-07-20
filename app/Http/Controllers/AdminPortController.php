<?php

namespace App\Http\Controllers;

use App\Models\Ports;
use Illuminate\Http\Request;

class AdminPortController extends Controller
{
    // Add Port
    public function addPort(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255|exists:cities,city',
        ]);

        if ($validatedData) {
            // Create a new Fare record
            $port = new Ports();
            $port->name = $request->name;
            $port->location = $request->location;
    
            // Save the port to the database
            $port->save();
    
            return redirect()->back()->with('success', 'Port added successfully');
        } else {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

    }

    // Delete Port
    public function deletePort(Ports $port)
    {
        // Delete the port
        $port->delete();
    
        // Redirect to a success page or return a success message
        return back()->with('success', 'Port deleted successfully.');
    }

    // Edit Port
    public function editPort(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        if ($validatedData) {
            // Retrieve the fare based on the ferry_id
            $port = Ports::where('id', $request->id)->first();

            if ($port) {
                // Update the port record
                $port->name = $request->name;
                $port->location = $request->location;

                // Save the changes
                $port->save();

                return redirect()->back()->with('success', 'Port updated successfully');
            } else {
                return redirect()->back()->with('error', 'Port not found');
            }
        } else {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
    }
}
