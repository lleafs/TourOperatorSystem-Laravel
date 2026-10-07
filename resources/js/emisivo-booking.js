// public/js/emisivo-booking.js
document.addEventListener("DOMContentLoaded", function () {
    const countrySelect = document.getElementById("departure_country_id");
    const citySelect = document.getElementById("departure_city_id");
    const airportSelect = document.getElementById("airport_id");
    const flightSelect = document.getElementById("flight_id");

    // Load cities when country changes
    if (countrySelect && citySelect) {
        countrySelect.addEventListener("change", function () {
            const countryId = this.value;
            citySelect.innerHTML = '<option value="">Loading...</option>';

            if (!countryId) {
                citySelect.innerHTML = '<option value="">Select City</option>';
                return;
            }

            fetch(`/cities/by-country/${countryId}`)
                .then((res) => res.json())
                .then((data) => {
                    citySelect.innerHTML = '<option value="">Select City</option>';
                    data.forEach((city) => {
                        const opt = document.createElement("option");
                        opt.value = city.id;
                        opt.text = city.name;
                        citySelect.appendChild(opt);
                    });
                })
                .catch(() => {
                    citySelect.innerHTML =
                        '<option value="">Error loading cities</option>';
                });
        });
    }

    // Load airports when city changes
    if (citySelect && airportSelect) {
        citySelect.addEventListener("change", function () {
            const cityId = this.value;
            airportSelect.innerHTML = '<option value="">Loading...</option>';

            if (!cityId) {
                airportSelect.innerHTML = '<option value="">Select Airport</option>';
                return;
            }

            fetch(`/airports/by-city/${cityId}`)
                .then((res) => res.json())
                .then((data) => {
                    airportSelect.innerHTML = '<option value="">Select Airport</option>';
                    data.forEach((airport) => {
                        const opt = document.createElement("option");
                        opt.value = airport.id;
                        opt.text = airport.name;
                        airportSelect.appendChild(opt);
                    });
                })
                .catch(() => {
                    airportSelect.innerHTML =
                        '<option value="">Error loading airports</option>';
                });
        });
    }

    // Load flights when airport changes
    if (airportSelect && flightSelect) {
        airportSelect.addEventListener("change", function () {
            const airportId = this.value;
            flightSelect.innerHTML = '<option value="">Loading...</option>';

            if (!airportId) {
                flightSelect.innerHTML = '<option value="">Select Flight</option>';
                return;
            }

            fetch(`/flights/by-airport/${airportId}`)
                .then((res) => res.json())
                .then((data) => {
                    flightSelect.innerHTML = '<option value="">Select Flight</option>';
                    data.forEach((flight) => {
                        const opt = document.createElement("option");
                        opt.value = flight.id;
                        opt.text = `${flight.flight_number} (${flight.origin} → ${flight.destination})`;
                        flightSelect.appendChild(opt);
                    });
                })
                .catch(() => {
                    flightSelect.innerHTML =
                        '<option value="">Error loading flights</option>';
                });
        });
    }
});
