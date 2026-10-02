<?php

namespace App\Http\Controllers;

use App\Models\EmisivoBooking;
use App\Models\Agency;
use App\Models\Country;
use App\Models\City;
use App\Models\Airport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmisivoBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = EmisivoBooking::with(['departureCountry', 'departureCity', 'airport'])
        ->latest()
        ->paginate(10);
        return view('emisivo-bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->query('type'); // or $request->type
        $agencies = Agency::all();
        $countries = Country::all();
        $cities = City::all();
        $airports = Airport::all();
        return view('emisivo-bookings.create', compact('agencies', 'countries', 'cities', 'airports', 'type'));
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

        Log::info('Validated data:', $validated);

        $booking = new EmisivoBooking($validated);

        if ($booking->save()) {
            Log::info('Booking saved with ID: ' . $booking->id);
            return redirect()->route('emisivo-bookings.index')
                ->with('success', 'Booking saved!');
        } else {
            Log::error('Booking save failed', ['booking' => $booking]);
            dd('Save failed', $booking);
        }
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

        $agencies = Agency::all();
        $countries = Country::all();
        $cities = City::all();
        $airports = Airport::all();
        return view('emisivo-bookings.create', compact('emisivoBooking', 'agencies', 'countries', 'cities', 'airports'));
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
