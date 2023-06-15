
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
            columns: ':visible',
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
            columns: ':visible',
            title: 'Datos en PDF'
          },
          customize: function(doc) {
            doc.defaultStyle.alignment = 'center';
            doc.styles.tableHeader.alignment = 'center';
            doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
            doc.defaultStyle.fontSize = 10;
            doc.styles.tableHeader.fontSize = 10;
            doc.styles.tableBodyEven.fontSize = 10;
            doc.styles.tableBodyOdd.fontSize = 10;
            doc.content[1].table.body[0].forEach(function(cell) {
              cell.fillColor = '#463bfa';
              cell.color = '#fafafa';
            });
          }
        }
      ]
    });
  
    table.buttons(['print']).remove();
  
    table.buttons().nodes().each(function(node) {
      $(node).removeClass('btn-default').addClass('btn-sm');
    });
  
    $('#total').on('buttons.export', function(e, button, config) {
      var updatedData = table.buttons.exportData(config);
      config.data = updatedData;
    });
  });
  


  
$(document).ready(function() {
  var table = $('#totalUsuarios').DataTable({
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
          columns: ':not(:last-child)', // Excluir la última columna
          title: 'Datos en PDF'
        },
        customize: function(doc) {
          doc.defaultStyle.alignment = 'center';
          doc.styles.tableHeader.alignment = 'center';
          doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
          doc.defaultStyle.fontSize = 10;
          doc.styles.tableHeader.fontSize = 10;
          doc.styles.tableBodyEven.fontSize = 10;
          doc.styles.tableBodyOdd.fontSize = 10;
          doc.content[1].table.body[0].forEach(function(cell) {
            cell.fillColor = '#463bfa';
            cell.color = '#fafafa';
          });
        }
      }
    ]
  });

  table.buttons(['print']).remove();

  table.buttons().nodes().each(function(node) {
    $(node).removeClass('btn-default').addClass('btn-sm');
  });

  $('#totalUsuarios').on('buttons.export', function(e, button, config) {
    var updatedData = table.buttons.exportData(config);
    config.data = updatedData;
  });
});

