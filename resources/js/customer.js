$(document).ready(function () {
  // Add customer
  $("#addCustomerForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: $(this).attr("action"),
      method: "POST",
      data: $(this).serialize(),
      success: function (response) {
        $("#customerModal").modal("hide");
        $("#addCustomerForm")[0].reset();

        // Prepend new customer card
        $("#customerList").prepend(`
          <div class="card mb-2 customer-item">
              <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                      <strong>${data.full_name}</strong><br>
                      ${data.email}
                  </div>
                  <div>
                      <a href="/customers/${data.id}" class="btn btn-info btn-sm">View</a>
                      <a href="/customers/${data.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                  </div>
              </div>
          </div>
        `);

        // Update dropdown in booking form
        $("#customerDropdown").append(
          `<option value="${response.id}" selected>${response.full_name}</option>`
        );
      },
      error: function (xhr) {
        alert("Error saving customer: " + xhr.responseText);
      },
    });
  });

  // 🔗 Enganchar dropdown: al seleccionar un cliente, mostrar su tarjeta
  $("#customerDropdown").on("change", function () {
    const customerId = $(this).val();
    if (!customerId) {
      $("#customerList").html("");
      return;
    }

    $.ajax({
      url: `/customers/${customerId}`, // asegúrate de tener esta ruta que devuelva JSON
      method: "GET",
      success: function (data) {
        $("#customerList").html(`
          <div class="card mb-2 customer-item">
              <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                      <strong>${data.full_name}</strong><br>
                      ${data.email}
                  </div>
                  <div>
                      <a href="/customers/${data.id}" class="btn btn-info btn-sm">View</a>
                      <a href="/customers/${data.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                  </div>
              </div>
          </div>
        `);
      },
      error: function (xhr) {
        console.error("Error loading customer:", xhr.responseText);
      },
    });
  });
});
