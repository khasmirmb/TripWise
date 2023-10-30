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
    public function GenerateDepart(Request $request)
    {
        // Check for the presence of necessary data
        if (!$request->input('paymentId') || !$request->input('contactPersonId') || !$request->input('departBookId')) {
            return view('partials.404');
        }

        // Retrieve the data from the request's query parameters
        $paymentId = $request->input('paymentId');
        $contactPersonId = $request->input('contactPersonId');
        $departBookId = $request->input('departBookId');

        $payment = Payment::find($paymentId);

        $contactPerson = ContactPerson::find($contactPersonId);

        $departBooking = Booking::find($departBookId);
        $departPassengers = Passenger::where('booking_id', $departBookId)->get();
        
        $depSchedData = Booking::join('schedules', 'bookings.schedule_id', '=', 'schedules.id')
        ->join('ferries', 'schedules.ferry_id', '=', 'ferries.id')
        ->select('bookings.*', 'schedules.*', 'ferries.*')
        ->where('bookings.id', $departBookId)
        ->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($departBooking->reference_number));

        $data = [
            'title' => 'TripWise',
            'qrcode' => $qrcode
        ];

        $pdf = Pdf::loadView('components.depart-pdf', compact(
            'data',
            'payment',
            'contactPerson',
            'departBooking',
            'depSchedData',
            'departPassengers'
        ));
        return $pdf->download('E-Ticket Departure.pdf');
    }

    public function GenerateReturn(Request $request)
    {
        // Check for the presence of necessary data
        if (!$request->input('paymentId') || !$request->input('contactPersonId') || !$request->input('returnBookId')) {
            return view('partials.404');
        }
        
        // Retrieve the data from the request's query parameters
        $paymentId = $request->input('paymentId');
        $contactPersonId = $request->input('contactPersonId');
        $returnBookId = $request->input('returnBookId');

        $payment = Payment::find($paymentId);

        $contactPerson = ContactPerson::find($contactPersonId);

        $returnBooking = Booking::find($returnBookId);
        $returnPassengers = Passenger::where('booking_id', $returnBookId)->get();

        $retSchedData = Booking::join('schedules', 'bookings.schedule_id', '=', 'schedules.id')
        ->join('ferries', 'schedules.ferry_id', '=', 'ferries.id')
        ->select('bookings.*', 'schedules.*', 'ferries.*')
        ->where('bookings.id', $returnBookId)
        ->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($returnBooking->reference_number));

        $data = [
            'title' => 'TripWise',
            'qrcode' => $qrcode
        ];

        $pdf = Pdf::loadView('components.return-pdf', compact(
            'data',
            'payment',
            'contactPerson',
            'returnBooking',
            'retSchedData',
            'returnPassengers'
        ));
        return $pdf->download('E-Ticket Returning.pdf');
    }
}