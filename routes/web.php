<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\FlightController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

// Resourceful CRUD for bookings
Route::resource('bookings', BookingController::class);

// Resourceful CRUD for agencies
Route::resource('agencies', AgencyController::class);

// Resourceful CRUD for vouchers
Route::resource('vouchers', VoucherController::class);

// Resourceful CRUD for hotels
Route::resource('hotels', HotelController::class);

// Resourceful CRUD for flights
Route::resource('flights', FlightController::class);


// Temporary logout placeholder (since we skipped auth)
Route::get('/logout', function () {
    return redirect('/home');
})->name('logout');
