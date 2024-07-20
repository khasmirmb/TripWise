<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Schedules;

// Require Deployment
class TripNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $contactPerson;
    public $schedule;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $contactPerson
     * @param  \App\Models\Schedules  $schedule
     * @return void
     */
    public function __construct(User $contactPerson, Schedules $schedule)
    {
        $this->contactPerson = $contactPerson;
        $this->schedule = $schedule;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Voyage Notification')->view('components.send-notification');
    }
}
