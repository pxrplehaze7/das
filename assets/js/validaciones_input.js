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


//VALIDA EL RUT DE USUARIO
//PERMITE SOLO EL INGRESO DE NUMEROS, k O k y -
if(document.getElementById("idRutInputU")){
  document.getElementById("idRutInputU").addEventListener("input", function () {
    var inputVALOR = this.value;
    var valorValido = inputVALOR.replace(/[^0-9kK-]/g, "");
    this.value = valorValido;
  });
}
$(document).ready(function () {
  $('#idRutInputU').on('blur', function () {
    var rutUsuario = $(this).val();
    if (rutUsuario.trim() !== '') {
      validarRutU(rutUsuario);
    }
  });
  // Verificar si el campo de entrada está vacío antes de enviar el formulario
  $('#registroU').on('submit', function () {
    var rutUsuario = $('#idRutInputU').val();
    if (rutUsuario.trim() === '') {
      $('#rut-validationU').html(''); // Eliminar el mensaje de validación si el campo está vacío
    } else {
      validarRutU(rutUsuario);
    }
  });
  function validarRutU(rutUsuario) {
    if (rutUsuario.length === 10 || rutUsuario.length === 9) {
      if (FnU.validaRutU(rutUsuario)) {
        $.ajax({
          url: './controller/check_rutUsuario.php',
          type: 'POST',
          data: { rut: rutUsuario },
          success: function (response) {
            if (response === 'VALIDO') {
              $('#rut-validationU').html('<div class="alert alert-success" role="alert">El RUT es válido y no está registrado</div>');
              setTimeout(function () {
                $('#rut-validationU').html('');
              }, 2000);
            } else {
              $('#rut-validationU').html(response);
              setTimeout(function () {
                $('#rut-validationU').html('');
              }, 2000);
            }
          }
        });
      } else {
        $('#rut-validationU').html('<div class="alert alert-danger" role="alert">El RUT no es válido</div>');
        setTimeout(function () {
          $('#rut-validationU').html('');
        }, 2000);
      }
    } else {
      $('#rut-validationU').html('<div class="alert alert-warning" role="alert">El RUT debe tener 9 o 10 dígitos</div>');
      setTimeout(function () {
        $('#rut-validationU').html('');
      }, 2000);
    }
  }
});
var FnU = {
  // VALIDA QUE EL RUT EN FORMATO XXXXXXXX-X EXISTA
  validaRutU: function (rutCompleto) {
    rutCompleto = rutCompleto.replace("‐", "-");
    if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto))
      return false;
    var tmp = rutCompleto.split('-');
    var digv = tmp[1];
    var rut = tmp[0];
    if (digv == 'K') digv = 'k';

    return (FnU.dv(rut) == digv);
  },
  dv: function (T) {
    var M = 0,
      S = 1;
    for (; T; T = Math.floor(T / 10))
      S = (S + T % 10 * (9 - M++ % 6)) % 11;
    return S ? S - 1 : 'k';
  }
};





//VALIDACION DEL RUT EN REGISTRAR
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
              setTimeout(function() {
                $('#rut-validation').html('');
            }, 2000);
            } else {
              $('#rut-validation').html(response);
              setTimeout(function() {
                $('#rut-validation').html('');
            }, 2000);
            }
          }
        });
      } else {
        $('#rut-validation').html('<div class="alert alert-danger" role="alert">El RUT no es válido</div>');
        setTimeout(function() {
          $('#rut-validation').html('');
      }, 2000);
      }
    } else {
      $('#rut-validation').html('<div class="alert alert-warning" role="alert">El RUT debe tener 9 o 10 dígitos</div>');
      setTimeout(function() {
        $('#rut-validation').html('');
    }, 2000);
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









$("#fechacalif").on("input", function () {
  var input = $(this).val();
  var regex = /^\d{4}-\d{4}$/;

  if (!regex.test(input)) {
    $(this).addClass("is-invalid");
  } else {
    $(this).removeClass("is-invalid");
  }
});