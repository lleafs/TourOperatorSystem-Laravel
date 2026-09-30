@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Flight</h1>
    <form method="POST" action="{{ route('flights.update', $flight) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="flight_number">Flight Number</label>
            <input type="text" id="flight_number" name="flight_number" class="form-control" value="{{ $flight->flight_number }}" required>
        </div>
        <div class="mb-3">
            <label for="origin">Origin</label>
            <input type="text" id="origin" name="origin" class="form-control" value="{{ $flight->origin }}" required>
        </div>
        <div class="mb-3">
            <label for="destination">Destination</label>
            <input type="text" id="destination" name="destination" class="form-control" value="{{ $flight->destination }}" required>
        </div>
        <div class="mb-3">
            <label for="scheduled_time">Scheduled Time</label>
            <input type="datetime-local" id="scheduled_time" name="scheduled_time" class="form-control" value="{{ $flight->scheduled_time }}" required>
        </div>
        <div class="mb-3">
            <label for="status">Status</label>
            <input type="text" id="status" name="status" class="form-control" value="{{ $flight->status }}">
        </div>
        <div class="mb-3">
            <label for="aircraft">Aircraft</label>
            <input type="text" id="aircraft" name="aircraft" class="form-control" value="{{ $flight->aircraft }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
