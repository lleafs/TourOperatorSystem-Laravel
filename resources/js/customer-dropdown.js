$(document).ready(function () {
  $("#customerDropdown").on("change", function () {
    const customerId = $(this).val();
    if (!customerId) {
      $("#customerList").html("");
      return;
    }

    $.ajax({
      url: `/customers/${customerId}`,
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
