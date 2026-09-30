@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit City</h1>

    <form action="{{ route('cities.update', $city->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="name">City Name</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $city->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="country_id">Country</label>
            <select name="country_id" class="form-control" required>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}"
                        {{ $city->country_id == $country->id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('cities.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
