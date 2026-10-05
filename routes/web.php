<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ContinentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\EmisivoBookingController;
use App\Http\Controllers\ReceptivoBookingController;
use App\Http\Controllers\CustomerController;

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

// Resourceful CRUD for continents
Route::resource('continents', ContinentController::class);

// Resourceful CRUD for countries
Route::resource('countries', CountryController::class);
Route::get('/countries/list', [CountryController::class, 'list']);

// Resourceful CRUD for cities
Route::resource('cities', CityController::class);
Route::get('/cities/by-country/{id}', [CityController::class, 'getByCountry']);

//Resourceful CRUD for airports
Route::resource('airports', AirportController::class);
Route::get('/airports/by-city/{cityId}', [AirportController::class, 'getAirportsByCity']);

//Resourceful CRUD for airlines
Route::resource('airlines', AirlineController::class);
Route::get('/airlines/by-country/{country}', [AirlineController::class, 'getByCountry']);

//Resourceful CRUD for customers
Route::resource('customers', CustomerController::class);


Route::post('/bookings/{booking}/assign-customer', [ReceptivoBookingController::class, 'assignCustomer'])
    ->name('bookings.assign-customer');

Route::delete('/bookings/{booking}/remove-customer/{customer}', [ReceptivoBookingController::class, 'removeCustomer'])
    ->name('bookings.remove-customer');


    
//Resourceful CRUD for Emisivo Booking
Route::resource('emisivo-bookings', EmisivoBookingController::class);
//Resourceful CRUD for Receptivo Booking
Route::resource('receptivo-bookings', ReceptivoBookingController::class);



// Temporary logout placeholder (since we skipped auth)
Route::get('/logout', function () {
    return redirect('/home');
})->name('logout');
