@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Customer Details</h1>
    <p><strong>Name:</strong> {{ $customer->full_name }}</p>
    <p><strong>Email:</strong> {{ $customer->email }}</p>
    <p><strong>Phone:</strong> {{ $customer->phone }}</p>
    <p><strong>Address:</strong> {{ $customer->address }}</p>

    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
