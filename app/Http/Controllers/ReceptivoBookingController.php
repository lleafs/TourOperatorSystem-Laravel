<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Customer;
use App\Models\ReceptivoBooking;
use Illuminate\Http\Request;

class ReceptivoBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = ReceptivoBooking::with(['agency', 'customer'])->latest()->paginate(10);
        return view('receptivo-bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agencies = Agency::all();
        $customers = Customer::all();
        return view('receptivo-bookings.create', compact('agencies', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'agency_id'    => 'required|exists:agencies,id',
            'booking_date' => 'required|date',
            'status'       => 'required|string|in:pending,confirmed,cancelled',
            'hotel_name'   => 'required|string|max:255',
            'check_in'     => 'required|date',
            'check_out'    => 'required|date|after_or_equal:check_in',
            'total_amount' => 'nullable|numeric|min:0',
            'customer_ids' => 'required|array',
            'customer_ids.*' => 'exists:customers,id',
        ]);

        $booking = ReceptivoBooking::create($validated);

        // asignar clientes
        $booking->customers()->sync($validated['customer_ids']);

        return redirect()->route('receptivo-bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReceptivoBooking $receptivoBooking)
    {
        // Traemos todos los clientes disponibles para asignar
        $customers = Customer::all();

        // Cargamos también la relación de clientes ya asignados
        $receptivoBooking->load('customers', 'agency');
        return view('receptivo-bookings.show', compact('receptivoBooking', 'customers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReceptivoBooking $receptivoBooking)
    {
        $agencies  = Agency::all();
        $customers = Customer::all();
        return view('receptivo-bookings.edit', compact('receptivoBooking', 'agencies', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReceptivoBooking $receptivoBooking)
    {
        $validated = $request->validate([
            'agency_id'    => 'required|exists:agencies,id',
            'booking_date' => 'required|date',
            'status'       => 'required|string|in:pending,confirmed,cancelled',
            'hotel_name'   => 'required|string|max:255',
            'check_in'     => 'required|date',
            'check_out'    => 'required|date|after_or_equal:check_in',
            'total_amount' => 'nullable|numeric|min:0',
            'customer_ids' => 'required|array',
            'customer_ids.*' => 'exists:customers,id',
        ]);

        $receptivoBooking->update($validated);

        // sincronizar clientes
        $receptivoBooking->customers()->sync($validated['customer_ids']);

        return redirect()->route('receptivo-bookings.index')
            ->with('success', 'Booking updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReceptivoBooking $receptivoBooking)
    {
        $receptivoBooking->delete();

        return redirect()->route('receptivo-bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    public function assignCustomer(Request $request, ReceptivoBooking $booking)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
        ]);

        // Agregar cliente al booking sin borrar los anteriores
        $booking->customers()->attach($validated['customer_id']);

        return response()->json([
            'success' => true,
            'customer' => $booking->customers()->find($validated['customer_id'])
        ]);
    }

    public function removeCustomer(ReceptivoBooking $booking, Customer $customer)
    {
        $booking->customers()->detach($customer->id);

        return response()->json([
            'success' => true,
            'customer_id' => $customer->id
        ]);
    }
}
