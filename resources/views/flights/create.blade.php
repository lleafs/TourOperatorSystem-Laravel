@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add a Route</h1>
    <form method="POST" action="{{ route('flights.store') }}">
        @csrf
        {{-- New: Country dropdown --}}
        <div class="mb-3">
            <label for="country_id">Country</label>
            <select id="country_id" name="country_id" class="form-control" required>
                <option value="">Select Country</option>
                @foreach($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="airline_id">Airline</label>
            <select id="airline_id" name="airline_id" class="form-control" required>
                <option value="">Select Airline</option>
                <!-- Options will be loaded dynamically -->
            </select>
        </div>

        <div class="mb-3">
            <label for="flight_number">Flight Number</label>
            <div class="input-group">
                <span class="input-group-text" id="iata_code_display">XX</span>
                <input type="text" id="flight_number" name="flight_number" class="form-control" required>
            </div>
            <small class="form-text text-muted">Your airline’s IATA code will auto‑prefix the flight number.</small>
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
                <option value="Cancelled">Estimated</option>
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