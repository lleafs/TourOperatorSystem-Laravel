<?php

namespace App\Http\Controllers;

use App\Models\EmisivoBooking;
use Illuminate\Http\Request;

class EmisivoBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = EmisivoBooking::latest()->paginate(10);
        return view('emisivo-bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('emisivo-bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'agency_id'            => 'required|exists:agencies,id',
            'booking_date'         => 'required|date',
            'status'               => 'required|string',
            'customer_name'        => 'required|string|max:255',
            'customer_email'       => 'required|email',
            'departure_country_id' => 'nullable|exists:countries,id',
            'departure_city_id'    => 'nullable|exists:cities,id',
            'airport_id'           => 'nullable|exists:airports,id',
            'notes'                => 'nullable|string',
            'total_amount'         => 'nullable|numeric|min:0',
        ]);

        EmisivoBooking::create($validated);

        return redirect()->route('emisivo-bookings.index')
            ->with('success', 'Emisivo booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmisivoBooking $emisivoBooking)
    {
        return view('emisivo-bookings.show', compact('emisivoBooking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmisivoBooking $emisivoBooking)
    {
        return view('emisivo-bookings.edit', compact('emisivoBooking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmisivoBooking $emisivoBooking)
    {
        $validated = $request->validate([
            'agency_id'            => 'required|exists:agencies,id',
            'booking_date'         => 'required|date',
            'status'               => 'required|string',
            'customer_name'        => 'required|string|max:255',
            'customer_email'       => 'required|email',
            'departure_country_id' => 'nullable|exists:countries,id',
            'departure_city_id'    => 'nullable|exists:cities,id',
            'airport_id'           => 'nullable|exists:airports,id',
            'notes'                => 'nullable|string',
            'total_amount'         => 'nullable|numeric|min:0',
        ]);

        $emisivoBooking->update($validated);

        return redirect()->route('emisivo-bookings.index')
            ->with('success', 'Emisivo booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmisivoBooking $emisivoBooking)
    {
        $emisivoBooking->delete();

        return redirect()->route('emisivo-bookings.index')
            ->with('success', 'Emisivo booking deleted successfully.');
    }
}
