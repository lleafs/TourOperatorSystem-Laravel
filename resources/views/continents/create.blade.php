@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Continent</h1>

    <form action="{{ route('continents.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name">Continent Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('continents.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
