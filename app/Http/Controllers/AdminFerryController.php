<?php

namespace App\Http\Controllers;

use App\Models\Fares;
use App\Models\Ferries;
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

    // View Add Ferry Form
    public function addFerryForm()
    {
        return view('admin.ferries.crud.add-ferry');
    }

    // Add Ferry Process
    public function createFerry(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'type.*' => 'nullable|string|max:255',
            'price.*' => 'nullable|numeric',
        ]);

        if ($validate) {

            $ferry_name =$request->input('name');

            // Handle file upload (if an image is provided)
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $ferry_name . "_" . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('ferries'), $imageName);
            } else {
                $imageName = null; // No image provided
            }

            // Create a new Ferry instance and populate it with the form data
            $ferry = new Ferries();
            $ferry->name = $request->input('name');
            $ferry->capacity = $request->input('capacity');
            $ferry->description = $request->input('description');
            $ferry->image = $imageName; // Store the image file name

            $ferry->save();

            $newFerryId = $ferry->id;

            // Access the dynamically added fare inputs as arrays
            $types = $request->input('type', []);
            $prices = $request->input('price', []);

            // Loop through the arrays and process the fare inputs
            for ($i = 0; $i < count($types); $i++) {
                $type = $types[$i];
                $price = $prices[$i];

                // Check if fare inputs were provided
                if (!empty($type) && !empty($price)) {
                    // Create a new Fare instance and save it
                    $fare = new Fares();
                    $fare->ferry_id = $newFerryId;
                    $fare->type = $type;
                    $fare->price = $price;
                    $fare->save();
                }
            }

            return redirect()->route('admin.ferry')->with('success', 'Ferry created successfully');

        } else {
            // Validation failed, return to the form with errors
            return redirect()->back()->withInput()->withErrors($request->validated());
        }
    }
}
