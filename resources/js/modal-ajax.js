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
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
          Accept: "application/json",
        },
      })
        .then((res) => {
          if (!res.ok) {
            return res.json().then((err) => Promise.reject(err));
          }
          return res.json();
        })
        .then((data) => {
          // ✅ normal success flow
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

          bootstrap.Modal.getInstance(
            document.getElementById("addCountryModal"),
          ).hide();
          this.reset();
        })
        .catch((err) => {
          console.error(err);

          const toastEl = document.getElementById("errorToast");
          if (toastEl) {
            // set the toast body text
            toastEl.querySelector(".toast-body").textContent =
              err.error || "Error saving country";

            // show the toast
            new bootstrap.Toast(toastEl).show();
          } else {
            // fallback if toast element not found
            alert(err.error || "Error saving country");
          }
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
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
          Accept: "application/json",
        },
      })
        .then((res) => {
          if (!res.ok) {
            return res.json().then((err) => Promise.reject(err));
          }
          return res.json();
        })
        .then((data) => {
          const countryId = document.getElementById(
            "departure_country_id",
          ).value;
          const citySelect = document.getElementById("departure_city_id");

          if (countryId && citySelect) {
            // Reload cities for the selected country
            fetch(`/cities/by-country/${countryId}`)
              .then((res) => res.json())
              .then((cities) => {
                citySelect.innerHTML = '<option value="">Select City</option>';
                cities.forEach((city) => {
                  const opt = document.createElement("option");
                  opt.value = city.id;
                  opt.text = city.name;
                  citySelect.appendChild(opt);
                });
                // auto‑select the newly added city
                citySelect.value = data.id;
              })
              .catch((err) => {
                console.error("Error reloading cities:", err);
                citySelect.innerHTML =
                  '<option value="">Error loading cities</option>';
              });
          }

          bootstrap.Modal.getInstance(
            document.getElementById("addCityModal"),
          ).hide();
          this.reset();
        })
        .catch((err) => {
          console.error(err);

          const toastEl = document.getElementById("errorToastCity");
          if (toastEl) {
            toastEl.querySelector(".toast-body").textContent =
              err.error || "Error saving city";
            new bootstrap.Toast(toastEl).show();
          } else {
            // fallback if toast element not found
            alert(err.error || "Error saving city");
          }
        });
    });
  }

  // Dynamic city loading
  const countrySelect = document.getElementById("departure_country_id");
  const citySelect = document.getElementById("departure_city_id");

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
        .catch((err) => {
          console.error(err);
          citySelect.innerHTML =
            '<option value="">Error loading cities</option>';
        });
    });
  }

  // 🔧 Auto‑select country in City modal
  const cityModal = document.getElementById("addCityModal");
  if (cityModal && countrySelect) {
    cityModal.addEventListener("show.bs.modal", () => {
      const modalCountrySelect = cityModal.querySelector("#city_country_id");
      if (modalCountrySelect) {
        modalCountrySelect.value = countrySelect.value;
      }
    });
  }
});
