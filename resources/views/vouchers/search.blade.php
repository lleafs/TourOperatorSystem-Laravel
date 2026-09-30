@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Search Vouchers</h1>

    <form method="GET" action="/vouchers/search">
        <div class="mb-3">
            <label for="query" class="form-label">Search term</label>
            <input type="text" id="query" name="query" class="form-control" placeholder="Enter voucher keyword">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    {{-- Placeholder results --}}
    <div class="mt-4">
        <h2>Results</h2>
        <p>No vouchers found yet.</p>
    </div>
</div>
@endsection
