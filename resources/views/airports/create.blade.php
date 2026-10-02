{{-- resources/views/airports/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Airport</h1>

    <form action="{{ route('airports.store') }}" method="POST">
        @csrf

        @foreach(['name','iata','icao','city','state','county','country','city_code','latitude','longitude','elevation','time_zone','url','type'] as $field)
            <div class="mb-3">
                <label for="{{ $field }}" class="form-label">{{ ucfirst(str_replace('_',' ',$field)) }}</label>
                <input type="text" name="{{ $field }}" class="form-control" value="{{ old($field) }}">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
