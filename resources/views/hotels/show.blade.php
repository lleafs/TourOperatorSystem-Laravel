@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Hotel Details</h1>
    <ul class="list-group">
        <li class="list-group-item"><strong>Name:</strong> {{ $hotel->name }}</li>
        <li class="list-group-item"><strong>Location:</strong> {{ $hotel->location }}</li>
        <li class="list-group-item"><strong>Stars:</strong> {{ $hotel->stars }}</li>
        <li class="list-group-item"><strong>Contact:</strong> {{ $hotel->contact }}</li>
    </ul>
    <a href="{{ route('hotels.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
