@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Airlines</h1>
    <a href="{{ route('airlines.create') }}" class="btn btn-primary mb-3">Add Airline</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Name</th>
                <th>IATA</th>
                <th>ICAO</th>
                <th>Country</th>
                <th>Year Created</th>
                <th>Base</th>
                <th>Fleet</th>
                <th>Logos</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($airlines as $airline)
                <tr>
                    <td>{{ $airline->name }}</td>
                    <td>{{ $airline->iata }}</td>
                    <td>{{ $airline->icao }}</td>
                    <td>{{ $airline->country }}</td>
                    <td>{{ $airline->year_created }}</td>
                    <td>{{ $airline->base }}</td>
                    <td>
                        {{-- fleet stored as JSON --}}
                        @if(is_array($airline->fleet))
                            @foreach($airline->fleet as $type => $count)
                                <div>{{ $type }}: {{ $count }}</div>
                            @endforeach
                        @else
                            {{ $airline->fleet }}
                        @endif
                    </td>
                    <td>
                        @if($airline->logo_url)
                            <img src="{{ $airline->logo_url }}" alt="Logo" height="30">
                        @endif
                        @if($airline->brandmark_url)
                            <img src="{{ $airline->brandmark_url }}" alt="Brandmark" height="30">
                        @endif
                        @if($airline->tail_logo_url)
                            <img src="{{ $airline->tail_logo_url }}" alt="Tail Logo" height="30">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('airlines.show', $airline) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('airlines.edit', $airline) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('airlines.destroy', $airline) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this airline?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $airlines->links('pagination::bootstrap-5') }}

</div>
@endsection
