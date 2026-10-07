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
                        <a class="nav-link" href="{{ route('customers.index') }}">
                            Customers
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="bookingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Bookings
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="bookingsDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('receptivo-bookings.index') }}">
                                    Receptivo Bookings
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('emisivo-bookings.index') }}">
                                    Emisivo Bookings
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('hotels.index') }}">
                            Hotels
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="aviationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Aviation
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aviationDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('airports.index') }}">
                                    Airports
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('airlines.index') }}">
                                    Airlines
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('flights.index') }}">
                                    Flights
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="geographyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Geography
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="geographyDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('continents.index') }}">
                                    Continents
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('countries.index') }}">
                                    Countries
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('cities.index') }}">
                                    Cities
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vouchers.index') }}">
                            Vouchers
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
                <div class="card-body d-flex justify-content-between align-items-center">

                    {{-- View Bookings --}}
                    <div class="btn-group" role="group">
                        <a href="{{ route('receptivo-bookings.index') }}" class="btn btn-success">
                            View Receptivo Bookings
                        </a>
                        <a href="{{ route('emisivo-bookings.index') }}" class="btn btn-success">
                            View Emisivo Bookings
                        </a>
                    </div>

                    {{-- New Booking Options --}}
                    <div class="btn-group ms-auto" role="group">
                        <a href="{{ route('emisivo-bookings.create', ['type' => 'emisivo']) }}" class="btn btn-primary">
                            New Emisivo Booking
                        </a>
                        <a href="{{ route('receptivo-bookings.create', ['type' => 'receptivo']) }}" class="btn btn-primary">
                            New Receptivo Booking
                        </a>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>
@endsection