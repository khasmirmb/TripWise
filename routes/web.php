<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminFerryController;
use App\Http\Controllers\AdminPortController;
use App\Http\Controllers\AdminScheduleController;
use App\Http\Controllers\AdminSearchController;
use App\Http\Controllers\AdminSeatController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FerriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethod;
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
    // Process the payment whether otc or online payment
    Route::post('/booking/process', [PaymentController::class, 'paymentProcess'])->name('booking.payment.process');

    // Webhook for payment (Require Deployment)
    Route::post('/webhook/paymongo', [PaymentMethod::class, 'handleWebhook'])->name('booking.webhook');

    // Process the payment if its sucess
    Route::get('/booking/success', [PaymentMethod::class, 'paymentSuccess'])->name('booking.success');

    // Online Pamyent succeed for seating
    Route::get('/booking/online', [PaymentMethod::class, 'OnlinePaymentBooking'])->name('booking.online');

    // routes/web.php
    Route::get('/update-seat', [PassengerController::class, 'updateSeat']);

    // Over the Counter Pamyent
    Route::get('/booking/otc', [PaymentMethod::class, 'OTCBooking'])->name('booking.otc');

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

// Staff Side Routes
Route::middleware(['auth', 'user-access:staff'])->group(function () {
  
    Route::get('/staff', [HomeController::class, 'staffHome'])->name('staff.home');
});

// Admin Side Routes
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    // Admin Home / Overview
    Route::get('/admin', [HomeController::class, 'adminHome'])->name('admin.home');

    // Admin Users
    // Client List
    Route::get('/admin/users/client', [AdminController::class, 'clientIndex'])->name('admin.client');
    // Search Client
    Route::get('/admin/users/client/search', [AdminSearchController::class, 'clientSearch'])->name('admin.client.search');

    // Staff List
    Route::get('/admin/users/staff', [AdminController::class, 'staffIndex'])->name('admin.staff');
    // Search Staff
    Route::get('/admin/users/staff/search', [AdminSearchController::class, 'staffSearch'])->name('admin.staff.search');

    // Admin List
    Route::get('/admin/users/admin', [AdminController::class, 'adminIndex'])->name('admin.admin');
    // Search Staff
    Route::get('/admin/users/admin/search', [AdminSearchController::class, 'adminSearch'])->name('admin.admin.search');

    // User CRUD
    // Add User Form
    Route::get('/admin/users/add', [AdminUserController::class, 'addUserForm'])->name('admin.user.add');
    // Add User Process
    Route::post('/admin/users/add/process', [AdminUserController::class, 'createUser'])->name('admin.user.add-process');
    // Edit User Form
    Route::get('/admin/users/edit/{user}', [AdminUserController::class, 'editUserForm'])->name('admin.user.edit');
    // Update User Process
    Route::post('/admin/users/edit/process/{user}/{type}', [AdminUserController::class, 'updateUser'])->name('admin.user.edit-process');
    // Delete User Process
    Route::delete('/admin/users/delete/{user}', [AdminUserController::class, 'deleteUser'])->name('admin.user.delete');

    // Admin Ferries
    Route::get('/admin/ferries', [AdminController::class, 'ferryIndex'])->name('admin.ferry');
    // Search Ferry
    Route::get('/admin/ferries/search', [AdminSearchController::class, 'ferrySearch'])->name('admin.ferry.search');
    // CRUD for Ferry
    // Add Ferry Form
    Route::get('/admin/ferries/add', [AdminFerryController::class, 'addFerryForm'])->name('admin.ferry.add');
    // Create Process
    Route::post('/admin/ferries/add/process', [AdminFerryController::class, 'createFerry'])->name('admin.ferry.add-process');
    // Edit Ferry Form
    Route::get('/admin/ferries/edit/{ferry}', [AdminFerryController::class, 'editFerryForm'])->name('admin.ferry.edit');
    // Edit Process
    Route::post('/admin/ferries/edit/process/{ferry}', [AdminFerryController::class, 'updateFerry'])->name('admin.ferry.edit-process');
    // Delete Ferry
    Route::delete('/admin/ferries/delete/{ferry}', [AdminFerryController::class, 'deleteFerry'])->name('admin.ferry.delete');

    // CRUD for Fare
    // Create Process
    Route::post('/admin/ferries/add-fare', [AdminFerryController::class, 'addFare'])->name('ferry.addfare');
    // Update Process
    Route::post('/admin/ferries/edit-fare', [AdminFerryController::class, 'fareEdit'])->name('ferry.editfare');
    // Delete Process
    Route::delete('/admin/ferries/fares/{id}', [AdminFerryController::class, 'fareDelete'])->name('ferry.deletefare');

    // Admin Ports
    Route::get('/admin/ports', [AdminController::class, 'portIndex'])->name('admin.port');
    // Search Port
    Route::get('/admin/ports/search', [AdminSearchController::class, 'portSearch'])->name('admin.port.search');
    // CRUD for Port
    // Create Process
    Route::post('/admin/ports/add-port', [AdminPortController::class, 'addPort'])->name('admin.port.addport');
    // Edit Process
    Route::post('/admin/ports/edit-port', [AdminPortController::class, 'editPort'])->name('admin.port.editport');
    // Delete Port
    Route::delete('/admin/port/delete/{port}', [AdminPortController::class, 'deleteport'])->name('admin.port.delete');

    // Admin Schedules
    Route::get('/admin/schedules', [AdminController::class, 'scheduleIndex'])->name('admin.schedule');
    // Search Schedule
    Route::get('/admin/schedules/search', [AdminSearchController::class, 'scheduleSearch'])->name('admin.schedule.search');
    // CRUD for Schedule
    // Add Form Schedule
    Route::get('/admin/schedules/add', [AdminScheduleController::class, 'addScheduleForm'])->name('admin.schedule.add');
    // Add Form Schedule - Get Ferry Info
    Route::get('/admin/schedules/ferry-info', [AdminScheduleController::class, 'ferryInfo'])->name('admin.schedule.ferry-info');
    // Add Process Schedule
    Route::post('/admin/schedules/add/process', [AdminScheduleController::class, 'createSchedule'])->name('admin.schedule.add-process');

    // Admin Schedule Seats
    Route::get('/admin/schedules/{schedule}/seats', [AdminSeatController::class, 'seatList'])->name('admin.schedule.seats');
    // Search Schedule
    Route::get('/admin/schedules/{schedule}/seats/search', [AdminSearchController::class, 'seatSearch'])->name('admin.schedule.seats.search');
    // Schedule Seats CRUD
    // Admin Schedule Delete All
    Route::get('/admin/schedules/{schedule}/seats/delete-all', [AdminSeatController::class, 'seatDeleteAll'])->name('admin.schedule.seats-deleteall');
    // Schedule Seats Add Form
    Route::get('/admin/schedules/{schedule}/seats/add', [AdminSeatController::class, 'seatAddForm'])->name('admin.schedule.seats.add');
    // Schedule Seats Add Bulk Process
    Route::post('/admin/schedules/{schedule}/seats/add/bulk', [AdminSeatController::class, 'createSeats'])->name('admin.schedule.seats.addbulk-process');
    // Schedule Seats Delete
    Route::delete('/admin/schedules/seats/delete/{seat}', [AdminSeatController::class, 'deleteSeat'])->name('admin.schedule.seats.delete');
    Route::get('/admin/schedules/seats/edit/{seat}', [AdminSeatController::class, 'editSeat'])->name('admin.schedule.seats.edit');
    
});