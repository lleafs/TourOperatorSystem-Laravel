@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
<div class="container">
    <h1>Create Booking</h1>

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        {{-- Booking Info --}}
        <div class="mb-3">
            <label for="agency_id">Agency</label>
            <select name="agency_id" class="form-control" required>
                @foreach($agencies as $agency)
                <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="booking_date">Booking Date</label>
                <input type="date" name="booking_date" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="status">Status</label>
                <select name="status" class="form-control">
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
                <input type="text" name="customer_name" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="customer_email">Customer Email</label>
                <input type="email" name="customer_email" class="form-control" required>
            </div>
        </div>

        {{-- Geography --}}
        <div class="mb-3">
            <label for="continent_id">Continent</label>
            <select id="continent_id" name="continent_id" class="form-control" required>
                <option value="">Select Continent</option>
                @foreach($continents as $continent)
                <option value="{{ $continent->id }}">{{ $continent->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="country_id">Country</label>
            <div class="input-group">
                <select id="country_id" name="country_id" class="form-control" required>
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addCountryModal">
                    Add Country
                </button>
            </div>
        </div>
        <!-- Country Modal -->
        <div class="modal fade" id="addCountryModal" tabindex="-1" aria-labelledby="addCountryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addCountryForm" method="POST" action="{{ route('countries.store') }}" novalidate> @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCountryModalLabel">Add Country</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="country_name">Country Name</label>
                                <input type="text" name="name" id="country_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="continent_id">Continent</label>
                                <select name="continent_id" id="continent_id" class="form-control" required>
                                    @foreach($continents as $continent)
                                    <option value="{{ $continent->id }}">{{ $continent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Country</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('addCountryForm').addEventListener('submit', function(e) {
                e.preventDefault(); // stop full form submission

                let form = this;

                fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Add new country to dropdown
                        let countrySelect = document.getElementById('country_id');
                        countrySelect.innerHTML += `<option value="${data.id}" selected>${data.name}</option>`;

                        // Close modal
                        var modal = bootstrap.Modal.getInstance(document.getElementById('addCountryModal'));
                        modal.hide();

                        // Reset modal form
                        form.reset();
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>


        <div class="mb-3">
            <label for="city_id">City</label>
            <select id="city_id" name="city_id" class="form-control" required>
                <option value="">Select City</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="hotel_id">Hotel</label>
            <select name="hotel_id" class="form-control">
                <option value="">None</option>
                @foreach($hotels as $hotel)
                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="travel_date">Travel Date</label>
            <input type="date" name="travel_date" class="form-control" required>
        </div>

        {{-- Relationships --}}
        <div class="mb-3">
            <label for="voucher_id">Voucher</label>
            <select name="voucher_id" class="form-control">
                <option value="">None</option>
                @foreach($vouchers as $voucher)
                <option value="{{ $voucher->id }}">{{ $voucher->code }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="flight_id">Flight</label>
            <select name="flight_id" class="form-control">
                <option value="">None</option>
                @foreach($flights as $flight)
                <option value="{{ $flight->id }}">{{ $flight->route }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="total_amount">Total Amount</label>
            <input type="number" step="0.01" name="total_amount" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Booking</button>
        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

{{-- Dynamic Dropdowns --}}
<script>
    document.getElementById('continent_id').addEventListener('change', function() {
        let continentId = this.value;
        let countrySelect = document.getElementById('country_id');
        countrySelect.innerHTML = '<option value="">Loading...</option>';

        fetch('/countries-by-continent/' + continentId)
            .then(response => response.json())
            .then(data => {
                countrySelect.innerHTML = '<option value="">Select Country</option>';
                data.forEach(country => {
                    countrySelect.innerHTML += `<option value="${country.id}">${country.name}</option>`;
                });
            });
    });

    document.getElementById('country_id').addEventListener('change', function() {
        let countryId = this.value;
        let citySelect = document.getElementById('city_id');
        citySelect.innerHTML = '<option value="">Loading...</option>';

        fetch('/cities-by-country/' + countryId)
            .then(response => response.json())
            .then(data => {
                citySelect.innerHTML = '<option value="">Select City</option>';
                data.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                });
            });
    });
</script>
@endsection