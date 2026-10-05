@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Receptivo Bookings</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('receptivo-bookings.create') }}" class="btn btn-primary">Add New Booking</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Agency</th>
                <th>Customer</th>
                <th>Booking Date</th>
                <th>Status</th>
                <th>Hotel</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->agency->name ?? 'N/A' }}</td>
                <td>
                    @if($booking->customers->isNotEmpty())
                    @foreach($booking->customers as $customer)
                    {{ $customer->full_name }}<br>
                    @endforeach
                    @else
                    N/A
                    @endif
                </td>

                <td>{{ $booking->booking_date }}</td>
                <td>{{ ucfirst($booking->status) }}</td>
                <td>{{ $booking->hotel_name }} ({{ $booking->hotel_city }})</td>
                <td>{{ $booking->check_in }}</td>
                <td>{{ $booking->check_out }}</td>
                <td>{{ $booking->total_amount }}</td>
                <td class="d-flex">
                    <a href="{{ route('receptivo-bookings.show', $booking) }}" class="btn btn-info btn-sm me-1">View</a>
                    <a href="{{ route('receptivo-bookings.edit', $booking) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                    <form action="{{ route('receptivo-bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
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

    {{ $bookings->links() }}
</div>
@endsection