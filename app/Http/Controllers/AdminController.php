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
        return view('admin.users.staff');
    }

        /**
     * Display the list of users admin.
     */
    public function adminIndex()
    {
        return view('admin.users.admin');
    }


}
