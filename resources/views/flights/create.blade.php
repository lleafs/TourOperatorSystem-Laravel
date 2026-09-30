@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Flight</h1>
    <form method="POST" action="{{ route('flights.store') }}">
        @csrf
        <div class="mb-3">
            <label for="flight_number">Flight Number</label>
            <input type="text" id="flight_number" name="flight_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="origin">Origin</label>
            <input type="text" id="origin" name="origin" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="destination">Destination</label>
            <input type="text" id="destination" name="destination" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="scheduled_time">Scheduled Time</label>
            <input type="datetime-local" id="scheduled_time" name="scheduled_time" class="form-control" required>
        </div>
        <div class="mb-3">
            <select name="status" class="form-control" required>
                <option value="Scheduled">Scheduled</option>
                <option value="Delayed">Delayed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="aircraft">Aircraft</label>
            <input type="text" id="aircraft" name="aircraft" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection