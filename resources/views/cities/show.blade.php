@extends('layouts.app')

@section('content')
<div class="container">
    <h1>City Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $city->name }}</h5>
            <p class="card-text"><strong>Country:</strong> {{ $city->country->name }}</p>
        </div>
    </div>

    <a href="{{ route('cities.index') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
