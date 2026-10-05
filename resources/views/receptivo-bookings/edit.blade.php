@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Booking</h1>

    <form action="{{ route('receptivo-bookings.update', $receptivoBooking) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label>Agency</label>
            <select name="agency_id" class="form-control" required>
                @foreach($agencies as $agency)
                <option value="{{ $agency->id }}"
                    {{ $receptivoBooking->agency_id == $agency->id ? 'selected' : '' }}>
                    {{ $agency->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label>Customers</label>
            <select name="customer_ids[]" class="form-control" multiple required>
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}"
                    {{ $receptivoBooking->customers->contains($customer->id) ? 'selected' : '' }}>
                    {{ $customer->full_name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label>Booking Date</label>
            <input type="date" name="booking_date" class="form-control"
                value="{{ $receptivoBooking->booking_date }}" required>
        </div>

        <div class="mb-2">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="pending" {{ $receptivoBooking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $receptivoBooking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ $receptivoBooking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="mb-2">
            <label>Hotel Name</label>
            <input type="text" name="hotel_name" class="form-control"
                value="{{ $receptivoBooking->hotel_name }}" required>
        </div>

        <div class="mb-2">
            <label>Check In</label>
            <input type="date" name="check_in" class="form-control"
                value="{{ $receptivoBooking->check_in }}" required>
        </div>

        <div class="mb-2">
            <label>Check Out</label>
            <input type="date" name="check_out" class="form-control"
                value="{{ $receptivoBooking->check_out }}" required>
        </div>

        <div class="mb-2">
            <label>Total Amount</label>
            <input type="number" step="0.01" name="total_amount" class="form-control"
                value="{{ $receptivoBooking->total_amount }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('receptivo-bookings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
