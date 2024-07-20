<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ContactPerson;
use App\Models\Passenger;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfController extends Controller
{
    public function GeneratePDF(Request $request)
    {
        // Check for the presence of necessary data
        if (!$request->input('payment') || !$request->input('contact') || !$request->input('booking')) {
            return view('partials.404');
        }
        
        // Retrieve the data from the request's query parameters
        $payment_id = $request->input('payment');
        $contact_id = $request->input('contact');
        $booking_id = $request->input('booking');

        $payment = Payment::find($payment_id);

        $contactPerson = ContactPerson::find($contact_id);

        $booking = Booking::find($booking_id);
        $passengers = Passenger::where('booking_id', $booking_id)->get();

        $schedule = Booking::join('schedules', 'bookings.schedule_id', '=', 'schedules.id')
        ->join('ferries', 'schedules.ferry_id', '=', 'ferries.id')
        ->select('bookings.*', 'schedules.*', 'ferries.*')
        ->where('bookings.id', $booking_id)
        ->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($booking->reference_number));

        $data = [
            'title' => 'TripWise',
            'qrcode' => $qrcode
        ];

        $pdf = Pdf::loadView('components.generate-pdf', compact(
            'data',
            'payment',
            'contactPerson',
            'booking',
            'schedule',
            'passengers'
        ));
        return $pdf->download('TripWise E-Ticket.pdf');
    }
}