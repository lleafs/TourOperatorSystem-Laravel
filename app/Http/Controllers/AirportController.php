<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\City;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $airports = Airport::paginate(10); // returns a LengthAwarePaginator
        return view('airports.index', compact('airports'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('airports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'iata' => 'required|string|size:3|unique:airports',
            'icao' => 'nullable|string|size:4',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'county' => 'nullable|string',
            'country' => 'nullable|string',
            'city_code' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'elevation' => 'nullable|integer',
            'time_zone' => 'nullable|string',
            'url' => 'nullable|url',
            'type' => 'nullable|string',
        ]);

        Airport::create($request->all());
        return redirect()->route('airports.index')->with('success', 'Airport created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Airport $airport)
    {

        return view('airports.show', compact('airport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airport $airport)
    {

        return view('airports.edit', compact('airport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airport $airport)
    {
        $request->validate([
            'name' => 'required|string',
            'iata' => 'required|string|size:3|unique:airports,iata,' . $airport->id,
            'icao' => 'nullable|string|size:4',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'county' => 'nullable|string',
            'country' => 'nullable|string',
            'city_code' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'elevation' => 'nullable|integer',
            'time_zone' => 'nullable|string',
            'url' => 'nullable|url',
            'type' => 'nullable|string',
        ]);

        $airport->update($request->all());
        return redirect()->route('airports.index')->with('success', 'Airport updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airport $airport)
    {
        $airport->delete();

        return redirect()
            ->route('airports.index')
            ->with('success', 'Airport deleted successfully.');
    }

    /**
     * Add endpoints to fetch airports by city.
     */
    // AirportController.php
    public function getCitiesByCountry($countryId)
    {
        return City::where('country_id', $countryId)->orderBy('name')->get();
    }

    public function getAirportsByCity($cityName)
    {
        return Airport::where('city', $cityName)->orderBy('name')->get(['id', 'name', 'iata']);
    }
}
