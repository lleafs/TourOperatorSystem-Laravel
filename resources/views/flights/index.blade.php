@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Flights</h1>
    <a href="{{ route('flights.create') }}" class="btn btn-primary mb-3">Add Route</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Flight Number</th>
                <th>Origin</th>
                <th>Destination</th>
                <th>Scheduled Time</th>
                <th>Status</th>
                <th>Aircraft</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($flights as $flight)
                <tr>
                    <td>{{ $flight->flight_number }}</td>
                    <td>{{ $flight->origin }}</td>
                    <td>{{ $flight->destination }}</td>
                    <td>{{ $flight->scheduled_time }}</td>
                    <td>{{ $flight->status }}</td>
                    <td>{{ $flight->aircraft }}</td>
                    <td>
                        <a href="{{ route('flights.show', $flight) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('flights.edit', $flight) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('flights.destroy', $flight) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">No flights yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
