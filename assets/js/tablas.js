
$(document).ready(function() {
    $('#myTable').DataTable({
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





// $(document).ready(function() {
//     $('#total').DataTable({
//         responsive: true,
//         searching: true,
//         language: {
//             "sEmptyTable": "No se encontraron datos disponibles en la tabla",
//             "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
//             "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
//             "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
//             "sInfoPostFix": "",
//             "sInfoThousands": ",",
//             "sLengthMenu": "Mostrar _MENU_ registros",
//             "sLoadingRecords": "Cargando...",
//             "sProcessing": "Procesando...",
//             "sSearch": "Buscar:",
//             "sZeroRecords": "No se encontraron registros coincidentes",
//             "oPaginate": {
//                 "sFirst": "Primero",
//                 "sLast": "Último",
//                 "sNext": "Siguiente",
//                 "sPrevious": "Anterior"
//             },
//             "oAria": {
//                 "sSortAscending": ": activar para ordenar la columna de manera ascendente",
//                 "sSortDescending": ": activar para ordenar la columna de manera descendente"
//             }
//         },
//         dom: 'Bfrtip',
//         buttons: [
//             'excel', 'pdf', 'print'
//         ]
//     });
// });



$(document).ready(function() {
    var table = $('#total').DataTable({
      responsive: true,
      searching: true,
      paging: false,
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
    },
      dom: 'lBfrtip', // Mueve la barra de búsqueda a la izquierda
      buttons: [
        {
          extend: 'excel',
          text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
          className: 'btn btn-success',
          exportOptions: {
            columns: ':visible',
            title: 'Datos en Excel' // Cambia el título del documento de Excel
          }
        },
        {
          extend: 'pdf',
          text: '<i class="fas fa-file-pdf"></i> Exportar a PDF',
          className: 'btn btn-danger',
          exportOptions: {
            columns: ':visible',
            title: 'Datos en PDF' // Cambia el título del documento de PDF
          }
        },
        {
          extend: 'print',
          text: '<i class="fas fa-print"></i> Imprimir',
          className: 'btn btn-primary',
          exportOptions: {
            columns: ':visible',
            title: 'Impresión' // Cambia el título del documento de impresión
          }
        }
      ]
    });
  
    table.buttons().nodes().each(function(node) {
      $(node).removeClass('btn-default').addClass('btn-sm');
    });
  });