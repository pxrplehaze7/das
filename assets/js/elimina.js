// ELIMINA DOCUMENTO DEL TRABAJADOR
function elimina_doc_c(campo, idtra) {
  Swal.fire({
    title: '¿Está seguro que desea eliminar el documento?',
    icon: 'warning',
    showCancelButton: true,
    allowOutsideClick: false,
    confirmButtonText: 'Si',
    confirmButtonColor: '#00c4a0',
    cancelButtonText: 'No',
    cancelButtonColor: '#ba0051',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: './controller/elimina_doc_c.php',
        type: 'POST',
        data: { campo: campo, idtra: idtra },
        success: function (respuesta) {
          Swal.fire({
            title: 'Documento eliminado exitosamente.',
            icon: 'success',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'         
          }).then(function () {
            location.reload();
          });
        },
        error: function (xhr, status, error) {
          Swal.fire({
            title: 'Error al eliminar el documento: ' + error,
            icon: 'error',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
        },
      });
    }
  });
}


//ELIMINA LA CALIFICACION
function deleteFileCal(rutaCalificacion, idCalificacion) {
  Swal.fire({
    title: '¿Está seguro que desea eliminar la calificación?',
    icon: 'warning',
    showCancelButton: true,
    allowOutsideClick: false,
    confirmButtonText: 'Si',
    confirmButtonColor: '#00c4a0',
    cancelButtonText: 'No',
    cancelButtonColor: '#ba0051',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: './controller/elimina_pdf_calif.php',
        type: 'POST',
        data: { rutaCalificacion: rutaCalificacion, idCalificacion: idCalificacion },

        success: function (respuesta) {
          Swal.fire({
            title: 'Documento eliminado exitosamente.',
            icon: 'success',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          }).then(function () {
            location.reload(); // Actualiza la página
          });
        },
        error: function (xhr, status, error) {
          console.log(error),
            Swal.fire({
              title: 'Error al eliminar el documento: ' + error,
              icon: 'error',
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            });
        },
      });
    }
  });
}


//ELIMINA LA APELACION
function deleteFileApela(rutaApelacion, idCalificacion) {
  Swal.fire({
    title: '¿Está seguro que desea eliminar la apelación?',
    icon: 'warning',
    showCancelButton: true,
    allowOutsideClick: false,
    confirmButtonText: 'Si',
    confirmButtonColor: '#00c4a0',
    cancelButtonText: 'No',
    cancelButtonColor: '#ba0051',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: './controller/eliminaRutaAp.php',
        type: 'POST',
        data: { rutaApelacion: rutaApelacion, idCalificacion: idCalificacion },

        success: function (respuesta) {
          Swal.fire({
            title: 'Documento eliminado exitosamente.',
            icon: 'success',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          }).then(function () {
            location.reload(); // Actualiza la página
          });
        },
        error: function (xhr, status, error) {
          console.log(error),
            Swal.fire({
              title: 'Error al eliminar el documento: ' + error,
              icon: 'error',
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            });
        },
      });
    }
  });
}



//ELIMINA USUARIOS 
$(document).on('click', '.btnEliminarUsuario', function () {
  var idUsuario = $(this).data('idusuario'); // Obtiene el ID del usuario desde el atributo data
  Swal.fire({
    title: '¿Está seguro que desea eliminar este usuario?',
    icon: 'warning',
    showCancelButton: true,
    allowOutsideClick: false,
    confirmButtonText: 'Si',
    confirmButtonColor: '#00c4a0',
    cancelButtonText: 'No',
    cancelButtonColor: '#ba0051',
  }).then((result) => {
    if (result.isConfirmed) {
      // Realizar la eliminación del usuario mediante una solicitud AJAX
      $.ajax({
        url: './controller/elimina_usuario.php',
        type: 'POST',
        data: { idUsuario: idUsuario },
        success: function (respuesta) {
          Swal.fire({
            title: 'Usuario eliminado exitosamente.',
            icon: 'success',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          }).then(function () {
            location.reload(); // Actualiza la página
          });
        },
        error: function (xhr, status, error) {
          Swal.fire({
            title: 'Error al eliminar el usuario: ' + error,
            icon: 'error',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
        },
      });
    }
  });
});



$(document).on('click', '.btn-confirma', function () {
  var idDecreto = $(this).data('iddecreto');
  Swal.fire({
    title: '¿Está seguro?',
    text: 'Una vez confirmado, no volverá a aparecer en la lista',
    icon: 'warning',
    showCancelButton: true,
    allowOutsideClick: false,
    confirmButtonText: 'Si',
    confirmButtonColor: '#00c4a0',
    cancelButtonText: 'No',
    cancelButtonColor: '#ba0051',
  }).then((result) => {
    if (result.isConfirmed) {
      // Realizar la eliminación del usuario mediante una solicitud AJAX
      $.ajax({
        url: './controller/confirma.php',
        type: 'POST',
        data: { idDec: idDecreto },
        dataType: 'json',
        success: function (respuesta) {
          if (respuesta.success) {
            Swal.fire({
              title: 'Confirmación exitosa',
              text: respuesta.message,
              icon: 'success'
            }).then(function () {
              location.reload();
            });
          } else {
            Swal.fire({
              title: 'Error al confirmar',
              text: respuesta.message,
              icon: 'error'
            });
          }
        },
        error: function (xhr, status, error) {
          Swal.fire({
            title: 'Error al confirmar',
            text: 'Hubo un error al realizar la solicitud.',
            icon: 'error'
          });
        }
      });
    }
  });
});


// ELIMINA DOCUMENTO DEL TRABAJADOR
function elimina_doc_h(campo, idh) {
  Swal.fire({
    title: '¿Está seguro que desea eliminar el documento?',
    icon: 'warning',
    showCancelButton: true,
    allowOutsideClick: false,
    confirmButtonText: 'Si',
    confirmButtonColor: '#00c4a0',
    cancelButtonText: 'No',
    cancelButtonColor: '#ba0051',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: './controller/elimina_doc_h.php',
        type: 'POST',
        data: { campo: campo, idh: idh },
        success: function (respuesta) {
          Swal.fire({
            title: 'Documento eliminado exitosamente.',
            icon: 'success',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'         
          }).then(function () {
            location.reload();
          });
        },
        error: function (xhr, status, error) {
          Swal.fire({
            title: 'Error al eliminar el documento: ' + error,
            icon: 'error',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
        },
      });
    }
  });
}



//ELIMINA LA CALIFICACION
function deleteFileInforme(rutaInforme, idInforme) {
  Swal.fire({
    title: '¿Está seguro que desea eliminar el informe?',
    icon: 'warning',
    showCancelButton: true,
    allowOutsideClick: false,
    confirmButtonText: 'Si',
    confirmButtonColor: '#00c4a0',
    cancelButtonText: 'No',
    cancelButtonColor: '#ba0051',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: './controller/elimina_pdf_informe.php',
        type: 'POST',
        data: { rutaInforme: rutaInforme, idInforme: idInforme },

        success: function (respuesta) {
          Swal.fire({
            title: 'Informe eliminado exitosamente.',
            icon: 'success',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          }).then(function () {
            location.reload(); // Actualiza la página
          });
        },
        error: function (xhr, status, error) {
          console.log(error),
            Swal.fire({
              title: 'Error al eliminar el informe: ' + error,
              icon: 'error',
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            });
        },
      });
    }
  });
}
