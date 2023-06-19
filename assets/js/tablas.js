
$(document).ready(function() {
    $('#myTable').DataTable({
        language: {
            "sEmptyTable": "No se encontraron datos disponibles en la tabla",
            "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sLoadingRecords": "Cargando...",
            "sProcessing": "Procesando...",
            "sSearch": "Buscar: ",
            "sZeroRecords": "No se encontraron registros coincidentes"
        },
        dom: 'frt',
        paging: false, // Deshabilitar paginación
        order: [],
        columnDefs: [{
            targets: '_all',
            orderable: false
        }]
    });
});


$(document).ready(function() {
    $('#docs').DataTable({
        language: {
            "sEmptyTable": "No se encontraron datos disponibles en la tabla",
            "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sLoadingRecords": "Cargando...",
            "sProcessing": "Procesando...",
            "sSearch": "Buscar: ",
            "sZeroRecords": "No se encontraron registros coincidentes"
        },
        dom: 'frt',
        paging: false, // Deshabilitar paginación
        order: [],
        columnDefs: [{
            targets: '_all',
            orderable: false
        }]
    });
});


$(document).ready(function() {
    $('#anteriores').DataTable({
        language: {
            "sEmptyTable": "No se encontraron datos disponibles en la tabla",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sLoadingRecords": "Cargando...",
            "sProcessing": "Procesando...",
            "sSearch": "Buscar:",
            "sZeroRecords": "No se encontraron registros coincidentes",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": activar para ordenar la columna de manera descendente"
            }
        }
    });
});


$(document).ready(function() {
    $('#docsEDIT').DataTable({
        language: {
            "sEmptyTable": "No se encontraron datos disponibles en la tabla",
            "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sLoadingRecords": "Cargando...",
            "sProcessing": "Procesando...",
            "sSearch": "Buscar: ",
            "sZeroRecords": "No se encontraron registros coincidentes"
        },
        dom: 'frt',
        paging: false, // Deshabilitar paginación
        order: [],
        columnDefs: [{
            targets: '_all',
            orderable: false
        }]
    });
});





