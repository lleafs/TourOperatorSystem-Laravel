@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Receptivo Booking Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Booking #{{ $receptivoBooking->id }}</h5>
            <p><strong>Agency:</strong> {{ $receptivoBooking->agency_id }}</p>
            <p><strong>Booking Date:</strong> {{ $receptivoBooking->booking_date }}</p>
            <p><strong>Status:</strong> {{ $receptivoBooking->status }}</p>
            <p><strong>Customer:</strong> {{ $receptivoBooking->customer_name }} ({{ $receptivoBooking->customer_email }})</p>
            <p><strong>Hotel Name:</strong> {{ $receptivoBooking->hotel_name }}</p>
            <p><strong>Hotel City:</strong> {{ $receptivoBooking->hotel_city }}</p>
            <p><strong>Hotel Timing:</strong> {{ $receptivoBooking->hotel_timing }}</p>
            <p><strong>Check-In:</strong> {{ $receptivoBooking->check_in }}</p>
            <p><strong>Check-Out:</strong> {{ $receptivoBooking->check_out }}</p>
            <p><strong>Notes:</strong> {{ $receptivoBooking->notes }}</p>
            <p><strong>Total Amount:</strong> {{ $receptivoBooking->total_amount }}</p>
        </div>
    </div>

    <a href="{{ route('receptivo-bookings.edit', $receptivoBooking) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('receptivo-bookings.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
