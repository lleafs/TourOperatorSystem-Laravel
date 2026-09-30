@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Booking</h1>
    <form method="POST" action="{{ route('bookings.store') }}">
        @csrf
        <div class="mb-3">
            <label for="tour">Tour</label>
            <input type="text" id="tour" name="tour" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="customer">Customer</label>
            <input type="text" id="customer" name="customer" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
