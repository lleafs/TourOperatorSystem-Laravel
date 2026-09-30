@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Country</h1>

    <form action="{{ route('countries.update', $country->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="name">Country Name</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $country->name) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('countries.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
