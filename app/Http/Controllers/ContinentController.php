<?php

namespace App\Http\Controllers;

use App\Models\Continent;
use Illuminate\Http\Request;

class ContinentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $continents = Continent::all();
        return view('continents.index', compact('continents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('continents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:continents,name',
        ]);

        Continent::create($request->only('name'));

        return redirect()->route('continents.index')
            ->with('success', 'Continent created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Continent $continent)
    {
        return view('continents.show', compact('continent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Continent $continent)
    {
        return view('continents.edit', compact('continent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Continent $continent)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:continents,name,' . $continent->id,
        ]);

        $continent->update($request->only('name'));

        return redirect()->route('continents.index')
            ->with('success', 'Continent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Continent $continent)
    {
        $continent->delete();

        return redirect()->route('continents.index')
            ->with('success', 'Continent deleted successfully.');
    }
}
