@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Continent</h1>

    <form action="{{ route('continents.update', $continent->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="name">Continent Name</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $continent->name) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('continents.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
