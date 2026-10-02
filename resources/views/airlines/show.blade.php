@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Airline Details</h1>

    <table class="table table-bordered">
        <tbody>
            <tr><th>Name</th><td>{{ $airline->name }}</td></tr>
            <tr><th>IATA</th><td>{{ $airline->iata }}</td></tr>
            <tr><th>ICAO</th><td>{{ $airline->icao }}</td></tr>
            <tr><th>Country</th><td>{{ $airline->country }}</td></tr>
            <tr><th>Year Created</th><td>{{ $airline->year_created }}</td></tr>
            <tr><th>Base</th><td>{{ $airline->base }}</td></tr>
            <tr>
                <th>Fleet</th>
                <td>
                    @if(is_array($airline->fleet))
                        @foreach($airline->fleet as $type => $count)
                            <div>{{ $type }}: {{ $count }}</div>
                        @endforeach
                    @else
                        {{ $airline->fleet }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Logos</th>
                <td>
                    @if($airline->logo_url)
                        <img src="{{ $airline->logo_url }}" alt="Logo" height="50">
                    @endif
                    @if($airline->brandmark_url)
                        <img src="{{ $airline->brandmark_url }}" alt="Brandmark" height="50">
                    @endif
                    @if($airline->tail_logo_url)
                        <img src="{{ $airline->tail_logo_url }}" alt="Tail Logo" height="50">
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('airlines.edit', $airline) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('airlines.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
