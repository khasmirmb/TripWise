<?php

namespace App\Http\Controllers;

use App\Models\Ferries;
use App\Models\Ports;
use App\Models\Schedules;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminSearchController extends Controller
{
    // Search for User Client
    public function clientSearch(Request $request)
    {
        $query = $request->input('query');
        $clients = User::where(function($queryBuilder) use ($query) {
            $queryBuilder
                ->where('firstname', 'like', "%$query%")
                ->orWhere('lastname', 'like', "%$query%")
                ->orWhere('phone_number', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%");
        })
        ->where('type', 0)
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('admin.users.client', compact('clients', 'query'));
    }

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
        ->orderBy('id', 'desc')
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
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('admin.users.admin', compact('admins', 'query'));
    }

    // Search for Ferries
    public function ferrySearch(Request $request)
    {
        $query = $request->input('query');
        $ferries = Ferries::where('name', 'like', "%$query%")
            ->orWhere('capacity', 'like', "%$query%")
            ->orderBy('id', 'desc')
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
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('admin.ports.port', compact('ports', 'query'));
    }
    
    // Search for Schedule
    public function scheduleSearch(Request $request)
    {
        $query = $request->input('query');
        $schedules = Schedules::query();

        // Check if the input is a specific date or month
        if (strtotime($query) !== false) {
            $date = Carbon::parse($query);
            $formattedMonth = $date->format('m');

            // Handle specific month format (e.g., November or Nov)
            $schedules->orWhereRaw("MONTH(departure_date) = ?", [$formattedMonth]);
        } else {
            // If it's not a date, assume it's a vessel name or departure port
            // Search in the related ferry's name
            $schedules->whereHas('ferries', function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', "%$query%");
            });

            // Search in the departure port
            $schedules->orWhere('departure_port', 'like', "%$query%");
        }

        $schedules = $schedules->orderBy('id', 'desc')
        ->paginate(10);

        return view('admin.schedules.schedule', compact('schedules', 'query'));
    }
}