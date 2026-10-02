@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Receptivo Bookings</h1>

    <a href="{{ route('receptivo-bookings.create') }}" class="btn btn-primary mb-3">New Receptivo Booking</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Agency</th>
                <th>Booking Date</th>
                <th>Status</th>
                <th>Customer</th>
                <th>Hotel Name</th>
                <th>Hotel City</th>
                <th>Hotel Timing</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->agency_id }}</td>
                    <td>{{ $booking->booking_date }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>{{ $booking->customer_name }}</td>
                    <td>{{ $booking->hotel_name }}</td>
                    <td>{{ $booking->hotel_city }}</td>
                    <td>{{ $booking->hotel_timing }}</td>
                    <td>{{ $booking->check_in }}</td>
                    <td>{{ $booking->check_out }}</td>
                    <td>{{ $booking->total_amount }}</td>
                    <td>
                        <a href="{{ route('receptivo-bookings.show', $booking) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('receptivo-bookings.edit', $booking) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('receptivo-bookings.destroy', $booking) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this booking?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="12">No bookings found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $bookings->links() }}
</div>
@endsection
