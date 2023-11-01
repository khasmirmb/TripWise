<?php

namespace App\Http\Controllers;

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
        $clients = User::where('type', 0)->get();
        return view('admin.users.client', compact('clients'));
    }

    /**
     * Display the list of users staff.
     */
    public function staffIndex()
    {
        $staffs = User::where('type', 2)->get();
        return view('admin.users.staff', compact('staffs'));
    }

        /**
     * Display the list of users admin.
     */
    public function adminIndex()
    {
        $admins = User::where('type', 1)->get();
        return view('admin.users.admin', compact('admins'));
    }


}
