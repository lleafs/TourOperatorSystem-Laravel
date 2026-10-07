// public/js/datatables-emisivo-booking.js
$(document).ready(function() {
    $('#EmisivoBookingTable').DataTable({
        pageLength: 10,
        order: [[3, 'asc']], // sort by Scheduled Time ascending
        columnDefs: [
            { orderable: false, targets: 6 } // disable sorting on Actions column
        ]
    });
});
