

$("#btn-filtro").on("click", function () {
    let datos = {
        lugar: $("#idSelectLugar").val(),
        sector: $("#idSelectSector").val(),
    }
    console.log(datos);
    $.ajax({
        url: "./controller/filtros_decretos/carga_pterminarCon.php",
        method: "POST",
      data: datos,
    })
      .done(function (data) {
        $('#pterminar_tbody').html(data);
  
        // ACTUALIZA LOS DATOS DE LA TABLA
        var table = $('#pterminar').DataTable();
        table.clear().rows.add($('#pterminar tbody tr')).draw();
      });
  });
  
  $("#limpia-filtro").on("click", function () {
    // RSTABLECE LOS VALORES DE LOS SELECT
  
    $("#idSelectLugar").val(0);
    $("#idSelectSector").val(0);
    $("#idSelectSector").html("<option value='0' hidden> Selecciona</option>");

    $.ajax({
      url: "./controller/filtros_decretos/carga_pterminarCon.php",
      method: "POST",
      data: { lugar: 0, sector: 0 },
    })
      .done(function (data) {
        $('#pterminar_tbody').html(data);
        // ACTUALIZA LOS DATOS DE LA TABLA
        var table = $('#pterminar').DataTable();
        table.clear().rows.add($('#pterminar tbody tr')).draw();
      });
  });







  

$("#btn-filtro").on("click", function () {
    let datos = {
        lugar: $("#idSelectLugar").val(),
        sector: $("#idSelectSector").val(),
    }
    console.log(datos);
    $.ajax({
        url: "./controller/filtros_decretos/carga_pterminarCon.php",
        method: "POST",
      data: datos,
    })
      .done(function (data) {
        $('#vigentes_tbody').html(data);
  
        // ACTUALIZA LOS DATOS DE LA TABLA
        var table = $('#vigentes').DataTable();
        table.clear().rows.add($('#vigentes tbody tr')).draw();
      });
  });
  
  $("#limpia-filtro").on("click", function () {
    // RSTABLECE LOS VALORES DE LOS SELECT
  
    $("#idSelectLugar").val(0);
    $("#idSelectSector").val(0);
    $("#idSelectSector").html("<option value='0' hidden> Selecciona</option>");

    $.ajax({
      url: "./controller/filtros_decretos/carga_pterminarCon.php",
      method: "POST",
      data: { lugar: 0, sector: 0 },
    })
      .done(function (data) {
        $('#vigentes_tbody').html(data);
        // ACTUALIZA LOS DATOS DE LA TABLA
        var table = $('#vigentes').DataTable();
        table.clear().rows.add($('#vigentes tbody tr')).draw();
      });
  });




