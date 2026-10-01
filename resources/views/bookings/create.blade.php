@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Create Booking</h1>

    {{-- Booking Form --}}
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf

        {{-- Booking Info --}}
        <div class="mb-3">
            <label for="agency_id">Agency</label>
            <select name="agency_id" id="agency_id" class="form-control" required>
                @foreach($agencies as $agency)
                    <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="booking_date">Booking Date</label>
                <input type="date" id="booking_date" name="booking_date" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="status">Status</label>
                <select name="status"  id="status" class="form-control">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        {{-- Customer Info --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="customer_name">Customer Name</label>
                <input type="text" id="customer_name" name="customer_name"  class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="customer_email">Customer Email</label>
                <input type="email" id="customer_email" name="customer_email" class="form-control" required>
            </div>
        </div>

        {{-- Flight & Hotel --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <h4>Flight</h4>

                {{-- Departure Country --}}
                <div class="mb-3">
                    <label for="departure_country_id">Departure Country</label>
                    <div class="input-group">
                        <select id="departure_country_id" name="departure_country_id" class="form-control">
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addCountryModal">
                            Add
                        </button>
                    </div>
                </div>

                {{-- Departure City --}}
                <div class="mb-3">
                    <label for="departure_city_id">Departure City</label>
                    <div class="input-group">
                        <select id="departure_city_id" name="departure_city_id" class="form-control">
                            <option value="">Select City</option>
                        </select>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addCityModal">
                            Add
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="flight_id">Select Flight</label>
                    <select name="flight_id" id="flight_id" class="form-control">
                        <option value="">None</option>
                        @foreach($flights as $flight)
                            <option value="{{ $flight->id }}">{{ $flight->route }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="travel_date">Travel Date</label>
                    <input type="date" name="travel_date"  id="travel_date" class="form-control">
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <h4>Hotel</h4>
                <div class="mb-3">
                    <label for="hotel_id">Select Hotel</label>
                    <select name="hotel_id"  id="hotel_id" class="form-control">
                        <option value="">None</option>
                        @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="total_amount">Total Amount</label>
                    <input type="number" step="0.01" name="total_amount" id="total_amount" class="form-control">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Booking</button>
        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

{{-- Country Modal (separate form) --}}
<div class="modal fade" id="addCountryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addCountryForm" method="POST" action="{{ route('countries.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="country_name">Country Name</label>
                        <input type="text" name="name" id="country_name" class="form-control" required>
                    </div>
                    {{-- continent optional --}}
                    <div class="mb-3">
                        <label for="continent_id_modal">Continent</label>
                        <select name="continent_id" id="continent_id_modal" class="form-control">
                            <option value="">-- Optional --</option>
                            @foreach($continents as $continent)
                                <option value="{{ $continent->id }}">{{ $continent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Country</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Trigger Toast --}}
<div id="errorToast"
     class="toast align-items-center text-bg-danger border-0 position-fixed bottom-0 end-0 m-3"
     role="alert"
     aria-live="assertive"
     aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body"></div>
    <button type="button"
            class="btn-close btn-close-white me-2 m-auto"
            data-bs-dismiss="toast"
            aria-label="Close"></button>
  </div>
</div>

{{-- City Modal (separate form) --}}
<div class="modal fade" id="addCityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addCityForm" method="POST" action="{{ route('cities.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add City</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="city_name">City Name</label>
                        <input type="text" name="name" id="city_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="city_country_id">Country</label>
                        <select name="country_id" id="city_country_id" class="form-control">
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save City</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Trigger Toast --}}
<div id="errorToastCity"
     class="toast align-items-center text-bg-danger border-0 position-fixed bottom-0 end-0 m-3"
     role="alert"
     aria-live="assertive"
     aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body"></div>
    <button type="button"
            class="btn-close btn-close-white me-2 m-auto"
            data-bs-dismiss="toast"
            aria-label="Close"></button>
  </div>
</div>

@endsection
