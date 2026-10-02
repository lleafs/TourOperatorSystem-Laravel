@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Bookings</h1>

    {{-- Flash success message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Add new booking button --}}
    <div class="mb-3">
        <a href="{{ route('bookings.create') }}" class="btn btn-primary">Add Booking</a>
    </div>

    {{-- Bookings table --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Email</th>
                <th>Booking Date</th>
                <th>Travel Date</th>
                <th>Status</th>
                <th>Agency</th>
                <th>Total Amount</th>
                <th>Hotel</th>
                <th>Flight</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->customer_name }}</td>
                    <td>{{ $booking->customer_email }}</td>
                    <td>{{ $booking->booking_date }}</td>
                    <td>{{ $booking->travel_date ?? '-' }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                    <td>{{ $booking->agency->name ?? '-' }}</td>
                    <td>${{ number_format($booking->total_amount, 2) }}</td>
                    <td>{{ $booking->hotel->name ?? '-' }}</td>
                    <td>{{ $booking->flight->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this booking?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No bookings found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
