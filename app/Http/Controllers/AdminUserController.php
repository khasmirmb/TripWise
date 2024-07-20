<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function addUserForm()
    {
        return view('admin.users.crud.add-user');
    }

    public function createUser(Request $request)
    {
        $validate = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone' => 'nullable|regex:/^09\d{9}$/',
            'password' => 'required|min:8|confirmed',
            'type' => 'required|in:0,1',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if ($validate) {
            // If the validation succeeds, create a new user
            $user = new User();
            $user->firstname = ucwords($request->input('firstname'));
            $user->middlename = ucwords($request->input('middlename'));
            $user->lastname = ucwords($request->input('lastname'));
            $user->email = $request->input('email');
            $user->phone_number = $request->input('phone');
            $user->password = Hash::make($request->input('password')); // Assuming you're using Hash for password hashing
            $user->type = $request->input('type');
            $user->address = $request->input('address');
    
            // Handle image upload if provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $request->input('firstname') . '_' . $request->input('lastname') . "_" . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('profile'), $imageName);
                $user->image = $imageName;
            }
    
            $user->save(); // Save the user to the database
    
            // Redirect or return a response indicating success
            if ($user->type == 'staff') {
                return redirect()->route('admin.staff')->with('success', 'User updated successfully');
            } else {
                return redirect()->route('admin.admin')->with('success', 'User updated successfully');
            }

        } else {
            // Validation failed, return to the form with errors
            return redirect()->back()->withInput()->withErrors($request->validated());
        }

    }
    // Edit User Form
    public function editUserForm($user)
    {
        $user = User::find($user);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Pass the user data to the view for editing
        return view('admin.users.crud.edit-user', compact('user'));
    }
    // Edit User Process
    public function updateUser(Request $request, $user, $type)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if ($validatedData) {

            // Find the user by ID
            $user = User::findOrFail($user);

            $user->firstname = ucwords($request->input('firstname'));
            $user->middlename = ucwords($request->input('middlename'));
            $user->lastname = ucwords($request->input('lastname'));
            $user->email = $request->input('email');
            $user->phone_number = $request->input('phone');
            $user->address = $request->input('address');

            // Update the password if it's provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            // Handle image upload (if an image is provided)
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $request->input('firstname') . '_' . $request->input('lastname') . "_" . time().'.'.$image->extension();
                $image->move(public_path('profile'), $imageName);
            
                // Delete the old image if it exists
                if ($user->image) {
                    $existingImagePath = public_path('profile') . '/' . $user->image;
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath);
                    }
                }

                $user->image = $imageName; // Store the image file name
            }

            $user->save(); // Save the user to the database
    
            // Redirect or return a response indicating success
            if ($type == 'staff') {
                return redirect()->route('admin.staff')->with('success', 'User updated successfully');
            } else {
                return redirect()->route('admin.admin')->with('success', 'User updated successfully');
            }

        } else {
            // Validation failed, return to the form with errors
            return redirect()->back()->withInput()->withErrors($request->validated());
        }
    }

    public function deleteUser(User $user)
    {
        // Check if the user is the currently authenticated admin user
        if (Auth::user()->id === $user->id) {
            return back()->with('error', 'You currently logged in and cant delete yourself.');
        }

        // Delete the user's image if it exists
        if ($user->image) {
            $imagePath = public_path('profile') . '/' . $user->image;
            
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file
            }
        }

        // Delete the user
        $user->delete();

        // Redirect to a success page or return a success message
        return back()->with('success', 'User deleted successfully.');
    }
}
