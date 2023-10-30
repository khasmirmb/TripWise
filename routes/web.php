<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\FerriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PortsController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\SeatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Common Routes Usage and Meaning
// index - Show all the data
// show - Show a single data
// create - Show a form to create the data
// store - Store the data
// edit - Show a form to edit the data
// update - Update the data
// destory - Delete the data

Auth::routes();

Route::get('/', function () {
    return view('home');
});


// Home Routes
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Fallback Errors Route
//Route::fallback(function () {
//  return view('partials.404');
//});

// Non-Login Routes
Route::group(['middleware' => ['guest']], function() {



});

// User Side Routes
Route::middleware(['auth', 'user-access:user'])->group(function () {

    // Show the schedule search
    Route::get('/booking/search', [BookingController::class, 'index'])->name('booking.search.show');

    // Show the list of schedule
    Route::post('/booking/schedule', [SchedulesController::class, 'search'])->name('booking.schedule.show');

    // Show a form for passenger and contact person
    Route::match(['get', 'post'], '/booking/passenger', [PassengerController::class, 'input'])->name('booking.passenger.show');

    // Show the payment summary and trip summary
    Route::match(['get', 'post'], '/booking/payment', [PaymentController::class, 'payment'])->name('booking.payment.show');

    Route::post('/booking/process', [PaymentController::class, 'paymentProcess'])->name('booking.payment.process');

    Route::get('/booking/success', [PaymentController::class, 'paymentSuccess'])->name('booking.success');

    // Online Pamyent
    Route::get('/booking/online', [PaymentController::class, 'OnlinePaymentBooking'])->name('booking.online');

    // Over the Counter Pamyent
    Route::get('/booking/otc', [PaymentController::class, 'OTCBooking'])->name('booking.otc');

    // Generate PDF
    Route::get('/depart-generate-pdf', [PdfController::class, 'GenerateDepart'])->name('depart.generate.pdf');
    Route::get('/return-generate-pdf', [PdfController::class, 'GenerateReturn'])->name('return.generate.pdf');

    // Get schedule information from DB
    Route::get('/get-schedule', [SchedulesController::class, 'getSchedule']);

    // Get Trip information and store in a session
    Route::get('/store-one-info', [PassengerController::class, 'storeOneInfo']);

    // Get Trip information and store in a session
    Route::get('/store-round-info', [PassengerController::class, 'storeRoundInfo']);

    // Get ferry information from DB
    Route::get('/get-ferry-info', [FerriesController::class, 'getFerryInfo']);

    // Check availability of schedule if full or not
    Route::get('/depart-check-seat-availability', [SeatController::class, 'DepartCheckAvailability']);

    Route::get('/return-check-seat-availability', [SeatController::class, 'ReturnCheckAvailability']);
    
});

// Admin Side Routes
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin', [HomeController::class, 'adminHome'])->name('admin.home');

});