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


//Muestra o mantiene oculto el input tipo file,
//si es hombre, debe subir el Certificado de Servicio militar
$(document).ready(function () {
  // Oculta el campo al cargar la página
  $("#adjuntaApelacion").hide();

  // Agrega un evento change a los inputs de tipo radio
  $('input[name="nameApeloRes"]').change(function () {
    // Obtiene el valor del input de tipo radio seleccionado
    var valor = $(this).val();

    // Muestra u oculta el campo según el valor del input de tipo radio
    if (valor == "Si") {
      $("#adjuntaApelacion").show();
    } else {
      $("#adjuntaApelacion").hide();
    }
  });
});



var selectCat = document.getElementById("idSelectCat");
if (selectCat) {
  //Si se selecciona la primera categoria, pregunta si es medico

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
    $("#inscripcionMedico").hide();
    // Agrega un evento change a los inputs de tipo radio
    $('input[name="nameMedico"]').change(function () {
      // Obtiene el valor del input de tipo radio seleccionado
      var valor = $(this).val();

      // Muestra u oculta el campo según el valor del input de tipo radio
      if (valor == "Si") {
        $("#examenMedico").show();
        $("#inscripcionMedico").show();
      } else {
        $("#examenMedico").hide();
        $("#inscripcionMedico").hide();
      }
    });
  });

}

