<?php

namespace App\Http\Controllers;

use App\Models\Ferries;
use App\Models\Ports;
use App\Models\Schedules;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    /**
     * Display the list of users client.
     */
    public function clientIndex()
    {
        $clients = User::where('type', 0)->paginate(10);
        return view('admin.users.client', compact('clients'));
    }

    /**
     * Display the list of users staff.
     */
    public function staffIndex()
    {
        $staffs = User::where('type', 2)->paginate(10);
        return view('admin.users.staff', compact('staffs'));
    }

    /**
     * Display the list of users admin.
     */
    public function adminIndex()
    {
        $admins = User::where('type', 1)->paginate(10);
        return view('admin.users.admin', compact('admins'));
    }

    /**
     * Display the list of ferries.
     */
    public function ferryIndex()
    {
        $ferries = Ferries::with('fares')->paginate(10);
        
        return view('admin.ferries.ferry', compact('ferries'));
    }

    /**
     * Display the list of ports.
    */
    public function portIndex()
    {
        $ports = Ports::paginate(10);
        
        return view('admin.ports.port', compact('ports'));
    }

    /**
     * Display the list of schedules.
    */
    public function scheduleIndex()
    {
        $schedules = Schedules::paginate(10);
        
        return view('admin.schedules.schedule', compact('schedules'));
    }


}
