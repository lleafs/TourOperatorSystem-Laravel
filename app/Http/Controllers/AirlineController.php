<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $airlines = Airline::paginate(10);
        return view('airlines.index', compact('airlines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('airlines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string',
            'iata'   => 'nullable|string|size:2|unique:airlines',
            'icao'   => 'nullable|string|size:3|unique:airlines',
            'country' => 'nullable|string',
            'url'    => 'nullable|url',
        ]);

        Airline::create($request->all());

        return redirect()->route('airlines.index')
            ->with('success', 'Airline created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Airline $airline)
    {
        return view('airlines.show', compact('airline'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airline $airline)
    {
        return view('airlines.edit', compact('airline'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airline $airline)
    {
        $request->validate([
            'name'   => 'required|string',
            'iata'   => 'nullable|string|size:2|unique:airlines,iata,' . $airline->id,
            'icao'   => 'nullable|string|size:3|unique:airlines,icao,' . $airline->id,
            'country' => 'nullable|string',
            'url'    => 'nullable|url',
        ]);

        $airline->update($request->all());

        return redirect()->route('airlines.index')
            ->with('success', 'Airline updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airline $airline)
    {
        $airline->delete();

        return redirect()->route('airlines.index')
            ->with('success', 'Airline deleted successfully.');
    }
}
