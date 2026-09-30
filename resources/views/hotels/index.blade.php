@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Hotels</h1>
    <a href="{{ route('hotels.create') }}" class="btn btn-primary mb-3">New Hotel</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Stars</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($hotels as $hotel)
                <tr>
                    <td>{{ $hotel->name }}</td>
                    <td>{{ $hotel->location }}</td>
                    <td>{{ $hotel->stars }}</td>
                    <td>{{ $hotel->contact }}</td>
                    <td>
                        <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('hotels.edit', $hotel) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('hotels.destroy', $hotel) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No hotels yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
