function validarTexto(input) {
    //PERMITE SOLO LETRAS EN MAYUSCULAN MINUSCULA Y ESPACIOS
    var regex = /^[A-Za-z\s]+$/;
  
    if (!regex.test(input.value)) {
      input.value = input.value.replace(/[^A-Za-z\s]+/, '');
    }
  }

  function validarCelular(input) {
    // PERMITE 9 NUMEROS SIN ESPACIOS
    var regex = /^\d{0,9}$/;
  
    if (!regex.test(input.value)) {
      input.value = input.value.replace(/\D/g, '').substring(0, 9);
    }
  }



//   function validarRutFormato(input) {
//     var rut = input.value.trim();
//     rut = rut.replace(/[^0-9kK]+/g, '').toUpperCase();
  
//     var rutSinDigito = rut.slice(0, -1);
//     var digitoVerificador = rut.slice(-1);
  
//     var rutFormateado = rutSinDigito + '-' + digitoVerificador;
  
//     if (/^[0-9]+-[0-9kK]$/i.test(rutFormateado) && validarRutModulo11(rutSinDigito) && digitoVerificador === calcularDigitoVerificadorModulo11(rutSinDigito).toUpperCase()) {
//       input.setCustomValidity('');
//       input.value = rutFormateado;
//     } else {
//       input.setCustomValidity('Rut inválido');
//     }
//   }
  
//   function validarRutModulo11(rutSinDigito) {
//     var suma = 0;
//     var multiplicador = 2;
  
//     for (var i = rutSinDigito.length - 1; i >= 0; i--) {
//       suma += parseInt(rutSinDigito.charAt(i)) * multiplicador;
//       multiplicador = multiplicador === 7 ? 2 : multiplicador + 1;
//     }
  
//     var digitoCalculado = 11 - (suma % 11);
//     return digitoCalculado === 11 ? 0 : digitoCalculado;
//   }
  
//   function calcularDigitoVerificadorModulo11(rutSinDigito) {
//     var digitoCalculado = validarRutModulo11(rutSinDigito);
//     return digitoCalculado === 10 ? 'K' : digitoCalculado.toString();
//   }