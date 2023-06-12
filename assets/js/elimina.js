function deleteFile(campo, idtra) {
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
          url: './controller/eliminaRuta.php',
          type: 'POST',
          data: { campo: campo, idtra: idtra },
          success: function (respuesta) {
            Swal.fire({
              title: 'Documento eliminado exitosamente.',
              icon: 'success',
              showConfirmButton: false,
              timer: 3600
            }).then(function() {
              location.reload(); // Actualiza la página
            });
          },
          error: function (xhr, status, error) {
            Swal.fire({
              title: 'Error al eliminar el documento: ' + error,
              icon: 'error',
            });
          },
        });
      }
    });
  }
  
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
          url: './controller/eliminaRutaCAL.php',
          type: 'POST',
          data: { rutaCalificacion: rutaCalificacion, idCalificacion: idCalificacion },
  
          success: function (respuesta) {
            Swal.fire({
              title: 'Documento eliminado exitosamente.',
              icon: 'success',
              showConfirmButton: false,
              timer: 3600
            }).then(function() {
              location.reload(); // Actualiza la página
            });
          },
          error: function (xhr, status, error) {
            console.log(error),
            Swal.fire({
              title: 'Error al eliminar el documento: ' + error,
              icon: 'error',
            });
          },
        });
      }
    });
  }
  
  
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
              showConfirmButton: false,
              timer: 3600
            }).then(function() {
              location.reload(); // Actualiza la página
            });
          },
          error: function (xhr, status, error) {
            console.log(error),
            Swal.fire({
              title: 'Error al eliminar el documento: ' + error,
              icon: 'error',
            });
          },
        });
      }
    });
  }
  
  
  
  
  