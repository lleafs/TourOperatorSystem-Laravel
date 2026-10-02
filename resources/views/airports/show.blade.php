{{-- resources/views/airports/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Airport Details</h1>

    <table class="table table-bordered">
        <tbody>
            @foreach(['name','iata','icao','city','state','county','country','city_code','latitude','longitude','elevation','time_zone','url','type'] as $field)
                <tr>
                    <th>{{ ucfirst(str_replace('_',' ',$field)) }}</th>
                    <td>{{ $airport->$field }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('airports.edit', $airport) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('airports.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
