<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ferries;
use App\Models\Payment;
use App\Models\Ports;
use App\Models\Schedules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        // Fetch monthly payment data
        $monthlyData = Payment::where('payment_status', 'Paid')
            ->whereYear('payment_date', now()->year)
            ->groupBy(DB::raw('MONTH(payment_date)'))
            ->orderBy(DB::raw('MONTH(payment_date)'))
            ->selectRaw('SUM(payment_amount) as total, MONTH(payment_date) as month')
            ->pluck('total', 'month')
            ->toArray();

        // Fill in missing months with zero sales
        $monthlySales = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlySales[$i] = $monthlyData[$i] ?? 0;
        }

        // Count bookings for each month
        $monthlyBookings = Booking::whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->selectRaw('COUNT(*) as total, MONTH(created_at) as month')
            ->pluck('total', 'month')
            ->toArray();

        // Fill in missing months with zero bookings
        $bookingsByMonth = [];
        for ($i = 1; $i <= 12; $i++) {
            $bookingsByMonth[$i] = $monthlyBookings[$i] ?? 0;
        }

        // Count schedules for each month
        $monthlySchedules = Schedules::whereYear('departure_date', now()->year)
            ->groupBy(DB::raw('MONTH(departure_date)'))
            ->orderBy(DB::raw('MONTH(departure_date)'))
            ->selectRaw('COUNT(*) as total, MONTH(departure_date) as month')
            ->pluck('total', 'month')
            ->toArray();

        // Fill in missing months with zero schedules
        $schedulesByMonth = [];
        for ($i = 1; $i <= 12; $i++) {
            $schedulesByMonth[$i] = $monthlySchedules[$i] ?? 0;
        }

        $statusDistribution = Booking::groupBy('status')
        ->selectRaw('COUNT(*) as count, status')
        ->get()
        ->pluck('count', 'status')
        ->toArray();

        $bookingCount = Booking::count();

        $scheduleCount = Schedules::count();

        $ferriesCount = Ferries::count();

        $portCount = Ports::count();

        return view('admin.index', compact('monthlySales', 'statusDistribution', 'schedulesByMonth','bookingsByMonth', 'bookingCount', 'scheduleCount', 'ferriesCount', 'portCount'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function staffHome()
    {
        return view('staff.index');
    }

}
