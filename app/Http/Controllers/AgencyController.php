<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agencies = Agency::all();
        return view('agencies.index', compact('agencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agencies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'director'     => 'required|string|max:255',
            'account'      => 'required|string|max:255',
            'license_date' => 'required|date',
            'commission'   => 'required|numeric|min:0',
        ]);

        $agency = Agency::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'agency' => $agency]);
        }

        return redirect()->route('agencies.index')->with('success', 'Agency created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agency $agency)
    {
        return view('agencies.show', compact('agency'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agency $agency)
    {
        return view('agencies.edit', compact('agency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agency $agency)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'account' => 'required|string|max:255',
            'license_date' => 'required|date',
            'commission' => 'required|numeric',
        ]);

        $agency->update($validated);

        return redirect()->route('agencies.index')
            ->with('success', 'Agency updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agency $agency)
    {
        $agency->delete();

        return redirect()->route('agencies.index')
            ->with('success', 'Agency deleted successfully.');
    }
}
