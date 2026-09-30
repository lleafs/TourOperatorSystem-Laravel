@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $agency->name }}</h1>
    <p><strong>Director:</strong> {{ $agency->director }}</p>
    <p><strong>Account:</strong> {{ $agency->account }}</p>
    <p><strong>License Date:</strong> {{ $agency->license_date }}</p>
    <p><strong>Commission:</strong> {{ $agency->commission }}%</p>
</div>
@endsection
