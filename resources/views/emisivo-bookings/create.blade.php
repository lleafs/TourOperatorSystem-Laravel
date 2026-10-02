@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Emisivo Booking</h1>

    <form action="{{ route('emisivo-bookings.store') }}" method="POST">
        @csrf

        {{-- Agency --}}
        <div class="mb-3">
            <label for="agency_id" class="form-label">Agency</label>
            <select name="agency_id" id="agency_id" class="form-control" required>
                @foreach($agencies as $agency)
                <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Booking Date & Status --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="booking_date" class="form-label">Booking Date</label>
                <input type="date" name="booking_date" id="booking_date" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        {{-- Customer Info --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                @error('customer_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="customer_email" class="form-label">Customer Email</label>
                <input type="email" name="customer_email" id="customer_email" class="form-control" required>
                @error('customer_email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Flight Info --}}
        <h4>Flight</h4>
        <div class="mb-3">
            <label for="departure_country_id" class="form-label">Departure Country</label>
            <select name="departure_country_id" id="departure_country_id" class="form-control">
                <option value="">Select Country</option>
                @foreach($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            @error('departure_country_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="departure_city_id" class="form-label">Departure City</label>
            <select name="departure_city_id" id="departure_city_id" class="form-control">
                <option value="">Select City</option>
                @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            {{-- Validation error --}}
            @error('departure_city_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="airport_id" class="form-label">Airport</label>
            <select name="airport_id" id="airport_id" class="form-control">
                <option value="">Select Airport</option>
                @foreach($airports as $airport)
                <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                @endforeach
            </select>
            @error('airport_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Notes --}}
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
        </div>

        {{-- Total Amount --}}
        <div class="mb-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="number" step="0.01" name="total_amount" id="total_amount" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Save Booking</button>
        <a href="{{ route('emisivo-bookings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection