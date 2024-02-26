<?php

namespace App\Console\Commands;

use App\Models\Booking;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

// Requires a deployment
// Notify Users if there's a trip 3 hours before the departure.
class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to users 3 hours before their voyage.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get booking
        $bookings = Booking::where('status', 'Paid')->get();

        foreach ($bookings as $booking) {
            $schedule = $booking->schedule;
            $departureDateTime = Carbon::parse($schedule->departure_date . ' ' . $schedule->departure_time);
            $notificationTime = $departureDateTime->subHours(3);

            if (Carbon::now()->gte($notificationTime)) {
                // Send notification email to the user
                $user = $booking->contactPerson;
                $this->sendNotification($user, $schedule);
            }
        }
    }

    private function sendNotification($user, $schedule)
    {
        // Send Email to the user
        Mail::to($user->email)->send(new \App\Mail\TripNotification($user, $schedule));
    }
}
