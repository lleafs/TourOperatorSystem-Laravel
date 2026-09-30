@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Travel Agencies</h1>
    <a href="{{ route('agencies.create') }}" class="btn btn-primary mb-3">New Agency</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Director</th>
                <th>Account</th>
                <th>License Date</th>
                <th>Commission (%)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agencies as $agency)
                <tr>
                    <td>{{ $agency->name }}</td>
                    <td>{{ $agency->director }}</td>
                    <td>{{ $agency->account }}</td>
                    <td>{{ $agency->license_date }}</td>
                    <td>{{ $agency->commission }}</td>
                    <td>
                        <a href="{{ route('agencies.show', $agency) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('agencies.edit', $agency) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('agencies.destroy', $agency) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No agencies yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
