//PERMITE 9 NUMEROS SIN ESPACIOS
function validarCelular(input) {
  var regex = /^\d{0,9}$/;
  if (input.value !== '' && !regex.test(input.value)) {
    input.value = input.value.replace(/\D/g, '').substring(0, 9);
  }
}

//REGISTRO DE TRABAJADOR
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
      showConfirmButton: true,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#009CFD',
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
          //LIMPIA EL MENSAJE DE VALIDACIÓN DEL RUT
          $('#rut-validation').html('');

        })
        .fail(function (respuesta) {
          $('body').append(respuesta);
          //LIMPIA EL MENSAJE DE VALIDACIÓN DEL RUT
          $('#rut-validation').html('');

        })
        .always(function (respuesta) {
          console.info(respuesta)
        });
    }
  });
});





//PARA QUE NO QUEDE NINGUN RADIO MARCADO POR DEFECTO
window.addEventListener("load", function () {
  if (document.URL.includes("/registro.php")) {
    // OBTIENE TODOS LOS ELEMENTOS DE TIPO RADIO
    var radios = document.querySelectorAll('input[type="radio"]');

    // DESELECCIONA TODOS LOS ELEMENTOS DE TIPO RADIO
    radios.forEach(function (radio) {
      radio.checked = false;
    });
  }
});




// ESPERA A QUE EL DOCUMENTO ESTÉ CARGADO
document.addEventListener('DOMContentLoaded', function () {
  // Obtén todos los campos de entrada requeridos
  var requiredInputs = document.querySelectorAll('input[required]');

  //REVISA SI HAY INPUTS REQUIRED NO VALIDOS
  var firstInvalidInput = Array.from(requiredInputs).find(function (input) {
    return !input.validity.valid;
  });

  // ENFOCA EL PRIMER INPUT NO VALIDO
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
    Swal.fire('Debe indicar si apeló o no');
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
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
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
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
        })
        .always(function (respuesta) {
          console.info("DATA:", respuesta);
        });
    }
  });
});

$("#edicion_pdfs").on("submit", function (event) {
  event.stopPropagation();
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
        })

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

      // ACTUALIZA LOS DATOS DE LA TABLA
      var table = $('#total').DataTable();
      table.clear().rows.add($('#total tbody tr')).draw();
    });
});





$("#limpia-filtro").on("click", function () {
  // RSTABLECE LOS VALORES DE LOS SELECT
  $("#idSelectLugar").val(0);
  $("#idSelectSector").val(0);
  $("#idSelectCumple").val("");
  $("#idSelectSector").html("<option value='0' hidden> Selecciona</option>");
  // RECARGA LA TABLA CON LOS REGISTROS
  $.ajax({
    url: "./controller/cargaTabla.php",
    method: "POST",
    data: { cumple: "", lugar: 0, sector: 0 },
  })
    .done(function (data) {
      $('#trabajadores_tbody').html(data);
      // ACTUALIZA LOS DATOS DE LA TABLA
      var table = $('#total').DataTable();
      table.clear().rows.add($('#total tbody tr')).draw();
    });
});



$("#editInfoContacto").on("submit", function (event) {
  event.preventDefault();
  var celularInput = document.getElementById("idCelular");
  var celularValue = celularInput.value.trim();

  if (celularValue !== '' && celularValue.length !== 9) {
    Swal.fire({
      icon: 'warning',
      title: 'Advertencia',
      text: 'El número de teléfono debe tener 9 dígitos',
      showConfirmButton: true,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#009CFD',
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
            showConfirmButton: true
          }).then(function () {
            location.reload(); // Actualiza la página
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error al actualizar la información',
            text: response.message,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
        }
      }).fail(function (response) {
        Swal.fire({
          icon: 'error',
          title: 'Error al actualizar la información',
          text: response.responseText,
          showConfirmButton: true,
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#009CFD'
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
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          }).then(function () {
            location.reload(); // Actualiza la página
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error al actualizar la información',
            text: response.message,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
        }
      }).fail(function (response) {
        Swal.fire({
          icon: 'error',
          title: 'Error al actualizar la información',
          text: response.responseText,
          showConfirmButton: true,
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#009CFD'
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


$(document).ready(function () {
  $("#registroU").on("submit", function (event) {
    event.preventDefault();

    // Obtener el valor de la opción seleccionada
    var selectedOption = $("#idPermiso").val();

    // Verificar si la opción seleccionada es vacía
    if (selectedOption === "") {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Por favor, seleccione una opción válida',
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#009CFD'
      });
      return; // Detener el flujo del código y evitar que se muestre el cuadro de diálogo de confirmación
    }

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
        }).done(function (response) {
          response = JSON.parse(response);
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'Usuario registrado exitosamente',
              html: 'Clave temporal: <strong>' + response.tempPass + '</strong>',
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            }).then(() => {
              $("#idRutInput").val("");
              $("#idPersona").val("");
              $("#idAppat").val("");
              $("#idApmat").val("");
              $("#idCorreo").val("");
              $("#idPermiso").val("");
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error al registrar Usuario',
              text: response.message,
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            });
          }
        }).fail(function (response) {
          Swal.fire({
            icon: 'error',
            title: 'Error al registrar Usuario',
            text: response.responseText,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
        });
      }
    });
  });
});




$(document).ready(function () {
  $("#editU").on("submit", function (event) {
    event.preventDefault();

    Swal.fire({
      title: '¿Desea actualizar la información del usuario?',
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
          url: "./controller/editUser.php",
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
              title: 'Información actualizada exitosamente',
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            }).then(function () {
              location.reload(); 
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error al actualizar la información del Usuario',
              text: response.message,
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            });
          }
        }).fail(function (response) {
          Swal.fire({
            icon: 'error',
            title: 'Error al actualizar la información del Usuario',
            text: response.responseText,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
        });
      }
    });
  });
});




$(document).ready(function () {
  $("#resetP").on("submit", function (event) {
    event.preventDefault();

    Swal.fire({
      title: '¿Desea restablecer la contraseña del usuario?',
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
          url: "./controller/reset_pass.php",
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
              title: 'Información actualizada exitosamente',
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            }).then(function () {
              location.reload(); 
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error al actualizar la información del Usuario',
              text: response.message,
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            });
          }
        }).fail(function (response) {
          Swal.fire({
            icon: 'error',
            title: 'Error al actualizar la información del Usuario',
            text: response.responseText,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
        });
      }
    });
  });
});



$(document).ready(function () {
  $("#miperfil").on("submit", function (event) {
    event.preventDefault();

    Swal.fire({
      title: '¿Desea actualizar su información?',
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
          url: "./controller/editprofile.php",
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
              title: 'Información actualizada exitosamente',
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'            }).then(function () {
              location.reload(); // Actualiza la página
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error al actualizar la información del Usuario',
              text: response.message,
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            });
          }
        }).fail(function (response) {
          Swal.fire({
            icon: 'error',
            title: 'Error al actualizar la información del Usuario',
            text: response.responseText,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
        });
      }
    });
  });
});







$(document).ready(function () {
  $(".edicionCalif").each(function () {
    var formularioID = $(this).attr("id");

    $(this).submit(function (event) {
      event.preventDefault();
      Swal.fire({
        title: '¿Desea actualizar la calificación?',
        showDenyButton: true,
        showCancelButton: false,
        allowOutsideClick: false,
        confirmButtonText: 'Sí',
        confirmButtonColor: '#00c4a0',
        denyButtonColor: '#ba0051'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "./controller/editcalif.php",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (response) {
              console.log(response);
              Swal.fire({
                icon: 'success',
                title: 'Calificación actualizada correctamente',
                showConfirmButton: true,
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#009CFD'            
                }).then(function () {
                location.reload(); 
              });
            },
            error: function (xhr, status, error) {
              console.error(error);
              Swal.fire({
                title: "Error",
                text: "Ocurrió un error al actualizar la calificación",
                icon: "error",
                showConfirmButton: true,
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#009CFD'
              });
            }
          });
        }
      });
    });
    $(".boton-eliminar").click(function (event) {
      event.preventDefault();
    
      var idCalificacion = $(this).data("idcalific");
    
      Swal.fire({
        title: '¿Desea eliminar la calificación?',
        showDenyButton: true,
        showCancelButton: false,
        allowOutsideClick: false,
        confirmButtonText: 'Sí',
        confirmButtonColor: '#00c4a0',
        denyButtonColor: '#ba0051'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "./controller/eliminaCalificacion.php",
            type: "POST",
            data: { idCalificacion: idCalificacion },
            success: function (response) {
              console.log(response);
    
              Swal.fire({
                icon: 'success',
                title: 'Calificación eliminada correctamente',
                showConfirmButton: true,
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#009CFD'            
              }).then(function () {
                location.reload(); 
              });
            },
            error: function (xhr, status, error) {
              console.error(error);
              Swal.fire({
                title: "Error",
                text: "Ocurrió un error al eliminar la calificación",
                icon: "error",
                showConfirmButton: true,
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#009CFD'
              });
            }
          });
        }
      });
    });
  });
});


