
function honorario() {
  var selectContrato = $("#idSelectCon").val();
  var generoRadio = $('input[name="nameGenero"]:checked').val();
  var afpDiv = $("#afp");
  var previsionDiv = $("#prevision");
  var djurDiv = $("#declaraciondoc");
  var nacDiv = $("#nacimiento");
  var saludcDiv = $("#saludcomdoc");
  var servicioMilitarDiv = $("#servicioMilitarHombre");

  if (selectContrato !== "3") {
    afpDiv.show();
    previsionDiv.show();
    djurDiv.show();
    nacDiv.show();
    saludcDiv.show();

    if (generoRadio === "Masculino") {
      servicioMilitarDiv.show();
    } else {
      servicioMilitarDiv.hide();
    }
  } else {



    clearFileInput('idAFPinput');
    clearFileInput('idPREVinput');
    clearFileInput('idDJuradainput');
    clearFileInput('idNACinput');
    clearFileInput('idSCompatibleinput');
    clearFileInput('idMilitarDoc');
    afpDiv.hide();
    previsionDiv.hide();
    djurDiv.hide();
    nacDiv.hide();
    saludcDiv.hide();
    servicioMilitarDiv.hide();

  }
}

$(document).ready(function () {
  // OCULTA EL INPUT FILE AL CARGAR LA PAGINA
  $("#servicioMilitarHombre").hide();
  // SE AGREGA EVENTO CHANGE
  $('input[name="nameGenero"]').change(function () {
    // LLAMA A LA FUNCION PARA ACTUALIZAR LA VISIBILIDAD DEL INPUT
    honorario();
  });

  // SE AGREGA EL EVENTO CHANGE AL SELECT DE CONTRATO
  $("#idSelectCon").change(function () {
    // LLAMA A LA FUNCION PARA ACTUALIZAR LA VISIBILIDAD DEL INPUT
    honorario();
  });

  //SE LLAMA A LA FUNCION PARA VOLVER A VER U OCULTAR
  honorario();
});




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
    // Agrega un evento change a los inputs de tipo radio
    $('input[name="nameMedico"]').change(function () {
      // Obtiene el valor del input de tipo radio seleccionado
      var valor = $(this).val();

      // Muestra u oculta el campo según el valor del input de tipo radio
      if (valor == "Si") {
        $("#examenMedico").show();
      } else {
        $("#examenMedico").hide();
        clearFileInput('idExamenMinput');
      }
    });
  });



  $(document).ready(function () {
    // Oculta el campo al cargar la página
    $("#inscripcionMedico").hide();
    // Agrega un evento change a los inputs de tipo radio
    $('input[name="nameInscrip"]').change(function () {
      // Obtiene el valor del input de tipo radio seleccionado
      var valor = $(this).val();

      // Muestra u oculta el campo según el valor del input de tipo radio
      if (valor == 1) {
        $("#inscripcionMedico").show();
      } else {
        $("#inscripcionMedico").hide();
        clearFileInput('idInscripinput');
      }
    });
  });


}

