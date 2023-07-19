

$("#btn-filtro").on("click", function () {
    let datos = {
      cumple: $("#idSelectCumple").val(),
    }
    console.log(datos);
    $.ajax({
      url: "./controller/cargaTabla.php",
      method: "POST",
      data: datos,
    })
      .done(function (data) {
        $('#trabajadores_tbody').html(data);
  
        // ACTUALIZA LOS DATOS DE LA TABLA
        var table = $('#total_contrata').DataTable();
        table.clear().rows.add($('#total_contrata tbody tr')).draw();
      });
  });
  
  $("#limpia-filtro").on("click", function () {
    // RSTABLECE LOS VALORES DE LOS SELECT
  
    $("#idSelectCumple").val("");
    // RECARGA LA TABLA CON LOS REGISTROS
    $.ajax({
      url: "./controller/cargaTabla.php",
      method: "POST",
      data: { cumple: ""},
    })
      .done(function (data) {
        $('#trabajadores_tbody').html(data);
        // ACTUALIZA LOS DATOS DE LA TABLA
        var table = $('#total_contrata').DataTable();
        table.clear().rows.add($('#total_contrata tbody tr')).draw();
      });
  });