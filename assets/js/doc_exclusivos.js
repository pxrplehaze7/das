//Para que no quede ningun radio marcado por defecto
window.addEventListener("load", function () {
  // Obtener todos los elementos de tipo radio
  var radios = document.querySelectorAll('input[type="radio"]');

  // Deseleccionar todos los elementos de tipo radio
  radios.forEach(function (radio) {
    radio.checked = false;
  });
});

//Muestra o mantiene oculto el input tipo file,
//si es hombre, debe subir el Certificado de Servicio militar
$(document).ready(function () {
  // Oculta el campo al cargar la página
  $("#servicioMilitarHombre").hide();

  // Agrega un evento change a los inputs de tipo radio
  $('input[name="nameGenero"]').change(function () {
    // Obtiene el valor del input de tipo radio seleccionado
    var valor = $(this).val();

    // Muestra u oculta el campo según el valor del input de tipo radio
    if (valor == "Masculino") {
      $("#servicioMilitarHombre").show();
    } else {
      $("#servicioMilitarHombre").hide();
    }
  });
});

//Si se selecciona la primera categoria, pregunta si es medico
var selectCat = document.getElementById("idSelectCat");
var preguntaMedico = document.getElementById("idPreguntaCat1");

selectCat.addEventListener("change", function () {
  if (selectCat.value == "1") {
    preguntaMedico.style.display = "block";
  } else {
    preguntaMedico.style.display = "none";
  }
});


$(document).ready(function () {
  // Oculta el campo al cargar la página
  $("#examenMedico").hide();

  // Agrega un evento change a los inputs de tipo radio
  $('input[name="nameMedico"]').change(function () {
    // Obtiene el valor del input de tipo radio seleccionado
    var valor = $(this).val();

    // Muestra u oculta el campo según el valor del input de tipo radio
    if (valor == "Sí") {
      $("#examenMedico").show();
    } else {
      $("#examenMedico").hide();
    }
  });
});