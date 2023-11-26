<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\City;
use App\Models\Fee;
use App\Models\Ferries;
use App\Models\Ports;
use App\Models\Schedules;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display the list of users staff.
     */
    public function staffIndex()
    {
        $staffs = User::where('type', 0)->orderBy('id', 'desc')->paginate(10);
        return view('admin.users.staff', compact('staffs'));
    }

    /**
     * Display the list of users admin.
     */
    public function adminIndex()
    {
        $admins = User::where('type', 1)->orderBy('id', 'desc')->paginate(10);
        return view('admin.users.admin', compact('admins'));
    }

    /**
     * Display the list of ferries.
     */
    public function ferryIndex()
    {
        $ferries = Ferries::with('fares')->orderBy('id', 'desc')->paginate(10);
        
        return view('admin.ferries.ferry', compact('ferries'));
    }

    /**
     * Display the list of ports.
    */
    public function portIndex()
    {
        $ports = Ports::orderBy('name', 'asc')->paginate(10);

        $cities = City::orderBy('city', 'asc')->get();
        
        return view('admin.ports.port', compact('ports', 'cities'));
    }

    /**
     * Display the list of schedules.
    */
    public function scheduleIndex()
    {
        
        $schedules = Schedules::orderBy('departure_date')->paginate(10);
        
        return view('admin.schedules.schedule', compact('schedules'));
    }

    /**
     * Display the list of bookings.
    */
    public function bookingIndex()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.bookings.booking', compact('bookings'));
    }

    /**
     * Display the list of bookings.
    */
    public function settingIndex()
    {
        $fee = Fee::firstOrNew();

        return view('admin.settings.setting', compact('fee'));
    }


}