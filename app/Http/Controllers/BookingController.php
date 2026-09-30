<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Continent;
use App\Models\Country;
use App\Models\City;
use App\Models\Agency;
use App\Models\Voucher;
use App\Models\Hotel;
use App\Models\Flight;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $continents = Continent::all();
        $countries  = Country::all();
        $cities     = City::all();
        $agencies   = Agency::all();
        $vouchers   = Voucher::all();
        $hotels     = Hotel::all();
        $flights    = Flight::all();
        return view('bookings.create', compact('continents', 'countries', 'cities', 'agencies', 'vouchers', 'hotels', 'flights'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour' => 'required|string|max:255',
            'date' => 'required|date',
            'customer' => 'required|string|max:255',
        ]);

        Booking::create($validated);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'tour' => 'required|string|max:255',
            'date' => 'required|date',
            'customer' => 'required|string|max:255',
        ]);

        $booking->update($validated);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'booking deleted successfully.');
    }
}
