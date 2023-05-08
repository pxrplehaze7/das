//Para que no quede ningun radio marcado por defecto
window.addEventListener('load', function() {
    // Obtener todos los elementos de tipo radio
    var radios = document.querySelectorAll('input[type="radio"]');
    
    // Deseleccionar todos los elementos de tipo radio
    radios.forEach(function(radio) {
      radio.checked = false;
    });
  });
  



$(document).ready(function() {
    // Oculta el campo al cargar la página
    $('#servicioMilitarHombre').hide();
    
    // Agrega un evento change a los inputs de tipo radio
    $('input[name="genero"]').change(function() {
      // Obtiene el valor del input de tipo radio seleccionado
      var valor = $(this).val();
      
      // Muestra u oculta el campo según el valor del input de tipo radio
      if (valor == 'Masculino') {
        $('#servicioMilitarHombre').show();
      } else {
        $('#servicioMilitarHombre').hide();
      }
    });
  });
  