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
use App\Models\Airport;
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
        $airports   = Airport::all();
        $hotels     = Hotel::all();
        $flights    = Flight::all();
        return view(
            'bookings.create',
            compact(
                'continents',
                'countries',
                'cities',
                'agencies',
                'vouchers',
                'airports',
                'hotels',
                'flights'
            )
        );

        //Debugging
        //$data = [
        //    'continents' => Continent::all(),
        //    'countries'  => Country::all(),
        //    'cities'     => City::all(),
        //    'agencies'   => Agency::all(),
        //    'vouchers'   => Voucher::all(),
        //    'hotels'     => Hotel::all(),
        //    'flights'    => Flight::all(),
        //];
        //dd($data);
        //return response()->json($data);
    }
    /**
     * Gets City by id.
     */
    public function getByCity($id)
    {
        $airports = Airport::where('city_id', $id)->get(['id', 'name', 'iata']);
        return response()->json($airports);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'agency_id'           => 'required|exists:agencies,id',
            'booking_date'        => 'required|date',
            'travel_date'         => 'nullable|date|after_or_equal:booking_date',
            'status'              => 'required|in:pending,confirmed,cancelled',
            'customer_name'       => 'required|string|max:255',
            'customer_email'      => 'required|email|max:255',
            'departure_country_id' => 'nullable|exists:countries,id',
            'departure_city_id'   => 'nullable|exists:cities,id',
            'airport_id'          => 'nullable|exists:airports,id',
            'hotel_timing'        => 'required|string|in:pre_flight,arrival,other',
            'hotel_name'          => 'required|string|max:255',
            'hotel_city'          => 'nullable|string|max:255',
            'check_in'            => 'required|date',
            'check_out'           => 'required|date|after_or_equal:check_in',
            'notes'               => 'nullable|string',
            'total_amount'        => 'required|numeric|min:0',
            'voucher_id'          => 'nullable|exists:vouchers,id',
            'hotel_id'            => 'nullable|exists:hotels,id',
            'flight_id'           => 'nullable|exists:flights,id',
        ]);

        Booking::create($validated);

        // Redirect back to bookings index with a success flash message
        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking created successfully');
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
