//PERMITE SOLO LETRAS EN MAYUSCULAN MINUSCULA Y ESPACIOS
function validarTexto(input) {
  var regex = /^[A-Za-z\s]+$/;
  if (!regex.test(input.value)) {
    input.value = input.value.replace(/[^A-Za-z\s]+/, '');
  }
}


// PERMITE 9 NUMEROS SIN ESPACIOS
function validarCelular(input) {
  var regex = /^\d{0,9}$/;
  if (!regex.test(input.value)) {
    input.value = input.value.replace(/\D/g, '').substring(0, 9);
  }
}


//PERMITE SOLO EL INGRESO DE NUMEROS, k O k y -
if(document.getElementById("idRutInput")){
  document.getElementById("idRutInput").addEventListener("input", function () {
    var inputValue = this.value;
    var validValue = inputValue.replace(/[^0-9kK-]/g, "");
    this.value = validValue;
  });
}




$(document).ready(function () {
  $('#idRutInput').on('blur', function () {
    var rut = $(this).val();
    if (rut.trim() !== '') {
      validarRut(rut);
    }
  });

  // Verificar si el campo de entrada está vacío antes de enviar el formulario
  $('#documentosObligatorios').on('submit', function () {
    var rut = $('#idRutInput').val();
    if (rut.trim() === '') {
      $('#rut-validation').html(''); // Eliminar el mensaje de validación si el campo está vacío
    } else {
      validarRut(rut);
    }
  });

  function validarRut(rut) {
    if (rut.length === 10 || rut.length === 9) {
      if (Fn.validaRut(rut)) {
        $.ajax({
          url: './controller/check_rut.php',
          type: 'POST',
          data: { rut: rut },
          success: function (response) {
            if (response === 'VALIDO') {
              $('#rut-validation').html('<div class="alert alert-success" role="alert">El RUT es válido y no está registrado</div>');
            } else {
              $('#rut-validation').html(response);
            }
          }
        });
      } else {
        $('#rut-validation').html('<div class="alert alert-danger" role="alert">El RUT no es válido</div>');
      }
    } else {
      $('#rut-validation').html('<div class="alert alert-warning" role="alert">El RUT debe tener 9 o 10 dígitos</div>');
    }
  }
});




var Fn = {
  // VALIDA QUE EL RUT EN FORMATO XXXXXXXX-X EXISTA
  validaRut: function (rutCompleto) {
    rutCompleto = rutCompleto.replace("‐", "-");
    if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto))
      return false;
    var tmp = rutCompleto.split('-');
    var digv = tmp[1];
    var rut = tmp[0];
    if (digv == 'K') digv = 'k';

    return (Fn.dv(rut) == digv);
  },
  dv: function (T) {
    var M = 0,
      S = 1;
    for (; T; T = Math.floor(T / 10))
      S = (S + T % 10 * (9 - M++ % 6)) % 11;
    return S ? S - 1 : 'k';
  }
};






// $(document).ready(function () {
//   var rutBaseDatos = $('#idRutInputEDIT').val(); // Obtener el RUT de la base de datos

//   $('#idRutInputEDIT').on('blur', function () {
//     var rut = $(this).val();
//     if (rut.trim() !== '') {
//       validarRut2(rut);
//     }
//   });

//   // Verificar si el campo de entrada está vacío antes de enviar el formulario
//   $('#editInfoPersonal').on('submit', function () {
//     var rut = $('#idRutInputEDIT').val();
//     if (rut.trim() === '') {
//       $('#rut-validation2').html(''); // Eliminar el mensaje de validación si el campo está vacío
//     } else {
//       validarRut2(rut);
//     }
//   });

//   function validarRut2(rut) {
//     if (rut.length === 10 || rut.length === 9) {
//       if (Function.validaRut2(rut)) {
//         if (rut !== rutBaseDatos) { // Comparar el RUT ingresado con el RUT de la base de datos
//           $.ajax({
//             url: './controller/check_rut.php',
//             type: 'POST',
//             data: { rut: rut },
//             success: function (response) {
//               if (response === 'VALIDO') {
//                 $('#rut-validation2').html('El RUT es válido y no está registrado');
//               } else {
//                 $('#rut-validation2').html(response);
//               }
//             }
//           });
//         } else {
//           $('#rut-validation2').html(''); // No mostrar mensaje de validación si el RUT es el mismo que el de la base de datos
//         }
//       } else {
//         $('#rut-validation2').html('El RUT no es válido');
//       }
//     } else {
//       $('#rut-validation2').html('El RUT debe tener 9 o 10 dígitos');
//     }
//   }
// });
