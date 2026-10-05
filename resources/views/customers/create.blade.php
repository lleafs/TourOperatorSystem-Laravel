@extends('layouts.app')

@section('content')
<div class="container">
    <h1>New Customer</h1>
    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        @include('customers.partials.form')
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
