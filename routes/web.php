<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FerriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\PortsController;
use App\Http\Controllers\SchedulesController;
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


// Home Routes
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Fallback Errors Route
Route::fallback(function () {
    return view('partials.404');
});

// Non-Login Routes
Route::group(['middleware' => ['guest']], function() {

    

});

// User Side Routes
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/booking/search', [BookingController::class, 'index'])->name('booking.search.show');

    Route::post('/booking/schedule', [SchedulesController::class, 'search'])->name('booking.schedule.show');

    Route::post('/booking/passenger', [PassengerController::class, 'input'])->name('booking.passenger.show');

    Route::get('/get-schedule', [SchedulesController::class, 'getSchedule']);

    Route::get('/get-ferry-info', [FerriesController::class, 'getFerryInfo']);
    
});

// Admin Side Routes
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin', [HomeController::class, 'adminHome'])->name('admin.home');

});