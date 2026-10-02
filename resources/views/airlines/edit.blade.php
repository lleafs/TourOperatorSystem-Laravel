@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Airline</h1>

    <form action="{{ route('airlines.update', $airline) }}" method="POST">
        @csrf
        @method('PUT')

        @foreach(['name','iata','icao','country','url'] as $field)
            <div class="mb-3">
                <label for="{{ $field }}" class="form-label">{{ ucfirst($field) }}</label>
                <input type="text" name="{{ $field }}" class="form-control" 
                       value="{{ old($field, $airline->$field) }}">
                @error($field)
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        @endforeach

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
