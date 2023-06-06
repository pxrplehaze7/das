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

  if (!$('#idSiInscrip').is(":checked") && !$('#idNoInscrip').is(":checked")) {
    // Si no se ha seleccionado ninguna opción
    alert('Debe indicar si debe presentar el Certificado');
    return;
  }


  Swal.fire({
    title: '¿Realmente desea registrar trabajador?',
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'SÍ',
    denyButtonText: `NO`,
  }).then((result) => {
    if (result.isDenied) {
      return;
    } else {
      let formData = new FormData(this);

      formData.append('rut', $('#idRutInput').val()); // Agrega el valor del input de tipo texto

      console.log("el formdata", formData);

      $.ajax({
        url: "./controller/addPersonal.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })//fin del ajax
        .done(
          function (respuesta) {
            $('body').append(respuesta);
          }
        )//fin del done
        .fail(
          function (respuesta) {
            $('body').append(respuesta);
          }
        )//fin del fail
        .always(
          (respuesta) => {
            console.info("DATA:", respuesta)
          }
        )//fin del always
    }
  })


});

//Para que no quede ningun radio marcado por defecto
window.addEventListener("load", function () {
  if (document.URL.includes("/registro.php")) {
    console.info("LIMPIANDO RADIOS :d")
    // Obtener todos los elementos de tipo radio
    var radios = document.querySelectorAll('input[type="radio"]');

    // Deseleccionar todos los elementos de tipo radio
    radios.forEach(function (radio) {
      radio.checked = false;
    });
  }

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

$("#documentosApelacion").on("submit", function (event) {
  event.preventDefault();

  if (!$('#idNoApelo').is(":checked") && !$('#idSiApelo').is(":checked")) {
    // Si no se ha seleccionado ninguna opción
    alert('Debe indicar si apelo o no.');
    return;
  }

  Swal.fire({
    title: '¿Está seguro de añadir calificación?',
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Si',
    denyButtonText: 'No',
  }).then((result) => {
    if (result.isDenied) {
      return;
    } else {
      let formData = new FormData(this);

      $.ajax({
        url: "./controller/addCalificacion.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      })
        .done(function (respuesta) {
          Swal.fire({
            icon: 'success',
            title: 'Calificación guardada exitosamente',
            showConfirmButton: false,
            timer: 3000
          });

          // Limpia los campos
          clearFileInput('idCalifInput');
          clearFileInput('idApelacionDoc');
          $('#idInicio').val('');
          $('#idFin').val('');
          $('.radio-input').prop('checked', false);
          $('#idApelacionDoc').val('');


        })
        .fail(function (respuesta) {
          Swal.fire({
            icon: 'error',
            title: 'Error al guardar los archivos: ' + respuesta.responseText,
            showConfirmButton: false,
            timer: 3600
          });
        })
        .always(function (respuesta) {
          console.info("DATA:", respuesta);
        });
    }
  });
});


$("#edicion_pdfs").on("submit", function (event) {
  event.preventDefault();


  Swal.fire({
    title: '¿Desea actualizar los documentos?',
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Si',
    confirmButtonColor: '#00c4a0',
    denyButtonText: 'No',
    denyButtonColor: '#ba0051',
  }).then((result) => {
    if (result.isDenied) {
      return;
    } else {
      let formData = new FormData(this);

      formData.append('rut', $('#idRutInput').val()); // Agrega el valor del input de tipo texto

      $.ajax({
        url: "./controller/editDocs.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })

        .done(
          function (respuesta) {
            $('body').append(respuesta);
          }
        )//fin del done
        .fail(
          function (respuesta) {
            $('body').append(respuesta);
          }
        )//fin del fail
        .always(
          (respuesta) => {
            console.info("DATA:", respuesta)
          }
        )//fin del always
    }
  })
});




// $(".filtro").on("change",function(){
$("#btn-filtro").on("click", function () {

  let datos = {
    cumple: $("#idSelectCumple").val(),
    lugar: $("#idSelectLugar").val(),
    sector: $("#idSelectSector").val(),
  }
console.log(datos);
  $.ajax({
    url: "./controller/cargaTabla.php",
    method: "POST",
    data: datos,
  }).done(function (data) {
    $('#trabajadores_tbody').html(data);
  });


});





// $("#b").on("change",function(){
//   $.ajax({
//     url: "./controller/cargaTabla.php",
//     method: "POST",
//     data: {lugar:$("#b").val() },
//     cache: false,
//     contentType: false,
//     processData: false
//   }).done(function (data) {
//     $('body').append(data);
//   });
// });

