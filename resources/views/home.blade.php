@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Sidebar --}}
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="/home">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('agencies.index') }}">
                            Travel Agencies
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vouchers.index') }}">
                            Vouchers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('hotels.index') }}">
                            Hotels
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('flights.index') }}">
                            Flights
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        {{-- Main content --}}
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h1 class="mt-4">Dashboard</h1>
            <p>Welcome to the Tour Operator System dashboard. Use the side menu to navigate.</p>

{{-- Example panel linking to Bookings --}}
<div class="card mt-4">
    <div class="card-header">Quick Access</div>
    <div class="card-body">
        <a href="{{ route('bookings.index') }}" class="btn btn-success">View Bookings</a>

        {{-- New Booking Options --}}
        <div class="btn-group" role="group">
            <a href="{{ route('emisivo-bookings.create', ['type' => 'emisivo']) }}" class="btn btn-primary">
                New Emisivo Booking
            </a>
            <a href="{{ route('receptivo-bookings.create', ['type' => 'receptivo']) }}" class="btn btn-info">
                New Receptivo Booking
            </a>
        </div>
    </div>
</div>

        </main>
    </div>
</div>
@endsection
