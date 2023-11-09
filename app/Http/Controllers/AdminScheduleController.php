<?php

namespace App\Http\Controllers;

use App\Models\Ferries;
use App\Models\Ports;
use Illuminate\Http\Request;

class AdminScheduleController extends Controller
{
    // Add Schedule Form
    public function addScheduleForm()
    {
        $ports = Ports::all();
        $ferries = Ferries::all();

        return view('admin.schedules.crud.add-schedule', ['ports' => $ports , 'ferries' => $ferries]);
    }
}
