// public/js/modal-ajax.js

document.addEventListener("DOMContentLoaded", () => {
  // Country form
  const countryForm = document.getElementById("addCountryForm");
  if (countryForm) {
    countryForm.addEventListener("submit", function (e) {
      e.preventDefault();

      fetch(this.action, {
        method: "POST",
        body: new FormData(this),
        headers: {
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
          Accept: "application/json",
        },
      })
        .then((res) => res.json())
        .then((data) => {
          const bookingSelect = document.getElementById("departure_country_id");
          const cityModalSelect = document.getElementById("city_country_id");

          [bookingSelect, cityModalSelect].forEach((sel) => {
            if (sel) {
              const opt = document.createElement("option");
              opt.value = data.id;
              opt.text = data.name;
              opt.selected = true;
              sel.appendChild(opt);
            }
          });

          bootstrap.Modal.getInstance(document.getElementById("addCountryModal")).hide();
          this.reset();
        })
        .catch((err) => {
          console.error(err);
          alert(err.error || "Error saving country");
        });
    });
  }

  // City form
  const cityForm = document.getElementById("addCityForm");
  if (cityForm) {
    cityForm.addEventListener("submit", function (e) {
      e.preventDefault();

      fetch(this.action, {
        method: "POST",
        body: new FormData(this),
        headers: {
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
          Accept: "application/json",
        },
      })
        .then((res) => res.json())
        .then((data) => {
          const countryId = document.getElementById("departure_country_id").value;
          const citySelect = document.getElementById("departure_city_id");

          if (countryId && citySelect) {
            fetch(`/cities/by-country/${countryId}`)
              .then((res) => res.json())
              .then((cities) => {
                citySelect.innerHTML = '<option value="">Select City</option>';
                cities.forEach((city) => {
                  const opt = document.createElement("option");
                  opt.value = city.name;   // use city name as value
                  opt.text = city.name;
                  citySelect.appendChild(opt);
                });
                citySelect.value = data.name; // auto-select new city by name
              })
              .catch((err) => {
                console.error("Error reloading cities:", err);
                citySelect.innerHTML = '<option value="">Error loading cities</option>';
              });
          }

          bootstrap.Modal.getInstance(document.getElementById("addCityModal")).hide();
          this.reset();
        })
        .catch((err) => {
          console.error(err);
          alert(err.error || "Error saving city");
        });
    });
  }

  // Dynamic city → airport loading
  const countrySelect = document.getElementById("departure_country_id");
  const citySelect = document.getElementById("departure_city_id");
  const airportSelect = document.getElementById("airport_id");

  if (countrySelect && citySelect && airportSelect) {
    // Load cities when country changes
    countrySelect.addEventListener("change", function () {
      const countryId = this.value;
      citySelect.innerHTML = '<option value="">Loading...</option>';
      airportSelect.innerHTML = '<option value="">Select Airport</option>';

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
            opt.value = city.name;   // use name instead of id
            opt.text = city.name;
            citySelect.appendChild(opt);
          });
        })
        .catch((err) => {
          console.error(err);
          citySelect.innerHTML = '<option value="">Error loading cities</option>';
        });
    });

    // Load airports when city changes
    citySelect.addEventListener("change", function () {
      const cityName = this.value;
      airportSelect.innerHTML = '<option value="">Loading...</option>';

      if (!cityName) {
        airportSelect.innerHTML = '<option value="">Select Airport</option>';
        return;
      }

      fetch(`/airports/by-city/${encodeURIComponent(cityName)}`)
        .then((res) => res.json())
        .then((data) => {
          airportSelect.innerHTML = '<option value="">Select Airport</option>';

          if (!Array.isArray(data) || data.length === 0) {
            airportSelect.innerHTML = '<option value="">No airports found</option>';
            return;
          }

          data.forEach((airport) => {
            const opt = document.createElement("option");
            opt.value = airport.id;
            opt.text = `${airport.name} (${airport.iata})`;
            airportSelect.appendChild(opt);
          });
        })
        .catch((err) => {
          console.error("Error loading airports:", err);
          airportSelect.innerHTML = '<option value="">Error loading airports</option>';
        });
    });

    // Auto‑select country in City modal
    const cityModal = document.getElementById("addCityModal");
    if (cityModal && countrySelect) {
      cityModal.addEventListener("show.bs.modal", () => {
        const modalCountrySelect = cityModal.querySelector("#city_country_id");
        if (modalCountrySelect) {
          modalCountrySelect.value = countrySelect.value;
        }
      });
    }
  }
});
