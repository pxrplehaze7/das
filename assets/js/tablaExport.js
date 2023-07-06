
$(document).ready(function () {
  var table_c = $('#total_contrata').DataTable({
    responsive: true,
    searching: true,
    paging: true,
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
    dom: 'lBfrtip',
    buttons: [
      {
        extend: 'excel',
        text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
        title: 'Trabajadores Registrados',
        filename: 'Trabajadores_Registrados',
        orientation: 'landscape',
        className: 'btn btn-dexcel btn-success',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6],
          title: 'Datos en Excel'
        }
      },
      {
        extend: 'pdf',
        text: '<i class="fas fa-file-pdf"></i> Exportar a PDF',
        title: 'Trabajadores Registrados',
        filename: 'Trabajadores_Registrados',
        orientation: 'landscape',
        className: 'btn btn-dpdf btn-danger',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6],
          title: 'Datos en PDF'
        },
        customize: function (doc) {
          doc.defaultStyle.alignment = 'center';
          doc.styles.tableHeader.alignment = 'center';
          doc.content[1].table.widths = ['14%', '14%', '14%', '14%', '14%', '16%', '14%']; // Establece el ancho de la columna 3 como 10%
          doc.defaultStyle.fontSize = 10;
          doc.styles.tableHeader.fontSize = 10;
          doc.styles.tableBodyEven.fontSize = 10;
          doc.styles.tableBodyOdd.fontSize = 10;
          doc.content[1].table.body[0].forEach(function (cell) {
            cell.fillColor = '#463bfa';
            cell.color = '#fafafa';
          });
        }
      }
    ]
  });


  table_c.buttons(['print']).remove();

  table_c.buttons().nodes().each(function (node) {
    $(node).removeClass('btn-default').addClass('btn-sm');
  });

  $('#total_contrata').on('buttons.export', function (e, button, config) {
    var updatedData = table_c.buttons.exportData(config);
    config.data = updatedData;
  });
  
});











$(document).ready(function () {
  var table = $('#totalUsuarios').DataTable({
    responsive: true,
    searching: true,
    paging: true,
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
    dom: 'lBfrtip',
    buttons: [
      {
        extend: 'excel',
        text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
        title: 'Usuarios Registrados',
        filename: 'Usuarios_Registrados',
        orientation: 'landscape',
        className: 'btn btn-dexcel btn-success',
        exportOptions: {
          columns: ':not(:last-child)', // Excluir la última columna
          title: 'Datos en Excel'
        }
      },
      {
        extend: 'pdf',
        text: '<i class="fas fa-file-pdf"></i> Exportar a PDF',
        title: 'Usuarios Registrados',
        filename: 'Usuarios_Registrados',
        orientation: 'portrait', // Cambiar a 'portrait' para modo retrato
        className: 'btn btn-dpdf btn-danger',
        exportOptions: {
          columns: [0, 1, 2, 3, 4],
          title: 'Datos en PDF'
        },
        customize: function (doc) {
          doc.defaultStyle.alignment = 'center';
          doc.styles.tableHeader.alignment = 'center';
          doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
          doc.defaultStyle.fontSize = 10;
          doc.styles.tableHeader.fontSize = 10;
          doc.styles.tableBodyEven.fontSize = 10;
          doc.styles.tableBodyOdd.fontSize = 10;
          doc.content[1].table.body[0].forEach(function (cell) {
            cell.fillColor = '#463bfa';
            cell.color = '#fafafa';
          });
        }
      }
    ]
  });

  table.buttons(['print']).remove();

  table.buttons().nodes().each(function (node) {
    $(node).removeClass('btn-default').addClass('btn-sm');
  });

  $('#totalUsuarios').on('buttons.export', function (e, button, config) {
    var updatedData = table.buttons.exportData(config);
    config.data = updatedData;
  });
});










$(document).ready(function () {
  var expirados = $('#expirados').DataTable({
    responsive: true,
    searching: true,
    paging: true,
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
    dom: 'lBfrtip',
    buttons: [
      {
        extend: 'excel',
        text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
        title: 'Decretos Finalizados',
        filename: 'Decretos Finalizados',
        orientation: 'landscape',
        className: 'btn btn-dexcel btn-success',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
          title: 'Lista de Decretos Finalizados'
        }
      },
      {
        extend: 'pdf',
        text: '<i class="fas fa-file-pdf"></i> Exportar a PDF',
        title: 'Decretos Finalizados',
        filename: 'Decretos Finalizados',
        orientation: 'landscape',
        className: 'btn btn-dpdf btn-danger',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
          title: 'Lista de Decretos Finalizados'
        },
        customize: function (doc) {
          doc.defaultStyle.alignment = 'left';
          doc.styles.tableHeader.alignment = 'left';
          doc.content[1].table.widths = ['11%', '7%', '12%', '10%', '10%', '10%', '15%', '15%', '10%'];
          doc.defaultStyle.fontSize = 10;
          doc.styles.tableHeader.fontSize = 10;
          doc.styles.tableBodyEven.fontSize = 10;
          doc.styles.tableBodyOdd.fontSize = 10;
          doc.content[1].table.body[0].forEach(function (cell) {
            cell.fillColor = '#B90101';
            cell.color = '#fafafa';

            // Agregar padding a la izquierda del texto
            cell.alignment = 'left';
            cell.margin = [2, 0, 0, 0];
          });
        }
      }
    ]
  });


  expirados.buttons(['print']).remove();

  expirados.buttons().nodes().each(function (node) {
    $(node).removeClass('btn-default').addClass('btn-sm');
  });

  $('#expirados').on('buttons.export', function (e, button, config) {
    var updatedData = expirados.buttons.exportData(config);
    config.data = updatedData;
  });
});




$(document).ready(function () {
  var vigentes = $('#vigentes').DataTable({
    responsive: true,
    searching: true,
    paging: true,
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
    dom: 'lBfrtip',
    buttons: [
      {
        extend: 'excel',
        text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
        title: 'Decretos Vigentes',
        filename: 'Decretos_Vigentes',
        orientation: 'landscape',
        className: 'btn btn-dexcel btn-success',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
          title: 'Lista de Decretos Vigentes'
        }
      },
      {
        extend: 'pdf',
        text: '<i class="fas fa-file-pdf"></i> Exportar a PDF',
        title: 'Decretos Vigentes',
        filename: 'Decretos_Vigentes',
        orientation: 'landscape',
        className: 'btn btn-dpdf btn-danger',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
          title: 'Lista de Decretos Vigentes'
        },
        customize: function (doc) {
          doc.defaultStyle.alignment = 'left';
          doc.styles.tableHeader.alignment = 'left';
          doc.content[1].table.widths = ['11%', '7%', '12%', '10%', '10%', '10%', '15%', '15%', '10%'];
          doc.defaultStyle.fontSize = 10;
          doc.styles.tableHeader.fontSize = 10;
          doc.styles.tableBodyEven.fontSize = 10;
          doc.styles.tableBodyOdd.fontSize = 10;
          doc.content[1].table.body[0].forEach(function (cell) {
            cell.fillColor = '#10BE00';
            cell.color = '#fafafa';

            // Agregar padding a la izquierda del texto
            cell.alignment = 'left';
            cell.margin = [2, 0, 0, 0];
          });
        }


      }
    ]
  });


  vigentes.buttons(['print']).remove();

  vigentes.buttons().nodes().each(function (node) {
    $(node).removeClass('btn-default').addClass('btn-sm');
  });
  $('#vigentes').on('buttons.export', function (e, button, config) {
    var updatedData = vigentes.buttons.exportData(config);
    config.data = updatedData;
  });
});



$(document).ready(function () {
  var pterminar = $('#pterminar').DataTable({
    responsive: true,
    searching: true,
    paging: true,
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
    dom: 'lBfrtip',
    buttons: [
      {
        extend: 'excel',
        text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
        title: 'Decretos por finalizar',
        filename: 'Decretos_por_finalizar',
        orientation: 'landscape',
        className: 'btn btn-dexcel btn-success',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
          title: 'Lista de Decretos por Finalizar'
        }
      },
      {
        extend: 'pdf',
        text: '<i class="fas fa-file-pdf"></i> Exportar a PDF',
        title: 'Decretos por finalizar',
        filename: 'Decretos_por_finalizar',
        orientation: 'landscape',
        className: 'btn btn-dpdf btn-danger',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
          title: 'Lista de Decretos por Finalizar'
        },
        customize: function (doc) {
          doc.defaultStyle.alignment = 'left';
          doc.styles.tableHeader.alignment = 'left';
          doc.content[1].table.widths = ['11%', '7%', '12%', '10%', '10%', '10%', '15%', '15%', '10%'];
          doc.defaultStyle.fontSize = 10;
          doc.styles.tableHeader.fontSize = 10;
          doc.styles.tableBodyEven.fontSize = 10;
          doc.styles.tableBodyOdd.fontSize = 10;
          doc.content[1].table.body[0].forEach(function (cell) {
            cell.fillColor = '#E76500';
            cell.color = '#fafafa';

            // Agregar padding a la izquierda del texto
            cell.alignment = 'left';
            cell.margin = [2, 0, 0, 0];
          });
        }
      }
    ]
  });


  pterminar.buttons(['print']).remove();

  pterminar.buttons().nodes().each(function (node) {
    $(node).removeClass('btn-default').addClass('btn-sm');
  });

  $('#pterminar').on('buttons.export', function (e, button, config) {
    var updatedData = pterminar.buttons.exportData(config);
    config.data = updatedData;
  });
});








$(document).ready(function () {
  var expiradosH = $('#expiradosH').DataTable({
    responsive: true,
    searching: true,
    paging: true,
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
    dom: 'lBfrtip',
    buttons: [
      {
        extend: 'excel',
        text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
        title: 'Decretos Finalizados',
        filename: 'Decretos Finalizados',
        orientation: 'landscape',
        className: 'btn btn-dexcel btn-success',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
          title: 'Lista de Decretos Finalizados'
        }
      },
      {
        extend: 'pdf',
        text: '<i class="fas fa-file-pdf"></i> Exportar a PDF',
        title: 'Decretos Finalizados',
        filename: 'Decretos Finalizados',
        orientation: 'landscape',
        className: 'btn btn-dpdf btn-danger',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
          title: 'Lista de Decretos Finalizados'
        },
        customize: function (doc) {
          doc.defaultStyle.alignment = 'left';
          doc.styles.tableHeader.alignment = 'left';
          doc.content[1].table.widths = ['11%', '7%', '12%', '10%', '10%', '10%', '15%', '15%', '10%'];
          doc.defaultStyle.fontSize = 10;
          doc.styles.tableHeader.fontSize = 10;
          doc.styles.tableBodyEven.fontSize = 10;
          doc.styles.tableBodyOdd.fontSize = 10;
          doc.content[1].table.body[0].forEach(function (cell) {
            cell.fillColor = '#B90101';
            cell.color = '#fafafa';

            // Agregar padding a la izquierda del texto
            cell.alignment = 'left';
            cell.margin = [2, 0, 0, 0];
          });
        }
      }
    ]
  });


  expiradosH.buttons(['print']).remove();

  expiradosH.buttons().nodes().each(function (node) {
    $(node).removeClass('btn-default').addClass('btn-sm');
  });

  $('#expiradosH').on('buttons.export', function (e, button, config) {
    var updatedData = expiradosH.buttons.exportData(config);
    config.data = updatedData;
  });
});




$(document).ready(function () {
  var vigentesH = $('#vigentesH').DataTable({
    responsive: true,
    searching: true,
    paging: true,
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
    dom: 'lBfrtip',
    buttons: [
      {
        extend: 'excel',
        text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
        title: 'Decretos Vigentes',
        filename: 'Decretos_Vigentes',
        orientation: 'landscape',
        className: 'btn btn-dexcel btn-success',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
          title: 'Lista de Decretos Vigentes'
        }
      },
      {
        extend: 'pdf',
        text: '<i class="fas fa-file-pdf"></i> Exportar a PDF',
        title: 'Decretos Vigentes',
        filename: 'Decretos_Vigentes',
        orientation: 'landscape',
        className: 'btn btn-dpdf btn-danger',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
          title: 'Lista de Decretos Vigentes'
        },
        customize: function (doc) {
          doc.defaultStyle.alignment = 'left';
          doc.styles.tableHeader.alignment = 'left';
          doc.content[1].table.widths = ['11%', '7%', '12%', '10%', '10%', '10%', '15%', '15%', '10%'];
          doc.defaultStyle.fontSize = 10;
          doc.styles.tableHeader.fontSize = 10;
          doc.styles.tableBodyEven.fontSize = 10;
          doc.styles.tableBodyOdd.fontSize = 10;
          doc.content[1].table.body[0].forEach(function (cell) {
            cell.fillColor = '#10BE00';
            cell.color = '#fafafa';

            // Agregar padding a la izquierda del texto
            cell.alignment = 'left';
            cell.margin = [2, 0, 0, 0];
          });
        }


      }
    ]
  });


  vigentesH.buttons(['print']).remove();

  vigentesH.buttons().nodes().each(function (node) {
    $(node).removeClass('btn-default').addClass('btn-sm');
  });
  $('#vigentesH').on('buttons.export', function (e, button, config) {
    var updatedData = vigentesH.buttons.exportData(config);
    config.data = updatedData;
  });
});



$(document).ready(function () {
  var pterminarH = $('#pterminarH').DataTable({
    responsive: true,
    searching: true,
    paging: true,
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
    dom: 'lBfrtip',
    buttons: [
      {
        extend: 'excel',
        text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
        title: 'Decretos por finalizar',
        filename: 'Decretos_por_finalizar',
        orientation: 'landscape',
        className: 'btn btn-dexcel btn-success',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
          title: 'Lista de Decretos por Finalizar'
        }
      },
      {
        extend: 'pdf',
        text: '<i class="fas fa-file-pdf"></i> Exportar a PDF',
        title: 'Decretos por finalizar',
        filename: 'Decretos_por_finalizar',
        orientation: 'landscape',
        className: 'btn btn-dpdf btn-danger',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
          title: 'Lista de Decretos por Finalizar'
        },
        customize: function (doc) {
          doc.defaultStyle.alignment = 'left';
          doc.styles.tableHeader.alignment = 'left';
          doc.content[1].table.widths = ['11%', '7%', '12%', '10%', '10%', '10%', '15%', '15%', '10%'];
          doc.defaultStyle.fontSize = 10;
          doc.styles.tableHeader.fontSize = 10;
          doc.styles.tableBodyEven.fontSize = 10;
          doc.styles.tableBodyOdd.fontSize = 10;
          doc.content[1].table.body[0].forEach(function (cell) {
            cell.fillColor = '#E76500';
            cell.color = '#fafafa';

            // Agregar padding a la izquierda del texto
            cell.alignment = 'left';
            cell.margin = [2, 0, 0, 0];
          });
        }
      }
    ]
  });


  pterminarH.buttons(['print']).remove();

  pterminarH.buttons().nodes().each(function (node) {
    $(node).removeClass('btn-default').addClass('btn-sm');
  });

  $('#pterminarH').on('buttons.export', function (e, button, config) {
    var updatedData = pterminarH.buttons.exportData(config);
    config.data = updatedData;
  });
});


















$(document).ready(function () {
  var decretosp = $('#decretosp').DataTable({
    responsive: true,
    searching: true,
    paging: true,
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
    dom: 'lBfrtip',
    buttons: [
      {
        extend: 'excel',
        text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
        title: 'Decretos del Trabajador',
        filename: 'Decretos_del_Trabajador',
        orientation: 'landscape',
        className: 'btn btn-dexcel btn-success',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7],
          title: 'Lista de Decretos del Trabajador'
        }
      },
      {
        extend: 'pdf',
        text: '<i class="fas fa-file-pdf"></i> Exportar a PDF',
        title: 'Decretos del Trabajador',
        filename: 'Decretos_del_Trabajador',
        orientation: 'landscape',
        className: 'btn btn-dpdf btn-danger',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7],
          title: 'Lista de Decretos del Trabajador'
        },
        customize: function (doc) {
          doc.defaultStyle.alignment = 'left';
          doc.styles.tableHeader.alignment = 'left';
          doc.content[1].table.widths = ['7%', '14%', '9%', '10%', '10%', '20%', '20%', '10%'];
          doc.defaultStyle.fontSize = 10;
          doc.styles.tableHeader.fontSize = 10;
          doc.styles.tableBodyEven.fontSize = 10;
          doc.styles.tableBodyOdd.fontSize = 10;
          doc.content[1].table.body[0].forEach(function (cell) {
            cell.fillColor = '#463bfa';
            cell.color = '#fafafa';

            // Agregar padding a la izquierda del texto
            cell.alignment = 'left';
            cell.margin = [2, 0, 0, 0];
          });
        }
      }
    ]
  });


  decretosp.buttons(['print']).remove();

  decretosp.buttons().nodes().each(function (node) {
    $(node).removeClass('btn-default').addClass('btn-sm');
  });

  $('#decretosp').on('buttons.export', function (e, button, config) {
    var updatedData = decretosp.buttons.exportData(config);
    config.data = updatedData;
  });
});











$(document).ready(function () {
  var decretosh = $('#decretosh').DataTable({
    responsive: true,
    searching: true,
    paging: true,
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
    dom: 'lBfrtip',
    buttons: [
      {
        extend: 'excel',
        text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
        title: 'Decretos por finalizar',
        filename: 'Decretos_por_finalizar',
        orientation: 'landscape',
        className: 'btn btn-dexcel btn-success',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7],
          title: 'Lista de Decretos por Finalizar'
        }
      },
      {
        extend: 'pdf',
        text: '<i class="fas fa-file-pdf"></i> Exportar a PDF',
        title: 'Decretos por finalizar',
        filename: 'Decretos_por_finalizar',
        orientation: 'landscape',
        className: 'btn btn-dpdf btn-danger',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7],
          title: 'Lista de Decretos por Finalizar'
        },
        customize: function (doc) {
          doc.defaultStyle.alignment = 'left';
          doc.styles.tableHeader.alignment = 'left';
          doc.content[1].table.widths = ['7%', '14%', '9%', '10%', '10%', '20%', '20%', '10%'];
          doc.defaultStyle.fontSize = 10;
          doc.styles.tableHeader.fontSize = 10;
          doc.styles.tableBodyEven.fontSize = 10;
          doc.styles.tableBodyOdd.fontSize = 10;
          doc.content[1].table.body[0].forEach(function (cell) {
            cell.fillColor = '#463bfa';
            cell.color = '#fafafa';

            // Agregar padding a la izquierda del texto
            cell.alignment = 'left';
            cell.margin = [2, 0, 0, 0];
          });
        }
      }
    ]
  });


  decretosh.buttons(['print']).remove();

  decretosh.buttons().nodes().each(function (node) {
    $(node).removeClass('btn-default').addClass('btn-sm');
  });

  $('#decretosh').on('buttons.export', function (e, button, config) {
    var updatedData = decretosh.buttons.exportData(config);
    config.data = updatedData;
  });
});











