// jquery
$("#documentosObligatorios").on("submit", function (event) {
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


  //Para que no quede ningun radio marcado por defecto
  window.addEventListener("load", function () {
    // Obtener todos los elementos de tipo radio
    var radios = document.querySelectorAll('input[type="radio"]');

    // Deseleccionar todos los elementos de tipo radio
    radios.forEach(function (radio) {
      radio.checked = false;
    });
  });



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


// Espera a que el documento esté cargado
document.addEventListener('DOMContentLoaded', function () {
  // Obtén todos los campos de entrada requeridos
  var requiredInputs = document.querySelectorAll('input[required]');

  // Verifica si hay campos de entrada requeridos no válidos
  var firstInvalidInput = Array.from(requiredInputs).find(function (input) {
    return !input.validity.valid;
  });

  // Enfoca el primer campo de entrada no válido
  if (firstInvalidInput) {
    firstInvalidInput.focus();
  }
});





// FUNCION PARA LIMPIAR EL INPUT FILE
function clearFileInput(inputId) {
  var fileInput = document.getElementById(inputId);
  fileInput.value = "";
}

function deleteFile(campo, rut) {
  $.ajax({
    url: './controller/eliminaRuta.php',
    type: 'POST',
    data: { campo: campo, rut: rut },
    success: function (respuesta) {
      location.reload();
    },
  
  });
}



// FUNCION QUE CARGA SECTOR SEGUN ID LUGAR
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

      for (let i = 0; i < largo; i++) {
        let idSector = respuesta[i]['IDSector'];
        let nombreSector = respuesta[i]['NombreSector'];

        $("#idSelectSector").append("<option value='" + idSector + "'>" + nombreSector + "</option>");
      }
    },
    error: function (error) {
      console.error("ERROR", error.responseText);
    }
  });
}




$(document).ready(function () {
  $("#documentosApelacion").on("submit", function (event) {
    event.preventDefault();

    if (!$('#idNoApelo').is(":checked") && !$('#idSiApelo').is(":checked")) {
      // Si no se ha seleccionado ninguna opción
      alert('Debe indicar si apeló o no.');
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

$(document).ready(function () {
  $("#edicion_pdfs").on("submit", function (event) {
    event.preventDefault();

    let formData = new FormData(this);
    formData.append('rut', $('#idRutInput').val()); // Agrega el valor del input de tipo texto

    console.log(formData);

    $.ajax({
      url: "./controller/editDocs.php",
      method: "POST",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    }).done(function (data) {
      $('body').append(data);
    });
  });
});
