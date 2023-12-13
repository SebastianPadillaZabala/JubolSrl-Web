
var minDate, maxDate;
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
    var min = minDate.val();
    var max = maxDate.val();
    var date = new Date(data[1]);

    if (
        (min === null && max === null) ||
        (min === null && date <= max) ||
        (min <= date && max === null) ||
        (min <= date && date <= max)
    ) {
        return true;
    }
    return false;
});

$(document).ready(function () {
    // Create date inputs
    minDate = new DateTime($("#min"), {
        format: "MMMM Do YYYY",
    });
    maxDate = new DateTime($("#max"), {
        format: "MMMM Do YYYY",
    });
    // DataTables initialisation
    var table = $("#example").DataTable({
        buttons: [ "excel", "pdf", "print"],
        paging: true,
        ordering: true,
        info: true,
        responsive: true,
        autoWidth: false,
        pagingType: "full_numbers",
        language: {
            lengthMenu:
                'Mostrar <select class = "custom-select form-select form-select-sm">' +
                '<option value="10">10</option>' +
                '<option value="25">25</option>' +
                '<option value="50">50</option>' +
                '<option value="-1">Todos</option>' +
                "</select> registros",
            zeroRecords: "No existen resultados",
            info: "Mostrando _PAGE_ de _PAGES_",
            infoEmpty: "No hay resultados",
            infoFiltered: "(filtrado de _MAX_ total registros totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior",
            },
        },
    });
     // Refilter the table
     $('#min, #max').on('change', function () {
      table.draw();
  });

    table.buttons().container().appendTo("#example_wrapper .col-md-6:eq(0)");
});




