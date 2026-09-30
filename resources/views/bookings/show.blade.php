@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Booking Details</h1>
    <ul class="list-group">
        <li class="list-group-item"><strong>Tour:</strong> {{ $booking->tour }}</li>
        <li class="list-group-item"><strong>Date:</strong> {{ $booking->date }}</li>
        <li class="list-group-item"><strong>Customer:</strong> {{ $booking->customer }}</li>
    </ul>
    <a href="{{ route('bookings.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
