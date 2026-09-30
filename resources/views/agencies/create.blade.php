@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Agency</h1>
    <form method="POST" action="{{ route('agencies.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="director">Director</label>
            <input type="text" id="director" name="director" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="account">Account</label>
            <input type="text" id="account" name="account" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="license_date">License Date</label>
            <input type="date" id="license_date" name="license_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="commission">Commission (%)</label>
            <input type="number" step="0.01" id="commission" name="commission" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
