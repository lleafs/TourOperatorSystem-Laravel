// public/js/modal-ajax.js

document.addEventListener('DOMContentLoaded', () => {
    // Country form
    const countryForm = document.getElementById('addCountryForm');
    if (countryForm) {
        countryForm.addEventListener('submit', function(e) {
            e.preventDefault();

            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            })
            .then(res => res.json())
            .then(data => {
                // Inject new country into dropdown
                const select = document.getElementById('departure_country_id');
                if (select) {
                    const opt = document.createElement('option');
                    opt.value = data.id;
                    opt.text = data.name;
                    opt.selected = true;
                    select.appendChild(opt);
                }

                // Close modal
                bootstrap.Modal.getInstance(document.getElementById('addCountryModal')).hide();
                this.reset();
            })
            .catch(err => console.error(err));
        });
    }

    // City form
    const cityForm = document.getElementById('addCityForm');
    if (cityForm) {
        cityForm.addEventListener('submit', function(e) {
            e.preventDefault();

            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            })
            .then(res => res.json())
            .then(data => {
                // Inject new city into dropdown
                const select = document.getElementById('departure_city_id');
                if (select) {
                    const opt = document.createElement('option');
                    opt.value = data.id;
                    opt.text = data.name;
                    opt.selected = true;
                    select.appendChild(opt);
                }

                bootstrap.Modal.getInstance(document.getElementById('addCityModal')).hide();
                this.reset();
            })
            .catch(err => console.error(err));
        });
    }
    // Dynamic city loading
    const countrySelect = document.getElementById('departure_country_id');
    const citySelect = document.getElementById('departure_city_id');

    if (countrySelect && citySelect) {
        countrySelect.addEventListener('change', function () {
            const countryId = this.value;
            citySelect.innerHTML = '<option value="">Loading...</option>';

            if (!countryId) {
                citySelect.innerHTML = '<option value="">Select City</option>';
                return;
            }

            fetch(`/cities/by-country/${countryId}`)
                .then(res => res.json())
                .then(data => {
                    citySelect.innerHTML = '<option value="">Select City</option>';
                    data.forEach(city => {
                        const opt = document.createElement('option');
                        opt.value = city.id;
                        opt.text = city.name;
                        citySelect.appendChild(opt);
                    });
                })
                .catch(err => {
                    console.error(err);
                    citySelect.innerHTML = '<option value="">Error loading cities</option>';
                });
        });
    }
});
