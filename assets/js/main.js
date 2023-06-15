$("#documentosObligatorios").on("submit", function (event) {
  event.preventDefault();

  let selectCat = document.querySelector('#idSelectCat');
  if (selectCat.value == 1) {
    if (!document.querySelector('#idSiMedico').checked && !document.querySelector('#idNoMedico').checked) {
      Swal.fire('Debe indicar si es médico o no');
      return;
    }
  }

  if (!$('#idSiInscrip').is(":checked") && !$('#idNoInscrip').is(":checked")) {
    Swal.fire('Debe indicar si debe presentar el Certificado');
    $('#idSiInscrip').focus();
    $('#idNoInscrip').focus();
    return;
  }

  var celularInput = document.getElementById("idCelular");
  var celularValue = celularInput.value.trim();

  if (celularValue !== '' && celularValue.length !== 9) {
    Swal.fire({
      icon: 'warning',
      title: 'Advertencia',
      text: 'El número de teléfono debe tener 9 dígitos',
      didOpen: () => {
        celularInput.focus();
      }
    });
    return;
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

      formData.append('rut', $('#idRutInput').val());

      console.log("el formdata", formData);

      $.ajax({
        url: "./controller/addPersonal.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
        .done(function (respuesta) {
          $('body').append(respuesta);
          document.getElementById("documentosObligatorios").reset();
          $('#rut-validation').html(''); // Limpiar el mensaje de validación del RUT

        })
        .fail(function (respuesta) {
          $('body').append(respuesta);
          $('#rut-validation').html(''); // Limpiar el mensaje de validación del RUT

        })
        .always(function (respuesta) {
          console.info("DATA:", respuesta)
        });
    }
  });
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



// FUNCION QUE CARGA SECTOR SEGUN ID LUGAR
function cargarSectoresTABLA() {
  const lugarSeleccionado = document.getElementById("idSelectLugar").value;
  $.ajax({
    url: './controller/lugar_sectorTABLA.php',
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



// FUNCION PARA LIMPIAR EL INPUT FILE
function clearFileInput(inputId) {
  console.log("input del file", inputId);
  var fileInput = document.getElementById(inputId);
  fileInput.value = "";

}


$("#idNoApelo").change(function () {
  if ($(this).is(":checked")) {
    $("#idApelacionDoc").val("");
  }
});

$("#documentosApelacion").on("submit", function (event) {
  event.preventDefault();

  if (!$('#idNoApelo').is(":checked") && !$('#idSiApelo').is(":checked")) {
    // Si no se ha seleccionado ninguna opción
    Swal.fire('Debe indicar si apeló o no');
    // alert('Debe indicar si apeló o no.');
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
          $('#idInicio').val('');
          $('#idFin').val('');
          $('.radio-input').prop('checked', false);

          // Limpia el campo de entrada de archivo solo si se seleccionó "No" en el input radio
          if ($('#idNoApelo').is(":checked")) {
            $('#idApelacionDoc').val('');
          } else {
            // Si se seleccionó "Si" en el input radio
            $('#idApelacionDoc').val('');
          }

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

      formData.append('laid', $('#idtrabid').val());

      $.ajax({
        url: "./controller/editDocs.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
        .done(function (respuesta) {
          $('body').append(respuesta);
        })
        .fail(function (respuesta) {
          $('body').append(respuesta);
        })
        .always(function (respuesta) {
          console.info("DATA:", respuesta);
          location.reload(); // Actualiza la página
        });
    }
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

  if (celularValue !== '' && celularValue.length !== 9) {
    Swal.fire({
      icon: 'warning',
      title: 'Advertencia',
      text: 'El número de teléfono debe tener 9 dígitos',
      didOpen: () => {
        celularInput.focus();
      }
    });
    return;
  }

  var formData = new FormData(this);

  formData.append('laid', $('#idtrabid').val());
  Swal.fire({
    title: '¿Desea actualizar la información de contacto?',
    showDenyButton: true,
    showCancelButton: false,
    allowOutsideClick: false,
    confirmButtonText: 'Sí',
    confirmButtonColor: '#00c4a0',
    denyButtonColor: '#ba0051'
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
          }).then(function() {
            location.reload(); // Actualiza la página
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




$("#editInfoPersonal").on("submit", function (event) {
  event.preventDefault(); // Evita el envío del formulario por defecto

  var formData = new FormData(this);

  formData.append('laid', $('#idtrabid').val());

  Swal.fire({
    title: '¿Desea actualizar la información personal?',
    showDenyButton: true,
    showCancelButton: false,
    allowOutsideClick: false,
    confirmButtonText: 'Sí',
    confirmButtonColor: '#00c4a0',
    denyButtonColor: '#ba0051'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "./controller/editInfoP.php",
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
          }).then(function() {
            location.reload(); // Actualiza la página
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


function honorarioEdit() {
  var selectContrato = $("#idSelectCon").val();
  var afpprevdiv = $("#afpyprevdiv");
  var selectAFP = $("#idSelectAFP");
  var selectPrev = $("#idSelectPrev");

  if (selectContrato == "3") {
    afpprevdiv.hide();
    selectAFP.val('1');
    selectPrev.val('1');
  }
}

// $(document).ready(function() {
//   $("#edicion_calif").on("submit", function(event) {
//     event.preventDefault(); // Evita el envío del formulario por defecto

//     var formData = new FormData(this);
//     var idCalif = $(this).find(".Btn").attr("data-idcalif"); // Obtener el ID de la calificación

//     formData.append("idcal", idCalif); // Agregar el ID al objeto formData

//     Swal.fire({
//       title: '¿Desea actualizar las calificaciones?',
//       showDenyButton: true,
//       showCancelButton: false,
//       allowOutsideClick: false,
//       confirmButtonText: 'Sí',
//       confirmButtonColor: '#00c4a0',
//       denyButtonColor: '#ba0051'
//     }).then((result) => {
//       if (result.isConfirmed) {
//         $.ajax({
//           url: "./controller/editcalif.php",
//           method: "POST",
//           data: formData,
//           cache: false,
//           contentType: false,
//           processData: false
//         }).done(function(response) {
//           console.log(response);
//           response = JSON.parse(response);
//           console.log(response);
//           if (response.success) {
//             Swal.fire({
//               icon: 'success',
//               title: 'Información actualizada correctamente',
//             }).then(function() {
//               // location.reload();
//             });
//           } else {
//             Swal.fire({
//               icon: 'error',
//               title: 'Error al actualizar la información',
//               text: response.message
//             });
//           }
//         }).fail(function(response) {
//           Swal.fire({
//             icon: 'error',
//             title: 'Error al actualizar la información',
//             text: response.responseText
//           });
//           console.log("salio mal");
//           console.log(response);
//         });
//       }
//     });
//   });
// });


$(document).ready(function() {
  $(".Btncalif").click(function(event) {
    event.preventDefault();

    var form = $(this).closest("form");
    var formData = new FormData(form[0]);

    // Obtener la ID del botón
    var idCalif = $(this).data("idcalif");
    formData.append("idcalif", idCalif);

    // Realizar la solicitud AJAX
    $.ajax({
      url: "./controller/editcalif.php", // Cambia esto con la ruta correcta a tu script del lado del servidor
      method: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        // La solicitud se completó con éxito
        console.log(response); // Puedes mostrar la respuesta del servidor en la consola para depuración
        // Aquí puedes realizar cualquier otra acción que desees después de guardar la actualización
      },
      error: function(xhr, status, error) {
        // Ocurrió un error en la solicitud AJAX
        console.error(error); // Muestra el error en la consola para depuración
      }
    });
  });
});















$(document).ready(function() {
  $("#registroU").on("submit", function(event) {
    event.preventDefault();

    Swal.fire({
      title: '¿Desea registrar Usuario?',
      showDenyButton: true,
      showCancelButton: false,
      allowOutsideClick: false,
      confirmButtonText: 'Sí',
      confirmButtonColor: '#00c4a0',
      denyButtonColor: '#ba0051'
    }).then((result) => {
      if (result.isConfirmed) {
        var formData = new FormData(this);
        $.ajax({
          url: "./controller/addUsuario.php",
          method: "POST",
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        }).done(function(response) {
          response = JSON.parse(response);
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'Usuario registrado exitosamente',
              showConfirmButton: false, 
            }).then(() => {
              $("#idPersona").val("");
              $("#idAppat").val("");
              $("#idApmat").val("");
              $("#idCorreo").val("");
              $("#idPass").val("");
              $("#idPermiso").val("");
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error al registrar Usuario',
              text: response.message
            });
          }
        }).fail(function(response) {
          Swal.fire({
            icon: 'error',
            title: 'Error al registrar Usuario',
            text: response.responseText
          });
        });
      }
    });
  });
});
