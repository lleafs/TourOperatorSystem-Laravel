{{-- resources/views/airports/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Airport</h1>

    <form action="{{ route('airports.update', $airport) }}" method="POST">
        @csrf
        @method('PUT')

        @foreach(['name','iata','icao','city','state','county','country','city_code','latitude','longitude','elevation','time_zone','url','type'] as $field)
            <div class="mb-3">
                <label for="{{ $field }}" class="form-label">{{ ucfirst(str_replace('_',' ',$field)) }}</label>
                <input type="text" name="{{ $field }}" class="form-control" value="{{ old($field, $airport->$field) }}">
            </div>
        @endforeach

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
