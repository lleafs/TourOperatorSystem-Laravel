<?php

namespace App\Http\Controllers;

use App\Models\ReceptivoBooking;
use Illuminate\Http\Request;

class ReceptivoBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = ReceptivoBooking::latest()->paginate(10);
        return view('receptivo-bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('receptivo-bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'agency_id'      => 'required|exists:agencies,id',
            'booking_date'   => 'required|date',
            'status'         => 'required|string',
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email',
            'hotel_name'     => 'required|string|max:255',
            'hotel_city'     => 'nullable|string|max:255',
            'hotel_timing'   => 'required|in:pre_flight,arrival,other',
            'check_in'       => 'required|date',
            'check_out'      => 'required|date|after_or_equal:check_in',
            'notes'          => 'nullable|string',
            'total_amount'   => 'nullable|numeric|min:0',
        ]);

        ReceptivoBooking::create($validated);

        return redirect()->route('receptivo-bookings.index')
            ->with('success', 'Receptivo booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReceptivoBooking $receptivoBooking)
    {
        return view('receptivo-bookings.show', compact('receptivoBooking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReceptivoBooking $receptivoBooking)
    {
        return view('receptivo-bookings.edit', compact('receptivoBooking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReceptivoBooking $receptivoBooking)
    {
        $validated = $request->validate([
            'agency_id'      => 'required|exists:agencies,id',
            'booking_date'   => 'required|date',
            'status'         => 'required|string',
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email',
            'hotel_name'     => 'required|string|max:255',
            'hotel_city'     => 'nullable|string|max:255',
            'hotel_timing'   => 'required|in:pre_flight,arrival,other',
            'check_in'       => 'required|date',
            'check_out'      => 'required|date|after_or_equal:check_in',
            'notes'          => 'nullable|string',
            'total_amount'   => 'nullable|numeric|min:0',
        ]);

        $receptivoBooking->update($validated);

        return redirect()->route('receptivo-bookings.index')
            ->with('success', 'Receptivo booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReceptivoBooking $receptivoBooking)
    {
        $receptivoBooking->delete();

        return redirect()->route('receptivo-bookings.index')
            ->with('success', 'Receptivo booking deleted successfully.');
    }
}
