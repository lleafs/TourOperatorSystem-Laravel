@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Continents</h1>
    <a href="{{ route('continents.create') }}" class="btn btn-primary mb-3">Add Continent</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Continent Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($continents as $continent)
                <tr>
                    <td>{{ $continent->id }}</td>
                    <td>{{ $continent->name }}</td>
                    <td>
                        <a href="{{ route('continents.show', $continent->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('continents.edit', $continent->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('continents.destroy', $continent->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this continent?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
