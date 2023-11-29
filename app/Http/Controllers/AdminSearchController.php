<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\City;
use App\Models\ContactPerson;
use App\Models\Fares;
use App\Models\Ferries;
use App\Models\Passenger;
use App\Models\Payment;
use App\Models\Ports;
use App\Models\Schedules;
use App\Models\Seat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSearchController extends Controller
{
    // Search for User Staff
    public function staffSearch(Request $request)
    {
        $query = $request->input('query');
        $staffs = User::where(function($queryBuilder) use ($query) {
            $queryBuilder
                ->where('firstname', 'like', "%$query%")
                ->orWhere('lastname', 'like', "%$query%")
                ->orWhere('phone_number', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%");
        })
        ->where('type', 2)
        ->paginate(10);

        return view('admin.users.staff', compact('staffs', 'query'));
    }

    // Search for User Admin
    public function adminSearch(Request $request)
    {
        $query = $request->input('query');
        $admins = User::where(function($queryBuilder) use ($query) {
            $queryBuilder
                ->where('firstname', 'like', "%$query%")
                ->orWhere('lastname', 'like', "%$query%")
                ->orWhere('phone_number', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%");
        })
        ->where('type', 1)
        ->paginate(10);

        return view('admin.users.admin', compact('admins', 'query'));
    }

    // Search for Ferries
    public function ferrySearch(Request $request)
    {
        $query = $request->input('query');
        $ferries = Ferries::where('name', 'like', "%$query%")
            ->orWhere('capacity', 'like', "%$query%")
            ->paginate(10);

        return view('admin.ferries.ferry', compact('ferries', 'query'));
    }

    // Search for Port
    public function portSearch(Request $request)
    {
        $query = $request->input('query');
        $ports = Ports::where(function($queryBuilder) use ($query) {
            $queryBuilder
                ->where('name', 'like', "%$query%")
                ->orWhere('location', 'like', "%$query%");
        })
        ->orderBy('name', 'asc')
        ->paginate(10);

        $cities = City::orderBy('city', 'asc')->get();

        return view('admin.ports.port', compact('ports', 'cities', 'query'));
    }
    
    // Search for Schedule
    public function scheduleSearch(Request $request)
    {
        $query = $request->input('query');
        $schedules = Schedules::query();

        // Search in the related ferry's name
        $schedules->whereHas('ferries', function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', "%$query%");
        });

        // Search in the departure port
        $schedules->orWhere('departure_port', 'like', "%$query%");

        // Search in the schedule_status
        $schedules->orWhere('schedule_status', 'like', "%$query%");

        // Search in the schedule_status
        $schedules->orWhere('schedule_number', 'like', "%$query%");

        $schedules = $schedules->orderBy('departure_date')->paginate(10);

        return view('admin.schedules.schedule', compact('schedules', 'query'));
    }

    // Filter for Schedule
    public function scheduleFilter(Request $request)
    {
        $selectedMonths = $request->input('months', []);

        // Fetch schedules based on selected months
        $schedules = Schedules::when(count($selectedMonths) > 0, function ($query) use ($selectedMonths) {
            $query->whereIn(DB::raw('MONTH(departure_date)'), $selectedMonths);
        })->orderBy('departure_date')->paginate(10);

        return view('admin.schedules.schedule', compact('schedules'));
    }

    // Seat Search
    public function seatSearch(Request $request, $scheduleId)
    {
        $query = $request->input('query');
    
        $schedules = Schedules::find($scheduleId);
    
        $seats = Seat::where('schedule_id', $scheduleId)
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('seat_number', 'like', "%$query%")
                    ->orWhere('seat_status', 'like', "%$query%")
                    ->orWhere('class', 'like', "%$query%");
            })
            ->orderBy('class', 'asc')
            ->paginate(10);

        $ferryId = $schedules->ferry_id;

        $seatCount = Seat::where('schedule_id', $scheduleId)->count();

        // Retrieve all fares based on the ferry_id
        $fares = Fares::where('ferry_id', $ferryId)->get();
    
        return view('admin.schedules.seats.seat', compact('seats', 'schedules', 'query', 'seatCount', 'fares'));
    }

    // Search for Booking
    public function bookingSearch(Request $request)
    {
        $query = $request->input('query');
        $bookings = Booking::where(function($queryBuilder) use ($query) {
            $queryBuilder
                ->where('reference_number', 'like', "%$query%")
                ->orWhere('status', 'like', "%$query%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('admin.bookings.booking', compact('bookings', 'query'));
    }

    // Search for Payment
    public function paymentSearch(Request $request)
    {
        $query = $request->input('query');
        $payments = Payment::where(function($queryBuilder) use ($query) {
            $queryBuilder
                ->where('payment_status', 'like', "%$query%")
                ->orWhere('payment_method', 'like', "%$query%")
                ->orWhere('paymongo_id', 'like', "%$query%")
                ->orWhere('payment_date', 'like', "%$query%")
                ->orWhere('payment_amount', 'like', "%$query%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);


        return view('admin.records.payment', compact('payments', 'query'));
    }

    // Search for Passenger
    public function passengerSearch(Request $request)
    {
        $query = $request->input('query');
        $passengers = Passenger::join('bookings', 'passengers.booking_id', '=', 'bookings.id')
        ->where(function ($queryBuilder) use ($query) {
            $queryBuilder
                ->where('passengers.first_name', 'like', "%$query%")
                ->orWhere('passengers.middle_name', 'like', "%$query%")
                ->orWhere('passengers.last_name', 'like', "%$query%")
                ->orWhere('passengers.gender', 'like', "%$query%")
                ->orWhere('passengers.accommodation', 'like', "%$query%")
                ->orWhere('bookings.reference_number', 'like', "%$query%");
        })
        ->orderBy('passengers.created_at', 'desc')
        ->paginate(10);

        return view('admin.records.passenger', compact('passengers', 'query'));
    }

    // Search for Contact
    public function contactSearch(Request $request)
    {
        $query = $request->input('query');
        $contacts = ContactPerson::where(function($queryBuilder) use ($query) {
            $queryBuilder
                ->where('name', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%")
                ->orWhere('phone', 'like', "%$query%")
                ->orWhere('address', 'like', "%$query%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);


        return view('admin.records.contact', compact('contacts', 'query'));
    }
}