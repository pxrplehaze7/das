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
    });
    return;
  }

  Swal.fire({
    title: '¿Registrar y continuar?',
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


      $.ajax({
        url: "./controller/add_contrata.php",
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
  if (document.URL.includes("/registro_contrata.php")) {
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
        url: "./controller/add_calificacion.php",
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
          console.info(respuesta);
        });
    }
  });
});
















$("#edicion_pdfs_c").on("submit", function (event) {
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
      formData.append('laid', $('#idtrabid').attr('value'));
      $.ajax({
        url: "./controller/edit_documentos_c.php",
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
  formData.append('laid', $('#idtrabid').attr('value'));
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
        url: "./controller/editar_contacto.php",
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
  event.preventDefault();

  var formData = new FormData(this);

  formData.append('laid', $('#idtrabid').attr('value'));

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
        url: "./controller/edit_infop_c.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      }).done(function (respuesta) {
        respuesta = JSON.parse(respuesta);
        if (respuesta.success) {
          Swal.fire({
            icon: 'success',
            title: 'Información actualizada correctamente',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          }).then(function () {
            location.reload();
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error al actualizar la información',
            text: respuesta.message,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
        }
      }).fail(function (respuesta) {
        Swal.fire({
          icon: 'error',
          title: 'Error al actualizar la información',
          text: respuesta.responseText,
          showConfirmButton: true,
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#009CFD'
        });
      });
    }
  });
});


//esta funcion esta en editar 
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

    var selectedOption = $("#idPermiso").val();

    if (selectedOption === "") {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Por favor, seleccione una opción válida',
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#009CFD'
      });
      return;
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
              $("#idRutInputU").val("");
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
          url: "./controller/edit_usuario.php",
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
              title: 'Se ha restablecido exitosamente',
              html: 'Clave temporal: <strong>' + response.tempPass + '</strong>',
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            }).then(function () {
              location.reload();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error al restablecer la contraseña',
              text: response.message,
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            });
          }
        }).fail(function (response) {
          Swal.fire({
            icon: 'error',
            title: 'Error al restablecer la contraseña',
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

    // Obtener el valor de la contraseña
    var password = $("#idPass").val();

    // Validar la longitud de la contraseña solo si se ha ingresado un valor
    if (password.length > 0 && password.length < 8) {
      Swal.fire({
        icon: 'error',
        title: 'Contraseña demasiado corta',
        text: 'La contraseña debe tener al menos 8 caracteres',
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#009CFD'
      });
      return;
    }

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
              confirmButtonColor: '#009CFD'
            }).then(function () {
              location.reload(); // Actualiza la página
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error al actualizar su información',
              text: response.message,
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            });
          }
        }).fail(function (response) {
          Swal.fire({
            icon: 'error',
            title: 'Error al actualizar su información',
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
          url: "./controller/editar_calificacion.php",
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


  $(".boton-eliminar-calif").click(function (event) {
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
          url: "./controller/eliminaCalificacionCompleta.php",
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













$(".edicionInforme").each(function () {
  var formularioIDinforme = $(this).attr("id");

  $(this).submit(function (event) {
    event.preventDefault();
    Swal.fire({
      title: '¿Desea actualizar el informe?',
      showDenyButton: true,
      showCancelButton: false,
      allowOutsideClick: false,
      confirmButtonText: 'Sí',
      confirmButtonColor: '#00c4a0',
      denyButtonColor: '#ba0051'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "./controller/editar_informe.php",
          type: "POST",
          data: new FormData(this),
          processData: false,
          contentType: false,
          success: function (response) {
            console.log(response);
            Swal.fire({
              icon: 'success',
              title: 'Informe actualizada correctamente',
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
              text: "Ocurrió un error al actualizar el informe",
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


  $(".boton-eliminar-inf").click(function (event) {
    event.preventDefault();
    var idinf = $(this).data("informee");

    Swal.fire({
      title: '¿Desea eliminar el informe?',
      showDenyButton: true,
      showCancelButton: false,
      allowOutsideClick: false,
      confirmButtonText: 'Sí',
      confirmButtonColor: '#00c4a0',
      denyButtonColor: '#ba0051'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "./controller/elimina_informe_completo.php",
          type: "POST",
          data: { idinf: idinf },
          success: function (response) {
            console.log(response);

            Swal.fire({
              icon: 'success',
              title: 'Informe eliminado correctamente',
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
              text: "Ocurrió un error al eliminar el informe",
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



















$("#RegistroDecretos").on("submit", function (event) {
  event.preventDefault();
  Swal.fire({
    title: '¿Realmente registrar este decreto?',
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

      formData.append('idcontrata', $('#idtrabid').attr('value'));

      $.ajax({
        url: "./controller/add_decreto_contrata.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
        .done(function (respuesta) {
          $('body').append(respuesta);
          console.log(respuesta)

        })
        .fail(function (respuesta) {
          $('body').append(respuesta);
          console.log(respuesta)

        })
        .always(function (respuesta) {
          console.info(respuesta)
        });
    }
  });
});








//REGISTRO DE TRABAJADOR
$("#documentosHonorario").on("submit", function (event) {
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
    });
    return;
  }

  Swal.fire({
    title: '¿Registrar y continuar?',
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


      $.ajax({
        url: "./controller/add_honorario.php",
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
          //LIMPIA EL MENSAJE DE VALIDACIÓN DEL RUT
          $('#rut-validation').html('');

        })
        .always(function (respuesta) {
          console.info(respuesta)
        });
    }
  });
});





$("#RegistroDecretosHonorario").on("submit", function (event) {
  event.preventDefault();


  Swal.fire({
    title: '¿Realmente registrar este decreto?',
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

      formData.append('idhonorario', $('#idtrabid').attr('value'));


      $.ajax({
        url: "./controller/add_decreto_honorario.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
        .done(function (respuesta) {
          $('body').append(respuesta);
          console.log(respuesta)

        })
        .fail(function (respuesta) {
          $('body').append(respuesta);
        })
        .always(function (respuesta) {
          console.info(respuesta)
        });
    }
  });
});



$("#editInfoContactoH").on("submit", function (event) {
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
  formData.append('idh', $('#idtrabid').attr('value'));
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
        url: "./controller/editar_contacto_h.php",
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



$("#editInfoPersonalH").on("submit", function (event) {
  event.preventDefault();

  var formData = new FormData(this);

  formData.append('idh', $('#idtrabid').attr('value'));

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
        url: "./controller/edit_infop_h.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      }).done(function (respuesta) {
        respuesta = JSON.parse(respuesta);
        if (respuesta.success) {
          Swal.fire({
            icon: 'success',
            title: 'Información actualizada correctamente',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          }).then(function () {
            location.reload();
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error al actualizar la información',
            text: respuesta.message,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
        }
      }).fail(function (respuesta) {
        Swal.fire({
          icon: 'error',
          title: 'Error al actualizar la información',
          text: respuesta.responseText,
          showConfirmButton: true,
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#009CFD'
        });
      });
    }
  });
});




$("#edicion_pdfs_h").on("submit", function (event) {
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
      formData.append('idh', $('#idtrabid').attr('value'));
      $.ajax({
        url: "./controller/edit_documentos_h.php",
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
        });
    }
  });
});



$("#informelab").on("submit", function (event) {
  event.preventDefault();

  Swal.fire({
    title: '¿Está seguro de añadir informe?',
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
        url: "./controller/add_informe.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      })
        .done(function (respuesta) {
          Swal.fire({
            icon: 'success',
            title: 'Informe guardado exitosamente',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
          clearFileInput('idInformeInput');
          $('#idAnno').val('');
          $('#idFuncion').val('');

          $('#mes').prop('selectedIndex', -1);
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
          console.info(respuesta);
        });
    }
  });
});






$("#EdicionDecretos").on("submit", function (event) {
  event.preventDefault();
  Swal.fire({
    title: '¿Realmente desea actualizar este decreto?',
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

      formData.append('iddecreto', $('#iddec').attr('value'));

      $.ajax({
        url: "./controller/edit_decreto_contrata.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
        .done(function (respuesta) {
          $('body').append(respuesta);
          console.log(respuesta)

        })
        .fail(function (respuesta) {
          $('body').append(respuesta);
          console.log(respuesta)

        })
        .always(function (respuesta) {
          console.info(respuesta)
        });
    }
  });
});





$("#EdicionDecretosH").on("submit", function (event) {
  event.preventDefault();
  Swal.fire({
    title: '¿Realmente desea actualizar este decreto?',
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

      formData.append('iddecreto', $('#iddec').attr('value'));

      $.ajax({
        url: "./controller/edit_decreto_honorario.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
        .done(function (respuesta) {
          $('body').append(respuesta);
          console.log(respuesta)

        })
        .fail(function (respuesta) {
          $('body').append(respuesta);
          console.log(respuesta)

        })
        .always(function (respuesta) {
          console.info(respuesta)
        });
    }
  });
});




// $("editarcalificacion").on("submit", function (event) {
//   event.preventDefault();
//   Swal.fire({
//     title: '¿Realmente desea actualizar esta calificación?',
//     showDenyButton: true,
//     showCancelButton: false,
//     allowOutsideClick: false,
//     confirmButtonText: 'Si',
//     confirmButtonColor: '#00c4a0',
//     denyButtonText: 'No',
//     denyButtonColor: '#ba0051',
//   }).then((result) => {
//     if (result.isDenied) {
//       return;
//     } else {
//       let formData = new FormData(this);

//       formData.append('idcalificacion', $('#idCal').val());
//       console.log('esta en el js');
//       $.ajax({
//         url: "./controller/edit_calificacion.php",
//         method: "POST",
//         data: formData,
//         cache: false,
//         contentType: false,
//         processData: false
//       })
//         .done(function (respuesta) {
//           $('body').append(respuesta);
//           console.log(respuesta)

//         })
//         .fail(function (respuesta) {
//           $('body').append(respuesta);
//           console.log(respuesta)

//         })
//         .always(function (respuesta) {
//           console.info(respuesta)
//         });
//     }
//   });
// });










$("#editarcalificacion").on("submit", function (event) {
  event.preventDefault();
  if (!$('#idNoApelo').is(":checked") && !$('#idSiApelo').is(":checked")) {
    Swal.fire('Debe indicar si apeló o no');
    return;
  }
  Swal.fire({
    title: '¿Está seguroOO de añadir calificación?',
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
      formData.append('idcalificacion', $('#idCal').val());

      $.ajax({
        url: "./controller/edit_calificacion.php",
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
          console.info(respuesta);
        });
    }
  });
});

