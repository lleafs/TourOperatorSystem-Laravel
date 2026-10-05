@extends('layouts.app')

@section('content')
<div class="container">
    <h1>New Booking</h1>

    <form action="{{ route('receptivo-bookings.store') }}" method="POST">
        @csrf

        <div class="mb-2">
            <label>Agency</label>
            <select name="agency_id" class="form-control" required>
                @foreach($agencies as $agency)
                <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label>Customers</label>
            <select name="customer_ids[]" class="form-control" multiple required>
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}"
                    {{ isset($receptivoBooking) && $receptivoBooking->customers->contains($customer->id) ? 'selected' : '' }}>
                    {{ $customer->full_name }}
                </option>
                @endforeach
            </select>
        </div>


        <div class="mb-2">
            <label>Booking Date</label>
            <input type="date" name="booking_date" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <div class="mb-2">
            <label>Hotel Name</label>
            <input type="text" name="hotel_name" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Check In</label>
            <input type="date" name="check_in" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Check Out</label>
            <input type="date" name="check_out" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Total Amount</label>
            <input type="number" step="0.01" name="total_amount" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection