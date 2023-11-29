<?php

namespace App\Http\Controllers;

use App\Models\Ferries;
use App\Models\Message;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function contactusIndex()
    {
        return view('contact-us');
    }

    public function messageSubmit(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $message = new Message();
        $message->email = $request->input('email');
        $message->subject = $request->input('subject');
        $message->message = $request->input('message');
        $message->read = false;
        $message->save();

        // You can also send a response back to the front-end if needed
        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function accommodationIndex()
    {
        $ferries = Ferries::all();

        return view('accommodation.accommodation', compact('ferries'));
    }

    public function bookingGuide()
    {
        return view('guidelines.booking');
    }

    public function rebookingGuide()
    {
        return view('guidelines.rebooking');
    }
}
