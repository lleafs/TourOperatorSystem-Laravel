@extends('layouts.app')

@section('content')
<form action="{{ route('cities.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name">City Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="country_id">Country</label>
        <select name="country_id" class="form-control" required>
            @foreach($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection