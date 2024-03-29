<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
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
            'type' => 'required|in:Economy,Aircon,Tourist,Business,Cabin,Suite',
            'price' => 'required|numeric',
            'seats' => 'required|numeric',
            'fare_image1' => 'required|image|mimes:jpeg,png,jpg',
            'fare_image2' => 'nullable|image|mimes:jpeg,png,jpg',
            'fare_image3' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        // Check if a fare with the same type already exists for the ferry
        $existingFare = Fares::where('ferry_id', $request->ferry_id)
                            ->where('type', $request->type)
                            ->first();

        if ($existingFare) {
            return redirect()->back()->withInput()->with('error', 'A fare with the same type already exists for this ferry.');
        }
    
        if ($validatedData) {

            $ferry = Ferries::find($request->ferry_id);

            $fare_image1 = $request->file('fare_image1');
            $fare_image1Name = $ferry->name . "_" . $request->type ."_1_" .time() . '.' . $fare_image1->getClientOriginalExtension();
            $fare_image1->move(public_path('ferries'), $fare_image1Name);

            // Handle file upload (if an image is provided)
            if ($request->hasFile('fare_image2')) {
                $image = $request->file('fare_image2');
                $fare_image2Name = $ferry->name . "_" . $request->type ."_2_" .time() . '.' . $fare_image1->getClientOriginalExtension();
                $image->move(public_path('ferries'), $fare_image2Name);
            } else {
                $fare_image2Name = null; // No image provided
            }

            // Handle file upload (if an image is provided)
            if ($request->hasFile('fare_image3')) {
                $image = $request->file('fare_image3');
                $fare_image3Name = $ferry->name . "_" . $request->type ."_3_" .time() . '.' . $fare_image1->getClientOriginalExtension();
                $image->move(public_path('ferries'), $fare_image3Name);
            } else {
                $fare_image3Name = null; // No image provided
            }


            // Create a new Fare record
            $fare = new Fares();
            $fare->ferry_id = $request->ferry_id;
            $fare->type = $request->type;
            $fare->price = $request->price;
            $fare->seats = $request->seats;
            $fare->fare_image1 = $fare_image1Name;
            $fare->fare_image2 = $fare_image2Name;
            $fare->fare_image3 = $fare_image3Name;
    
            // Save the fare to the database
            $fare->save();

            // Update the ferry's capacity based on the sum of all seats for that ferry
            $ferry = Ferries::find($request->ferry_id);
            if ($ferry) {
                $newCapacity = Fares::where('ferry_id', $request->ferry_id)->sum('seats');
                $ferry->capacity = $newCapacity;
                $ferry->save();
            }
    
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
            'ferry_id' => 'required|numeric',
            'type' => 'required|in:Economy,Aircon,Tourist,Business,Cabin,Suite',
            'price' => 'required|numeric',
            'seats' => 'required|numeric',
            'fare_image1' => 'nullable|image|mimes:jpeg,png,jpg',
            'fare_image2' => 'nullable|image|mimes:jpeg,png,jpg',
            'fare_image3' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if ($validatedData) {

            // Retrieve the fare based on the ferry_id
            $fare = Fares::where('id', $request->id)->first();

            // Update the ferry's capacity
            $ferry = Ferries::find($request->ferry_id);

            // Handle file upload (if an image is provided)
            if ($request->hasFile('fare_image1')) {
                $fare_image1 = $request->file('fare_image1');
                $fare_image1Name = $ferry->name . "_" . $request->type ."_1_" .time() . '.' . $fare_image1->getClientOriginalExtension();
                $fare_image1->move(public_path('ferries'), $fare_image1Name);
                
                // Delete the old image if it exists
                if ($fare->fare_image1) {
                    $existingImagePath = public_path('ferries') . '/' . $fare->fare_image1;
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath);
                    }
                }

            } else {
                $fare_image1Name = $fare->fare_image1; // Use the existing image if no new image is provided
            }

            // Handle file upload (if an image is provided)
            if ($request->hasFile('fare_image2')) {
                $fare_image2 = $request->file('fare_image2');
                $fare_image2Name = $ferry->name . "_" . $request->type ."_2_" .time() . '.' . $fare_image2->getClientOriginalExtension();
                $fare_image2->move(public_path('ferries'), $fare_image2Name);
                
                // Delete the old image if it exists
                if ($fare->fare_image2) {
                    $existingImagePath = public_path('ferries') . '/' . $fare->fare_image2;
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath);
                    }
                }

            } else {
                $fare_image2Name = $fare->fare_image2; // Use the existing image if no new image is provided
            }

            // Handle file upload (if an image is provided)
            if ($request->hasFile('fare_image3')) {
                $fare_image3 = $request->file('fare_image3');
                $fare_image3Name = $ferry->name . "_" . $request->type ."_3_" .time() . '.' . $fare_image3->getClientOriginalExtension();
                $fare_image3->move(public_path('ferries'), $fare_image3Name);
                
                // Delete the old image if it exists
                if ($fare->fare_image3) {
                    $existingImagePath = public_path('ferries') . '/' . $fare->fare_image3;
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath);
                    }
                }

            } else {
                $fare_image3Name = $fare->fare_image3; // Use the existing image if no new image is provided
            }

            if ($fare) {
                // Update the fare record
                $fare->type = $request->type;
                $fare->price = $request->price;
                $fare->seats = $request->seats;
                $fare->fare_image1 = $fare_image1Name;
                $fare->fare_image2 = $fare_image2Name;
                $fare->fare_image3 = $fare_image3Name;
                // Save the changes
                $fare->save();

                if ($ferry) {
                    // Calculate the new capacity based on the sum of all seats for the ferry
                    $newCapacity = Fares::where('ferry_id', $request->ferry_id)->sum('seats');
                    $ferry->capacity = $newCapacity;

                    // Save the changes to the ferry
                    $ferry->save();
                }

                return redirect()->back()->with('success', 'Fare updated successfully');
            } else {
                return redirect()->back()->withInput()->with('error', 'Fare not found');
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
    
        // Get the ferry associated with the fare
        $ferry = Ferries::find($fare->ferry_id);
    
        if (!$ferry) {
            return redirect()->back()->withInput()->with('error', 'Ferry not found for the specified fare.');
        }
    
        // Subtract the number of seats from the ferry's capacity
        $ferry->capacity = max(0, $ferry->capacity - $fare->seats);
    
        // Save the changes to the ferry's capacity
        $ferry->save();
    
        // Delete the fare
        $fare->delete();
    
        return redirect()->back()->with('success', 'Fare deleted successfully.');
    }

    // View Add Ferry Form
    public function addFerryForm()
    {

        $accommodations = Accommodation::all();

        return view('admin.ferries.crud.add-ferry', compact('accommodations'));
    }

    // Add Ferry Process
    public function createFerry(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'type.*' => 'required|in:Economy,Aircon,Tourist,Business,Cabin,Suite',
            'price.*' => 'required|numeric',
            'seats.*' => 'required|integer',
            'fare_image1.*' => 'required|image|mimes:jpeg,png,jpg',
            'fare_image2.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'fare_image3.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'upper' => 'nullable|image|mimes:jpeg,png,jpg',
            'middle' => 'nullable|image|mimes:jpeg,png,jpg',
            'lower' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if (empty($request->input('type')) || empty($request->input('price')) || empty($request->input('seats'))) {
            return redirect()->back()->withInput()->with('error', 'Please provide at least one fare details for the ferry capacity.');
        }

        $capacity = array_sum($request->input('seats'));

        // Check if there are duplicate type values
        $duplicateTypes = array_diff_assoc($request->type, array_unique($request->type));

        if (!empty($duplicateTypes)) {
            return redirect()->back()->withInput()->with('error', 'Ferry types must be unique.');
        }

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

            if ($request->hasFile('upper')) {
                $upper = $request->file('upper');
                $upperName = $ferry_name . "_" . "upperDeck" ."_" .time() . '.' . $upper->getClientOriginalExtension();
                $upper->move(public_path('ferries'), $upperName);
            } else {
                $upperName = null;
            }

            if ($request->hasFile('middle')) {
                $middle = $request->file('middle');
                $middleName = $ferry_name . "_" . "middleDeck" ."_" .time() . '.' . $middle->getClientOriginalExtension();
                $middle->move(public_path('ferries'), $middleName);
            } else {
                $middleName = null;
            }

            if ($request->hasFile('lower')) {
                $lower = $request->file('lower');
                $lowerName = $ferry_name . "_" . "lowerDeck" ."_" .time() . '.' . $lower->getClientOriginalExtension();
                $lower->move(public_path('ferries'), $lowerName);
            } else {
                $lowerName = null;
            }

            // Create a new Ferry instance and populate it with the form data
            $ferry = new Ferries();
            $ferry->name = $request->input('name');
            $ferry->capacity = $capacity;
            $ferry->description = $request->input('description');
            $ferry->image = $imageName; // Store the image file name
            $ferry->upper = $upperName; // Store the image file name
            $ferry->middle = $middleName; // Store the image file name
            $ferry->lower = $lowerName; // Store the image file name

            $ferry->save();

            $newFerryId = $ferry->id;

            // Access the dynamically added fare inputs as arrays
            $types = $request->input('type', []);
            $prices = $request->input('price', []);
            $seats = $request->input('seats', []);
            $fare_images1 = $request->file('fare_image1');
            $fare_images2 = $request->file('fare_image2');
            $fare_images3 = $request->file('fare_image3');

            // Loop through the arrays and process the fare inputs
            for ($i = 0; $i < count($types); $i++) {
                $type = $types[$i];
                $price = $prices[$i];
                $seat = $seats[$i];
                $fare_image1 = $fare_images1[$i];
                $fare_image2 = $fare_images2[$i] ?? null;
                $fare_image3 = $fare_images3[$i] ?? null;

                // Check if fare inputs were provided
                if (!empty($type) && !empty($price) && !empty($seat) && $request->hasFile('fare_image1')) {

                    $fare_name1 = $ferry_name . "_" . $type . "_1_" . time() . '.' . $fare_image1->getClientOriginalExtension();
                    $fare_image1->move(public_path('ferries'), $fare_name1);

                    // Create a new Fare instance and save it
                    $fare = new Fares();
                    $fare->ferry_id = $newFerryId;
                    $fare->type = $type;
                    $fare->price = $price;
                    $fare->seats = $seat;
                    $fare->fare_image1 = $fare_name1;

                    // Process and save fare_image2
                    if ($fare_image2) {
                        $fare_name2 = $ferry_name . "_" . $type . "_2_" . time() . '.' . $fare_image2->getClientOriginalExtension();
                        $fare_image2->move(public_path('ferries'), $fare_name2);
                        $fare->fare_image2 = $fare_name2;
                    }

                    // Process and save fare_image3
                    if ($fare_image3) {
                        $fare_name3 = $ferry_name . "_" . $type . "_3_" . time() . '.' . $fare_image3->getClientOriginalExtension();
                        $fare_image3->move(public_path('ferries'), $fare_name3);
                        $fare->fare_image3 = $fare_name3;
                    }

                    $fare->save();
                    
                }
            }

            return redirect()->route('admin.ferry')->with('success', 'Ferry created successfully');

        } else {
            // Validation failed, return to the form with errors
            return redirect()->back()->withInput()->withErrors($request->validated());
        }
    }

    public function editFerryForm($ferry)
    {
        $ferry = Ferries::find($ferry);

        if (!$ferry) {
            return redirect()->back()->with('error', 'Ferry not found.');
        }

        $accommodations = Accommodation::all();

        // Pass the user data to the view for editing
        return view('admin.ferries.crud.edit-ferry', compact('ferry', 'accommodations'));
    }

    // Update Ferry Process
    public function updateFerry(Request $request, $ferry)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'upper' => 'nullable|image|mimes:jpeg,png,jpg',
            'middle' => 'nullable|image|mimes:jpeg,png,jpg',
            'lower' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if ($validate) {

            // Find the ferry by ID
            $ferry = Ferries::findOrFail($ferry);

            // Update ferry properties with the validated data
            $ferry->name = $validate['name'];
            $ferry->description = $validate['description'];

            // Handle image upload (if an image is provided)
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $ferry->name . "_" . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('ferries'), $imageName);

                // Delete the old image if it exists
                if ($ferry->image) {
                    $existingImagePath = public_path('ferries') . '/' . $ferry->image;
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath);
                    }
                }

                $ferry->image = $imageName; // Store the image file name
            }

            if ($request->hasFile('upper')) {
                $upper = $request->file('upper');
                $upperName = $ferry->name . "_" . "upperDeck" ."_" .time() . '.' . $upper->getClientOriginalExtension();
                $upper->move(public_path('ferries'), $upperName);

                // Delete the old image if it exists
                if ($ferry->upper) {
                    $existingUpperDeck = public_path('ferries') . '/' . $ferry->upper;
                    if (file_exists($existingUpperDeck)) {
                        unlink($existingUpperDeck);
                    }
                }

                $ferry->upper = $upperName; // Store the image file name
            }

            if ($request->hasFile('middle')) {
                $middle = $request->file('middle');
                $middleName = $ferry->name . "_" . "middleDeck" ."_" .time() . '.' . $middle->getClientOriginalExtension();
                $middle->move(public_path('ferries'), $middleName);

                // Delete the old image if it exists
                if ($ferry->middle) {
                    $existingmiddleDeck = public_path('ferries') . '/' . $ferry->middle;
                    if (file_exists($existingmiddleDeck)) {
                        unlink($existingmiddleDeck);
                    }
                }

                $ferry->middle = $middleName; // Store the image file name
            }

            if ($request->hasFile('lower')) {
                $lower = $request->file('lower');
                $lowerName = $ferry->name . "_" . "lowerDeck" ."_" .time() . '.' . $lower->getClientOriginalExtension();
                $lower->move(public_path('ferries'), $lowerName);

                // Delete the old image if it exists
                if ($ferry->lower) {
                    $existinglowerDeck = public_path('ferries') . '/' . $ferry->lower;
                    if (file_exists($existinglowerDeck)) {
                        unlink($existinglowerDeck);
                    }
                }

                $ferry->lower = $lowerName; // Store the image file name
            }

            $ferry->save();

            return redirect()->route('admin.ferry')->with('success', 'Ferry updated successfully');

        } else {
            // Validation failed, return to the form with errors
            return redirect()->back()->withInput()->withErrors($request->validated());
        }
    }

    public function deleteFerry(Ferries $ferry)
    {
        // Check if the ferry has associated schedules
        if ($ferry->schedules()->exists()) {
            // Notify that the ferry cannot be deleted
            return back()->with('error', 'Cannot delete the ferry as it still has associated schedules');
        }

        if($ferry->fares()->exists()){
            $ferry->fares()->delete();
        }

        // Delete the ferry's image if it exists
        if ($ferry->image) {
            $imagePath = public_path('ferries') . '/' . $ferry->image;
            
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file
            }
        }

        if ($ferry->upper) {
            $upperImage = public_path('ferries') . '/' . $ferry->upper;
            
            if (file_exists($upperImage)) {
                unlink($upperImage); // Delete the image file
            }
        }

        if ($ferry->middle) {
            $middleImage = public_path('ferries') . '/' . $ferry->middle;
            
            if (file_exists($middleImage)) {
                unlink($middleImage); // Delete the image file
            }
        }

        if ($ferry->lower) {
            $lowerImage = public_path('ferries') . '/' . $ferry->lower;
            
            if (file_exists($lowerImage)) {
                unlink($lowerImage); // Delete the image file
            }
        }

        // If there are no related records, safely delete the ferry
        $ferry->delete();

        // Redirect to a success page or return a success message
        return back()->with('success', 'Ferry deleted successfully.');
    }
}
