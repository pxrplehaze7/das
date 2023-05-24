// jquery
$("#documentosObligatorios").on("submit", function (event) {
  console.log("ola");
  // alert( "Handler for `submit` called." );
  event.preventDefault();


  //SELECCIONA EL ELEMENTO  DEL HTML CON EL tCon Y LO ASIGNA A LA VARIABLE selectCat
  let selectCat = document.querySelector('#idSelectCat');
  if (selectCat.value == 1) {
    //SI EL VALOR ES IGUAL A 1 REVISA SI LOS INPUT RADIO ESTAN VACIOS
    if (!document.querySelector('#idSiMedico').checked && !document.querySelector('#idNoMedico').checked) {
      //SI ESTAN VACIOS ENVIA ALERTA
      alert('Debe indicar si es medico o no')
      return
    }
  }

  var radios = document.querySelectorAll('input[type="radio"]');



  let formData = new FormData(this);

  formData.append('rut', $('#idRutInput').val()); // Agrega el valor del input de tipo texto



  console.log(formData);

  $.ajax({
    url: "./controller/addPersonal.php",
    method: "POST",
    data: formData,
    cache: false,
    contentType: false,
    processData: false
  }).done(function (data) {
    //   $( this ).addClass( "done" );
    //console.log(data)
    $('body').append(data);
  });

});

// FUNCION QUE VERIFICA SI EL RUT A REGISTRAR YA ESTA INGRESADO
$(document).ready(function () {
  $('#idRutInput').on('blur', function () {
    var rut = $(this).val();

    if (rut.trim() !== '') {
      if (rut.length === 10 || rut.length === 9) { // Agrega esta condición para validar la longitud del RUT
        $.ajax({
          url: './controller/check_rut.php',
          type: 'POST',
          data: { rut: rut },
          success: function (response) {
            $('#rut-validation').html(response);
          }
        });
      } else {
        $('#rut-validation').html('El RUT debe ir sin puntos y con guión');
      }
    }
  });
});



// FUNCION PARA LIMPIAR EL INPUT FILE
function clearFileInput(inputId) {
  var fileInput = document.getElementById(inputId);
  fileInput.value = "";
}


//FUNCION QUE CARGA SECTOR SEGUN ID LUGAR
function cargarSectores() {
  const lugarSeleccionado = document.getElementById("idSelectLugar").value;
  $.ajax({

    url: './controller/lugar_sector.php',
    method: "POST",
    data: { lugarSeleccionado: lugarSeleccionado },
    dataType: 'json',
    success: function (respuesta) {
      let largo = respuesta.length;
      $("#idSelectSector").empty();

      $("#idSelectSector").append("<option hidden='hidden' disabled selected>Seleccione</option>")
      for (let i = 0; i < largo; i++) {
        let idSector = respuesta[i]['IDSector'];
        let nombreSector = respuesta[i]['NombreSector'];

        $("#idSelectSector").append("<option value='" + idSector + "'>" + nombreSector + "</option>");
      }
    },
    error: function (error) {
      console.error("ERROR", error.responseText)
    }
  });
}



$(document).ready(function () {
  $("#documentosApelacion").on("submit", function (event) {
    event.preventDefault();

    if (!$('#idNoApelo').is(":checked") && !$('#idSiApelo').is(":checked")) {
      // Si no se ha seleccionado ninguna opción
      alert('Debe indicar si apelo o no.');
      return;
    }


    let formData = new FormData(this);
    console.log(formData);

    $.ajax({
      url: "./controller/addCalificacion.php",
      method: "POST",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    }).done(function (data) {
      console.log(data);
    });
  });
});


