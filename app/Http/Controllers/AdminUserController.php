<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone' => 'nullable|regex:/^09\d{9}$/',
            'password' => 'required|min:8|confirmed',
            'type' => 'required|in:0,1,2',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if ($validate) {
            // If the validation succeeds, create a new user
            $user = new User();
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
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
            if ($user->type === 1) {
                return redirect()->route('admin.admin')->with('success', 'User created successfully');
            } elseif ($user->type === 2) {
                return redirect()->route('admin.staff')->with('success', 'User created successfully');
            } else {
                return redirect()->route('admin.client')->with('success', 'User created successfully');
            }

        } else {
            // Validation failed, return to the form with errors
            return redirect()->back()->withInput()->withErrors($request->validated());
        }

    }
}
