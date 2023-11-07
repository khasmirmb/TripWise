<?php

namespace App\Http\Controllers;

use App\Models\Ferries;
use App\Models\Ports;
use App\Models\User;
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
        ->paginate(10);

        return view('admin.users.client', compact('clients'));
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
        ->paginate(10);

        return view('admin.users.staff', compact('staffs'));
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

        return view('admin.users.admin', compact('admins'));
    }

    // Search for Ferries
    public function ferrySearch(Request $request)
    {
        $query = $request->input('query');
        $ferries = Ferries::where('name', 'like', "%$query%")
            ->paginate(10);

        return view('admin.ferries.ferry', compact('ferries'));
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
        ->paginate(10);

        return view('admin.ports.port', compact('ports'));
    }
}