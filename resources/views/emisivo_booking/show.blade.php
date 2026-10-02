@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Emisivo Booking Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Booking #{{ $emisivoBooking->id }}</h5>
            <p><strong>Agency:</strong> {{ $emisivoBooking->agency_id }}</p>
            <p><strong>Booking Date:</strong> {{ $emisivoBooking->booking_date }}</p>
            <p><strong>Status:</strong> {{ $emisivoBooking->status }}</p>
            <p><strong>Customer:</strong> {{ $emisivoBooking->customer_name }} ({{ $emisivoBooking->customer_email }})</p>
            <p><strong>Departure Country:</strong> {{ $emisivoBooking->departure_country_id }}</p>
            <p><strong>Departure City:</strong> {{ $emisivoBooking->departure_city_id }}</p>
            <p><strong>Airport:</strong> {{ $emisivoBooking->airport_id }}</p>
            <p><strong>Notes:</strong> {{ $emisivoBooking->notes }}</p>
            <p><strong>Total Amount:</strong> {{ $emisivoBooking->total_amount }}</p>
        </div>
    </div>

    <a href="{{ route('emisivo-bookings.edit', $emisivoBooking) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('emisivo-bookings.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
