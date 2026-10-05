$(document).ready(function () {
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
                      <strong>${response.full_name}</strong><br>
                      ${response.email}
                  </div>
                  <div>
                      <a href="/customers/${response.id}" class="btn btn-info btn-sm">View</a>
                      <a href="/customers/${response.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                  </div>
              </div>
          </div>
        `);

        // Update dropdown in booking form
        $("#customerDropdown").append(
          `<option value="${response.id}" selected>${response.full_name}</option>`
        );

        // Refresh Assign Customer modal list
        reloadCustomers(response.id);
      },
      error: function (xhr) {
        alert("Error saving customer: " + xhr.responseText);
      },
    });
  });
});
