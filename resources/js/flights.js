document.addEventListener('DOMContentLoaded', function () {
    const countrySelect = document.getElementById('country_id');
    const airlineSelect = document.getElementById('airline_id');
    const flightNumberInput = document.getElementById('flight_number');
    const iataDisplay = document.getElementById('iata_code_display');

    if (!countrySelect || !airlineSelect) return;

    let currentIata = '';

    // Load airlines by country
    countrySelect.addEventListener('change', function () {
        let countryName = this.options[this.selectedIndex].text;
        airlineSelect.innerHTML = '<option value="">Loading...</option>';

        if (!countryName) {
            airlineSelect.innerHTML = '<option value="">Select Airline</option>';
            return;
        }

        fetch('/airlines/by-country/' + encodeURIComponent(countryName))
            .then(response => response.json())
            .then(data => {
                airlineSelect.innerHTML = '<option value="">Select Airline</option>';
                data.forEach(airline => {
                    let opt = document.createElement('option');
                    opt.value = airline.id;
                    opt.text = airline.name;
                    opt.dataset.iata = airline.iata; // store IATA in option
                    airlineSelect.appendChild(opt);
                });
            })
            .catch(err => {
                console.error(err);
                airlineSelect.innerHTML = '<option value="">Error loading airlines</option>';
            });
    });

    // Update IATA prefix when airline selected
    airlineSelect.addEventListener('change', function () {
        let selectedOption = this.options[this.selectedIndex];
        currentIata = selectedOption.dataset.iata || 'XX';

        iataDisplay.textContent = currentIata;

        // Reset flight number field to empty (user will type digits)
        flightNumberInput.value = '';
    });

    // Concatenate IATA + typed number
    flightNumberInput.addEventListener('input', function () {
        if (!currentIata) return;

        // Strip any accidental duplicate prefix
        let rawNumber = this.value.replace(currentIata, '');
        this.value = currentIata + rawNumber;
    });
});
