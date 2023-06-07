// jquery
$("#documentosObligatorios").on("submit", function (event) {
  event.preventDefault();

  //SELECCIONA EL ELEMENTO  DEL HTML CON EL tCon Y LO ASIGNA A LA VARIABLE selectCat
  let selectCat = document.querySelector('#idSelectCat');
  if (selectCat.value == 1) {
    //SI EL VALOR ES IGUAL A 1 REVISA SI LOS INPUT RADIO ESTAN VACIOS
    if (!document.querySelector('#idSiMedico').checked && !document.querySelector('#idNoMedico').checked) {
      //SI ESTAN VACIOS ENVIA ALERTA
      Swal.fire('Debe indicar si es medico o no');
      // alert('Debe indicar si es medico o no')
      return
    }
  }

  if (!$('#idSiInscrip').is(":checked") && !$('#idNoInscrip').is(":checked")) {
    //ALERTA SI NO SE HA SELECCIONADO NINGUN RADIO
    // alert('Debe indicar si debe presentar el Certificado');
    Swal.fire('Debe indicar si debe presentar el Certificado');
    $('#idSiInscrip').focus();
    $('#idNoInscrip').focus();
    return;
  }

  var celularInput = document.getElementById("idCelular");
  var celularValue = celularInput.value.trim();

  if (celularValue.length !== 9) {
    Swal.fire({
      icon: 'warning',
      title: 'Advertencia',
      text: 'El número de teléfono debe tener 9 dígitos',
      didRender: () => {
        celularInput.focus(); // Establece el foco en el campo de teléfono
      }
    });
    return; // Detiene la ejecución del código
  }


  Swal.fire({
    title: '¿Realmente desea registrar trabajador?',
    showDenyButton: true,
    showCancelButton: false,
    allowOutsideClick: false,
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
    Swal.fire('Debe indicar si apelo o no');
    // alert('Debe indicar si apelo o no.');
    return;
  }

  Swal.fire({
    title: '¿Está seguro de añadir calificación?',
    showDenyButton: true,
    showCancelButton: false,
    allowOutsideClick: false,
    confirmButtonText: 'Si',
    confirmButtonColor: '#00c4a0',
    denyButtonText: 'No',
    denyButtonColor: '#ba0051',
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
  Swal.fire({
    title: '¿Desea actualizar los documentos?',
    showDenyButton: true,
    showCancelButton: false,
    allowOutsideClick: false,
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
  })
    .done(function (data) {
      $('#trabajadores_tbody').html(data);

      // Actualizar los datos de la tabla
      var table = $('#total').DataTable();
      table.clear().rows.add($('#total tbody tr')).draw();
    });
});



$("#limpia-filtro").on("click", function () {
  // Restablecer los valores de los select a su opción predeterminada
  $("#idSelectLugar").val(0);
  $("#idSelectSector").val(0);
  $("#idSelectCumple").val("");

// Restablecer el valor predeterminado del select de sector
  $("#idSelectSector").html("<option value='0' hidden> Selecciona</option>");

  // Recargar la tabla con todos los registros
  $.ajax({
    url: "./controller/cargaTabla.php",
    method: "POST",
    data: { cumple: "", lugar: 0, sector: 0 },
  })
    .done(function (data) {
      $('#trabajadores_tbody').html(data);

      // Actualizar los datos de la tabla
      var table = $('#total').DataTable();
      table.clear().rows.add($('#total tbody tr')).draw();
    });
});





$("#editInfoContacto").on("submit", function (event) {
  event.preventDefault(); // Evita el envío del formulario por defecto

  var celularInput = document.getElementById("idCelular");
  var celularValue = celularInput.value.trim();

  if (celularValue.length !== 9) {
    Swal.fire({
      icon: 'warning',
      title: 'Advertencia',
      text: 'El número de teléfono debe tener 9 dígitos',
      didOpen: () => {
        celularInput.focus(); // Resalta el campo de teléfono
      }
    });
    return; // Detiene la ejecución del código
  }

  var formData = new FormData(this);

  formData.append('rut', $('#idRutInput').val()); // Agrega el valor del input de tipo texto

  Swal.fire({
    title: '¿Desea actualizar la información de contacto?',
    showDenyButton: true,
    showCancelButton: false,
    allowOutsideClick: false,
    confirmButtonText: 'Sí',
    confirmButtonColor: '#00c4a0',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "./controller/editContacto.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      }).done(function (response) {
        response = JSON.parse(response);
        if (response.success) {
          Swal.fire({
            icon: 'success',
            title: 'Información actualizada correctamente',
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error al actualizar la información',
            text: response.message
          });
        }
      }).fail(function (response) {
        Swal.fire({
          icon: 'error',
          title: 'Error al actualizar la información',
          text: response.responseText
        });
      });
    }
  });
});



