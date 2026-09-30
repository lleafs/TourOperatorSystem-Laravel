@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Agency</h1>

    {{-- Show validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('agencies.update', $agency->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Agency Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ old('name', $agency->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="director" class="form-label">Director</label>
            <input type="text" class="form-control" id="director" name="director"
                   value="{{ old('director', $agency->director) }}" required>
        </div>

        <div class="mb-3">
            <label for="account" class="form-label">Account</label>
            <input type="text" class="form-control" id="account" name="account"
                   value="{{ old('account', $agency->account) }}" required>
        </div>

        <div class="mb-3">
            <label for="license_date" class="form-label">License Date</label>
            <input type="date" class="form-control" id="license_date" name="license_date"
                   value="{{ old('license_date', $agency->license_date) }}" required>
        </div>

        <div class="mb-3">
            <label for="commission" class="form-label">Commission (%)</label>
            <input type="number" step="0.01" class="form-control" id="commission" name="commission"
                   value="{{ old('commission', $agency->commission) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Agency</button>
        <a href="{{ route('agencies.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
