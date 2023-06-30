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


  $('#idCorreo').on('blur', function () {
    var correoElectronico = $(this).val();
    if (correoElectronico.trim() !== '') {
      validarCorreo(correoElectronico);
    }
  });

  // VERIFICA SI EL INPUT ESTA VACIO ANTES DE ENVIAR EL FORMULARIO
  $('#registroU').on('submit', function () {
    var rutUsuario = $('#idRutInputU').val();
    var correoElectronico = $('#idCorreo').val(); // Obtener el valor del campo de correo electrónico
    if (rutUsuario.trim() === '') {
      $('#rut-validationU').html(''); // SI EL CAMPO ESTA VACIO; SE ELIMINA EL MENSAJE DE VALIDACION
    } else {
      validarRutU(rutUsuario);
    }
    if (correoElectronico.trim() === '') {
      $('#correo-validation').html(''); // Eliminar el mensaje de validación del correo si el campo está vacío
    } else {
      validarCorreo(correoElectronico);
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
              $('#idRutInputU').val(''); 
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


  function validarCorreo(correoElectronico) {
    $.ajax({
      url: './controller/check_correo.php',
      type: 'POST',
      data: { correo: correoElectronico },
      success: function(response) {
        if (response === 'VALIDO') {
          $('#correo-validation').html('<div class="alert alert-success" role="alert">El correo es válido y no está registrado</div>');
          setTimeout(function() {
            $('#correo-validation').html('');
          }, 2000);
        } else {
          $('#correo-validation').html(response);
          setTimeout(function() {
            $('#correo-validation').html('');
          }, 2000);
          $('#idCorreo').val(''); 

        }
      }
    });
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

  $('#documentosObligatorios').on('submit', function () {
    var rut = $('#idRutInput').val();
    if (rut.trim() === '') {
      $('#rut-validation').html(''); 
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
            $('#idRutInput').val(''); 
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

const nameInicioInput = document.getElementById('idInicio');
const nameFinInput = document.getElementById('idFin');

nameInicioInput.addEventListener('input', fechaNumeros);
nameFinInput.addEventListener('input', fechaNumeros);

function fechaNumeros(event) {
  const input = event.target;
  const sanitizedValue = input.value.replace(/[^0-9]/g, '');
  input.value = sanitizedValue;
}





function indefinido() {
  var selectCon = document.getElementById("idSelectCon");
  var fechaTermino = document.getElementsByName("nameFechaTermino")[0];

  if (selectCon.value === "3") { // COMPRUEBA SI EL VALOR ES INDEFINIDO
    fechaTermino.disabled = true; 
    fechaTermino.value = "";
  } else {
    fechaTermino.disabled = false; 
  }
}




