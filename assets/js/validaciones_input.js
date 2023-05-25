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
document.getElementById("idRutInput").addEventListener("input", function () {
  var inputValue = this.value;
  var validValue = inputValue.replace(/[^0-9kK-]/g, "");
  this.value = validValue;
});


//REVISA SI YA ESTA REGISTRADO EN LA BASE DE DATOS
$(document).ready(function () {
  $('#idRutInput').on('blur', function () {
    var rut = $(this).val();

    if (rut.trim() !== '') {
      if (rut.length === 10 || rut.length === 9) {
        if (Fn.validaRut(rut)) {
          $.ajax({
            url: './controller/check_rut.php',
            type: 'POST',
            data: { rut: rut },
            success: function (response) {
              if (response === 'VALIDO') {
                $('#rut-validation').html(' El RUT es válido y no está registrado');
              } else {
                $('#rut-validation').html(response);
              }
            }
          });
        } else {
          $('#rut-validation').html(' El RUT no es válido');
        }
      } else {
        $('#rut-validation').html(' El RUT debe tener 9 o 10 dígitos');
      }
    }
  });
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

