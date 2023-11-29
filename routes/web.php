<?php

use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminFerryController;
use App\Http\Controllers\AdminPortController;
use App\Http\Controllers\AdminScheduleController;
use App\Http\Controllers\AdminSearchController;
use App\Http\Controllers\AdminSeatController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FerriesController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethod;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PortsController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\UserController;
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


// Fallback Errors Route
Route::fallback(function () {
  return view('partials.404');
});


// User Side Routes
Route::group(['middleware' => ['guest']], function() {

    // Home Routes
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Contact Us
    Route::get('/contact', [GuestController::class, 'contactusIndex'])->name('contact');
    // Send Message
    Route::post('/contact/send', [GuestController::class, 'messageSubmit'])->name('send.message');

    // Booking Start
    // Searching Schedule
    // Show the schedule search
    Route::get('/booking/search', [BookingController::class, 'index'])->name('booking.search.show');

    // Schedule
    // Show the list of schedule
    Route::post('/booking/schedule', [SchedulesController::class, 'search'])->name('booking.schedule.show');

    // Passenger Information
    // Show a form for passenger and contact person
    Route::match(['get', 'post'], '/booking/passenger', [PassengerController::class, 'input'])->name('booking.passenger.show');

    // Payment
    // Show the payment summary and trip summary
    Route::match(['get', 'post'], '/booking/payment', [PaymentController::class, 'payment'])->name('booking.payment.show');
    // Process the payment whether otc or online payment
    Route::post('/booking/process', [PaymentController::class, 'paymentProcess'])->name('booking.payment.process');

    // Webhook for payment (Require Deployment)
    Route::post('/webhook/paymongo', [PaymentMethod::class, 'handleWebhook'])->name('booking.webhook');

    // Completed
    // Over the Counter Pamyent
    Route::get('/booking/otc', [PaymentMethod::class, 'OTCBooking'])->name('booking.otc');
    // Process the payment if its sucess
    Route::get('/booking/success', [PaymentMethod::class, 'paymentSuccess'])->name('booking.success');
    // Online Pamyent succeed for seating
    Route::get('/booking/online', [PaymentMethod::class, 'OnlinePaymentBooking'])->name('booking.online');
    // Updating Seat when User Select
    Route::get('/update-seat', [PassengerController::class, 'updateSeat']);

    
    // Generate PDF
    Route::get('/generate-pdf', [PdfController::class, 'GeneratePDF'])->name('generate.pdf');

    // AJAX
    // Get schedule information from DB
    Route::get('/get-schedule', [SchedulesController::class, 'getSchedule']);
    // Get Trip information and store in a session
    Route::get('/store-one-info', [PassengerController::class, 'storeOneInfo']);
    // Get Trip information and store in a session
    Route::get('/store-round-info', [PassengerController::class, 'storeRoundInfo']);
    // Get ferry information from DB
    Route::get('/get-ferry-info', [FerriesController::class, 'getFerryInfo']);
    // AJAX
    // Check availability of schedule if full or not
    // Depart Seat Check
    Route::get('/depart-check-seat-availability', [SeatController::class, 'DepartCheckAvailability']);
    // Return Seat Check
    Route::get('/return-check-seat-availability', [SeatController::class, 'ReturnCheckAvailability']);

    // Booking End

    // Manage Booking Start
    // Manage Booking Page
    Route::get('/booking/manage', [BookingController::class, 'manageBooking'])->name('booking.manage.show');
    // Find Booking
    Route::post('/booking/manage/find', [BookingController::class, 'findBooking'])->name('booking.manage.find');
    // Booking Seats
    Route::get('/booking/manage/seat/{booking}/{reference}', [BookingController::class, 'bookingSeat'])->name('booking.seats');
    // Booking Rebook
    Route::get('/booking/manage/rebook/{booking}/{reference}/{schedule}', [BookingController::class, 'bookingRebook'])->name('booking.rebook');
    // Booking Payment
    Route::get('/booking/manage/rebook/payment/{booking}/{reference}/{schedule}', [BookingController::class, 'processBooking'])->name('booking.rebook.payment');
    // Payment Process
    Route::post('/booking/manage/rebook/payment/process/{booking}/{schedule}/', [BookingController::class, 'processPayment'])->name('booking.rebook.payment-process');
    // Rebooking Success
    Route::get('/booking/manage/success', [BookingController::class, 'rebookSuccess'])->name('booking.rebook.success');
    // Manage Booking End
    
});

// Staff Side Routes
Route::middleware(['auth', 'user-access:staff'])->group(function () {
  
    // Staff Home
    Route::get('/staff', [HomeController::class, 'staffHome'])->name('staff.home');

    // Scan QR
    Route::get('/staff/scan-qr', [UserController::class, 'QRScanStaff'])->name('staff.scan.qr');
    // Passenger List
    Route::post('/staff/scan-qr/check-booking', [UserController::class, 'staffcheckBooking'])->name('staff.check.booking');

});

// Admin Side Routes
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    // Admin Home / Overview
    Route::get('/admin', [HomeController::class, 'adminHome'])->name('admin.home');

    // Admin Users
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
    // Filter Schedule
    Route::get('/admin/schedules/filter', [AdminSearchController::class, 'scheduleFilter'])->name('admin.schedule.filter');
    
    // CRUD for Schedule
    // Add Form Schedule
    Route::get('/admin/schedules/add', [AdminScheduleController::class, 'addScheduleForm'])->name('admin.schedule.add');
    // Add Form Schedule - Get Ferry Info
    Route::get('/admin/schedules/ferry-info', [AdminScheduleController::class, 'ferryInfo'])->name('admin.schedule.ferry-info');
    // Add Process Schedule
    Route::post('/admin/schedules/add/process', [AdminScheduleController::class, 'createSchedule'])->name('admin.schedule.add-process');
    // Edit Form Schedule
    Route::get('/admin/schedules/edit/{schedule}', [AdminScheduleController::class, 'editScheduleForm'])->name('admin.schedule.edit');
    // Add Process Schedule
    Route::post('/admin/schedules/edit/{schedule}/process', [AdminScheduleController::class, 'updateSchedule'])->name('admin.schedule.edit-process');
    // Delete Schedule
    Route::delete('/admin/schedules/delete/{schedule}', [AdminScheduleController::class, 'deleteSchedule'])->name('admin.schedule.delete');

    // Admin Schedule Seats
    Route::get('/admin/schedules/{schedule}/seats', [AdminSeatController::class, 'seatList'])->name('admin.schedule.seats');
    // Search Schedule Seats
    Route::get('/admin/schedules/{schedule}/seats/search', [AdminSearchController::class, 'seatSearch'])->name('admin.schedule.seats.search');
    // Schedule Seats CRUD
    // Admin Schedule Delete All
    Route::get('/admin/schedules/{schedule}/seats/delete-all', [AdminSeatController::class, 'seatDeleteAll'])->name('admin.schedule.seats-deleteall');
    // Schedule Seats Add All
    Route::get('/admin/schedules/{schedule}/seats/add', [AdminSeatController::class, 'createAllSeats'])->name('admin.schedule.seats.add-process');
    // Schedule Seats Edit
    Route::get('/admin/schedules/seats/edit/{seat}', [AdminSeatController::class, 'editSeat'])->name('admin.schedule.seats.edit');

    // Admin Booking
    Route::get('/admin/bookings', [AdminController::class, 'bookingIndex'])->name('admin.booking');
    // Search Booking
    Route::get('/admin/bookings/search', [AdminSearchController::class, 'bookingSearch'])->name('admin.booking.search');
    // Generate PDF
    Route::get('admin/booking/generate-pdf', [PdfController::class, 'GeneratePDF'])->name('admin.generate.pdf');

    // CRUD for Booking
    // Edit Form
    Route::get('/admin/bookings/edit/{booking}', [AdminBookingController::class, 'editBookingForm'])->name('admin.booking.edit');
    // Edit Process Booking
    Route::post('/admin/booking/edit/process/{booking}', [AdminBookingController::class, 'updateBooking'])->name('admin.booking.edit-process');
    // Change Seat for Passenger
    Route::post('/admin/booking/passenger/seat/{booking}/{passenger}', [AdminBookingController::class, 'changeSeat'])->name('admin.change.seat');

    // Admin Scan QR
    Route::get('/admin/scan-qr', [UserController::class, 'QRScanAdmin'])->name('admin.scan.qr');
    // Checked Passenger List
    Route::post('/admin/scan-qr/check-booking', [UserController::class, 'admincheckBooking'])->name('admin.check.booking');


    // Admin Settings
    Route::get('/admin/settings', [AdminController::class, 'settingIndex'])->name('admin.settings');
    // Change Logo
    Route::post('/admin/update/logo', [UserController::class, 'logoUpdate'])->name('admin.update.logo');
    // Change Logo
    Route::post('/admin/update/fee', [UserController::class, 'updateRebookingFee'])->name('admin.update.fee');


    // Records
    // Payments
    Route::get('/admin/records/payment', [AdminController::class, 'paymentIndex'])->name('admin.record.payment');
    // Search Payment
    Route::get('/admin/records/payment/search', [AdminSearchController::class, 'paymentSearch'])->name('admin.payment.search');

    // Passenger
    Route::get('/admin/records/passenger', [AdminController::class, 'passengerIndex'])->name('admin.record.passenger');
    // Search Passenger
    Route::get('/admin/records/passenger/search', [AdminSearchController::class, 'passengerSearch'])->name('admin.passenger.search');

    // Contact Info
    Route::get('/admin/records/contact', [AdminController::class, 'contactIndex'])->name('admin.record.contact');
    // Search Contact
    Route::get('/admin/records/contact/search', [AdminSearchController::class, 'contactSearch'])->name('admin.contact.search');

    // Messages
    Route::get('/admin/messages', [AdminController::class, 'messageIndex'])->name('admin.message');
    // AJAX Read Message
    Route::post('/admin/messages/{message}/read', [UserController::class, 'markAsRead']);
    // Delete Message
    Route::delete('/admin/messages/delete/{message}', [UserController::class, 'deleteMessage'])->name('admin.message.delete');
    
});