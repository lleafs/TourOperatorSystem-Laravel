<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::all();
        return view('vouchers.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agencies = Agency::all();
        return view('vouchers.create', compact('agencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:vouchers,code',
            'type' => 'required|string',
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
            'customer' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'agency_id' => 'required|exists:agencies,id',
        ]);

        Voucher::create($validated);

        return redirect()->route('vouchers.index')
            ->with('success', 'Voucher created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        return view('vouchers.show', compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $voucher)
    {
        $agencies = Agency::all();
        return view('vouchers.edit', compact('voucher', 'agencies'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $voucher)
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:50|unique:vouchers,code,' . $voucher->id,
            'type'        => 'required|string|in:discount,gift,promo',
            'issue_date'  => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:issue_date',
            'amount'      => 'required|integer|min:0',
            'currency'    => 'required|string|max:10',
            'customer'    => 'required|string|max:255',
            'notes'       => 'nullable|string',
            'agency_id'   => 'required|exists:agencies,id',
        ]);

        $voucher->update($validated);

        return redirect()->route('vouchers.show', $voucher)
            ->with('success', 'Voucher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();

        return redirect()->route('vouchers.index')
            ->with('success', 'voucher deleted successfully.');
    }
}
