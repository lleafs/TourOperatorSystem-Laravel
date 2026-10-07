@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Emisivo Bookings</h1>

    <a href="{{ route('emisivo-bookings.create') }}" class="btn btn-primary mb-3">New Emisivo Booking</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="EmisivoBookingTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Agency</th>
                <th>Booking Date</th>
                <th>Status</th>
                <th>Customer</th>
                <th>Scheduled Time</th>
                <th>Departure City</th>
                <th>Airport</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->agency?->name }}</td>
                <td>{{ $booking->booking_date }}</td>
                <td>{{ $booking->status }}</td>
                <td>{{ $booking->customer_name }}</td>
                <td>{{ $booking->departureFlight?->scheduled_time?->format('d M Y, H:i') ?? 'N/A' }}</td>
                <td>{{ $booking->departureCity->name }}</td>
                <td>{{ $booking->airport->name }}</td>
                <td>{{ 'CLP ' . number_format($booking->total_amount, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('emisivo-bookings.show', $booking) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('emisivo-bookings.edit', $booking) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('emisivo-bookings.destroy', $booking) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete this booking?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10">No bookings found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $bookings->links('pagination::bootstrap-5') }}
</div>
@endsection