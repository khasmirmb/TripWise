<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // View all the users WIP
    public function index(){
        return 'Hello from Users';
    }

    // Lets the user login
    public function login(Request $request){
        $validated = $request->validate([
            "email" => ['required', 'email'],
            'password' => 'required',
        ]);

        if(auth()->attempt($validated)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Welcome Back!');
        };
    }

    // Move to register page
    public function register(){
        return view('auth.register');
    }

    // Log out the user
    public function logout(Request $request){
        auth()->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logout Successful!');
    }

    // Create an user
    public function store(Request $request){
        $validated = $request->validate([
            "firstname" => ['required', 'min:4' ,'string', 'max:30'],
            "lastname" => ['required', 'min:4' ,'string', 'max:30'],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
            'type' => 'required|string',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        auth()->login($user);
    }
}
