<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Airline;
use App\Models\Country;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flights = Flight::all();
        return view('flights.index', compact('flights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $airlines = Airline::all();
        $countries = Country::all();
        return view('flights.create', compact('airlines', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_number'  => 'required|string|max:50|unique:flights,flight_number',
            'origin'         => 'required|string|max:255',
            'destination'    => 'required|string|max:255',
            'scheduled_time' => 'required|date',
            'status'         => 'required|string|in:Estimated,Scheduled,Delayed,Cancelled',
            'aircraft'       => 'nullable|string|max:255',
        ]);

        Flight::create($validated);

        return redirect()->route('flights.index')
            ->with('success', 'Flight created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        return view('flights.show', compact('flight'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        return view('flights.edit', compact('flight'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'flight_number'  => 'required|string|max:50|unique:flights,flight_number,' . $flight->id,
            'origin'         => 'required|string|max:255',
            'destination'    => 'required|string|max:255',
            'scheduled_time' => 'required|date',
            'status'         => 'required|string|in:Estimated,Scheduled,Delayed,Cancelled',
            'aircraft'       => 'nullable|string|max:255',
        ]);

        $flight->update($validated);

        return redirect()->route('flights.show', $flight)
            ->with('success', 'Flight updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        $flight->delete();

        return redirect()->route('flights.index')
            ->with('success', 'Flight deleted successfully.');
    }

    public function byAirport($airportId)
    {
        $airport = Airport::findOrFail($airportId);

        $flights = Flight::where('origin', $airport->iata)
            ->where('scheduled_time', '>=', Carbon::today()) // only today and future
            ->select('id', 'flight_number', 'origin', 'destination', 'scheduled_time', 'aircraft')
            ->orderBy('scheduled_time', 'asc')
            ->get();

        return response()->json($flights);
    }
}
