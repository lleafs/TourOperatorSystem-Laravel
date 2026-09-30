@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Booking</h1>
    <form method="POST" action="{{ route('bookings.update', $booking) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="tour">Tour</label>
            <input type="text" id="tour" name="tour" class="form-control" value="{{ $booking->tour }}" required>
        </div>
        <div class="mb-3">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" class="form-control" value="{{ $booking->date }}" required>
        </div>
        <div class="mb-3">
            <label for="customer">Customer</label>
            <input type="text" id="customer" name="customer" class="form-control" value="{{ $booking->customer }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
