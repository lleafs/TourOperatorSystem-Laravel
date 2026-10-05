function reloadCustomers(preselectId = null) {
  $.get("/customers", function (data) {
    let select = $("#assignCustomerSelect");
    select.empty();

    data.forEach(function (customer) {
      select.append(
        `<option value="${customer.id}" ${
          preselectId == customer.id ? "selected" : ""
        }>${customer.full_name}</option>`,
      );
    });
  });
}

$(document).ready(function () {
  // Refresh list whenever Assign Customer modal opens
  $("#assignCustomerModal").on("show.bs.modal", function () {
    reloadCustomers();
  });

  // Handle assign customer form submission
  $("#assignCustomerForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: $(this).attr("action"),
      method: "POST",
      data: $(this).serialize(),
      success: function (response) {
        if (response.success) {
          $("#assignCustomerModal").modal("hide");

          // Append new customer to show.blade list instantly
          $("#customerList").append(`
      <li class="list-group-item">
        <span><strong>${response.customer.full_name}</strong> — ${response.customer.email}</span>
      </li>
    `);
        }
      },
      error: function (xhr) {
        alert("Error assigning customer: " + xhr.responseText);
      },
    });
  });
});
