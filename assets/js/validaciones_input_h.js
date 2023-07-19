//PERMITE SOLO LETRAS EN MAYUSCULAN MINUSCULA Y ESPACIOS
function validarTexto(input) {
  var regex = /^[A-Za-z\u00C0-\u017F\s]*$/;
  if (!regex.test(input.value)) {
    input.value = input.value.replace(/[^A-Za-z\u00C0-\u017F\s]/g, '');
  }
}

  
  
  // PERMITE 9 NUMEROS SIN ESPACIOS
  function validarCelular(input) {
    var regex = /^\d{0,9}$/;
    if (!regex.test(input.value)) {
      input.value = input.value.replace(/\D/g, '').substring(0, 9);
    }
  }
  

  function validarNumeros(input) {
    // Eliminar cualquier caracter no numérico
    input.value = input.value.replace(/\D/g, '').substring(0, 10);
  
  }
  
  
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
  
    $('#documentosHonorario').on('submit', function () {
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
            url: './controller/check_rutHonorario.php',
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
  
  
  

  