@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Continent Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $continent->name }}</h5>
        </div>
    </div>

    <a href="{{ route('continents.index') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
