{{-- resources/views/airports/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Airports</h1>
    <a href="{{ route('airports.create') }}" class="btn btn-primary mb-3">Add Airport</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Name</th>
                <th>IATA</th>
                <th>ICAO</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Elevation</th>
                <th>Time Zone</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($airports as $airport)
                <tr>
                    <td>{{ $airport->name }}</td>
                    <td>{{ $airport->iata }}</td>
                    <td>{{ $airport->icao }}</td>
                    <td>{{ $airport->city }}</td>
                    <td>{{ $airport->state }}</td>
                    <td>{{ $airport->country }}</td>
                    <td>{{ $airport->latitude }}</td>
                    <td>{{ $airport->longitude }}</td>
                    <td>{{ $airport->elevation }}</td>
                    <td>{{ $airport->time_zone }}</td>
                    <td>{{ $airport->type }}</td>
                    <td>
                        <a href="{{ route('airports.show', $airport) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('airports.edit', $airport) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('airports.destroy', $airport) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this airport?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $airports->links('pagination::bootstrap-5') }}

</div>
@endsection
