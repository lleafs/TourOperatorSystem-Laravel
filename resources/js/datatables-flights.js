// public/js/datatables-flights.js
$(document).ready(function() {
    $('#flightsTable').DataTable({
        pageLength: 10,
        order: [[3, 'asc']], // sort by Scheduled Time ascending
        columnDefs: [
            { orderable: false, targets: 6 } // disable sorting on Actions column
        ]
    });
});
