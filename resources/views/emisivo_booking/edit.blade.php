@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Emisivo Booking</h1>

    <form action="{{ route('emisivo-bookings.update', $emisivoBooking) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Agency --}}
        <div class="mb-3">
            <label for="agency_id" class="form-label">Agency</label>
            <select name="agency_id" id="agency_id" class="form-control" required>
                @foreach($agencies as $agency)
                    <option value="{{ $agency->id }}" 
                        {{ $emisivoBooking->agency_id == $agency->id ? 'selected' : '' }}>
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
                       class="form-control" value="{{ $emisivoBooking->booking_date }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ $emisivoBooking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $emisivoBooking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ $emisivoBooking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
        </div>

        {{-- Customer Info --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" 
                       class="form-control" value="{{ $emisivoBooking->customer_name }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="customer_email" class="form-label">Customer Email</label>
                <input type="email" name="customer_email" id="customer_email" 
                       class="form-control" value="{{ $emisivoBooking->customer_email }}" required>
            </div>
        </div>

        {{-- Flight Info --}}
        <h4>Flight</h4>
        <div class="mb-3">
            <label for="departure_country_id" class="form-label">Departure Country</label>
            <select name="departure_country_id" id="departure_country_id" class="form-control">
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" 
                        {{ $emisivoBooking->departure_country_id == $country->id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="departure_city_id" class="form-label">Departure City</label>
            <select name="departure_city_id" id="departure_city_id" class="form-control">
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" 
                        {{ $emisivoBooking->departure_city_id == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="airport_id" class="form-label">Airport</label>
            <select name="airport_id" id="airport_id" class="form-control">
                @foreach($airports as $airport)
                    <option value="{{ $airport->id }}" 
                        {{ $emisivoBooking->airport_id == $airport->id ? 'selected' : '' }}>
                        {{ $airport->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Notes --}}
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" id="notes" class="form-control" rows="3">{{ $emisivoBooking->notes }}</textarea>
        </div>

        {{-- Total Amount --}}
        <div class="mb-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="number" step="0.01" name="total_amount" id="total_amount" 
                   class="form-control" value="{{ $emisivoBooking->total_amount }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Booking</button>
        <a href="{{ route('emisivo-bookings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
