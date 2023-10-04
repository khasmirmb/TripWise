<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PortsController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

// Authentication
Route::get('/register', [UserController::class, 'register']);

Route::post('/login', [UserController::class, 'login']);

Route::get('/logout', [UserController::class, 'logout']);

Route::post('/store', [UserController::class, 'store']);

Route::get('/booking', [BookingController::class, 'index'])->middleware('auth');

