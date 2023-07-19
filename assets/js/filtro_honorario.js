

$("#btn-filtro").on("click", function () {
    let datos = {
      cumple: $("#idSelectCumple").val(),
    }
    console.log(datos);
    $.ajax({
      url: "./controller/cargaTablaH.php",
      method: "POST",
      data: datos,
    })
      .done(function (data) {
        $('#honorarios_tbody').html(data);
  
        // ACTUALIZA LOS DATOS DE LA TABLA
        var table = $('#total_honorarios').DataTable();
        table.clear().rows.add($('#total_honorarios tbody tr')).draw();
      });
  });
  
  $("#limpia-filtro").on("click", function () {
    // RSTABLECE LOS VALORES DE LOS SELECT
  
    $("#idSelectCumple").val("");
    // RECARGA LA TABLA CON LOS REGISTROS
    $.ajax({
      url: "./controller/cargaTablaH.php",
      method: "POST",
      data: { cumple: ""},
    })
      .done(function (data) {
        $('#honorarios_tbody').html(data);
        // ACTUALIZA LOS DATOS DE LA TABLA
        var table = $('#total_honorarios').DataTable();
        table.clear().rows.add($('#total_honorarios tbody tr')).draw();
      });
  });