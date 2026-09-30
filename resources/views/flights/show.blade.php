@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Flight Details</h1>
    <ul class="list-group">
        <li class="list-group-item"><strong>Flight Number:</strong> {{ $flight->flight_number }}</li>
        <li class="list-group-item"><strong>Origin:</strong> {{ $flight->origin }}</li>
        <li class="list-group-item"><strong>Destination:</strong> {{ $flight->destination }}</li>
        <li class="list-group-item"><strong>Scheduled Time:</strong> {{ $flight->scheduled_time }}</li>
        <li class="list-group-item"><strong>Status:</strong> {{ $flight->status }}</li>
        <li class="list-group-item"><strong>Aircraft:</strong> {{ $flight->aircraft }}</li>
    </ul>
    <a href="{{ route('flights.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
