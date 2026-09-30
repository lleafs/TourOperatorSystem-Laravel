@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Hotel</h1>
    <form method="POST" action="{{ route('hotels.update', $hotel) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="name">Hotel Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $hotel->name }}" required>
        </div>
        <div class="mb-3">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" class="form-control" value="{{ $hotel->location }}" required>
        </div>
        <div class="mb-3">
            <label for="stars">Stars</label>
            <input type="number" id="stars" name="stars" class="form-control" value="{{ $hotel->stars }}" min="1" max="5" required>
        </div>
        <div class="mb-3">
            <label for="contact">Contact Info</label>
            <input type="text" id="contact" name="contact" class="form-control" value="{{ $hotel->contact }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
