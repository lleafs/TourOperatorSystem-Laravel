@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Receptivo Booking</h1>

    <form action="{{ route('receptivo-bookings.update', $receptivoBooking) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Agency --}}
        <div class="mb-3">
            <label for="agency_id" class="form-label">Agency</label>
            <select name="agency_id" id="agency_id" class="form-control" required>
                @foreach($agencies as $agency)
                <option value="{{ $agency->id }}"
                    {{ $receptivoBooking->agency_id == $agency->id ? 'selected' : '' }}>
                    {{ $agency->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Booking Date & Status --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="booking_date" class="form-label">Booking Date</label>
                <input type="date" name="booking_date" id="booking_date"
                    class="form-control" value="{{ $receptivoBooking->booking_date }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ $receptivoBooking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $receptivoBooking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ $receptivoBooking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
        </div>

        {{-- Customer Info --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name"
                    class="form-control" value="{{ $receptivoBooking->customer_name }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="customer_email" class="form-label">Customer Email</label>
                <input type="email" name="customer_email" id="customer_email"
                    class="form-control" value="{{ $receptivoBooking->customer_email }}" required>
            </div>
        </div>

        {{-- Hotel Info --}}
        <h4>Hotel</h4>
        <div class="mb-3">
            <label for="hotel_name" class="form-label">Hotel Name</label>
            <input type="text" name="hotel_name" id="hotel_name"
                class="form-control" value="{{ $receptivoBooking->hotel_name }}" required>
        </div>

        <div class="mb-3">
            <label for="hotel_city" class="form-label">Hotel City</label>
            <input type="text" name="hotel_city" id="hotel_city"
                class="form-control" value="{{ $receptivoBooking->hotel_city }}">
        </div>

        <div class="mb-3">
            <label for="hotel_timing" class="form-label">Hotel Timing</label>
            <select name="hotel_timing" id="hotel_timing" class="form-control" required>
                <option value="pre_flight" {{ $receptivoBooking->hotel_timing == 'pre_flight' ? 'selected' : '' }}>Pre‑Flight Stay</option>
                <option value="arrival" {{ $receptivoBooking->hotel_timing == 'arrival' ? 'selected' : '' }}>Arrival Stay</option>
                <option value="other" {{ $receptivoBooking->hotel_timing == 'other' ? 'selected' : '' }}>Other / Custom</option>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="check_in" class="form-label">Check‑In Date</label>
                <input type="date" name="check_in" id="check_in"
                    class="form-control" value="{{ $receptivoBooking->check_in }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="check_out" class="form-label">Check‑Out Date</label>
                <input type="date" name="check_out" id="check_out"
                    class="form-control" value="{{ $receptivoBooking->check_out }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" id="notes" class="form-control" rows="3">{{ $receptivoBooking->notes }}</textarea>
        </div>

        <div class="mb-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="number" step="0.01" name="total_amount" id="total_amount"
                class="form-control" value="{{ $receptivoBooking->total_amount }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Booking</button>
        <a href="{{ route('receptivo-bookings.index') }}" class="btn btn-secondary">Cancel</a>