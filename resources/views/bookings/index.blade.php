@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Bookings</h1>
    <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">New Booking</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tour</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->tour }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->customer }}</td>
                    <td>
                        <a href="{{ route('bookings.show', $booking) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('bookings.edit', $booking) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No bookings yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
