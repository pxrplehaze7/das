function registroExitoso() {

    Swal.fire({
        icon: 'success',
        title: 'Registro Exitoso',
        showConfirmButton: false,
        timer: 1500
    })
}


function errorRegistro(){
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Ha ocurrido un error',
        showConfirmButton: false,
        timer: 1500
      })
}