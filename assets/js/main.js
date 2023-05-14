// jquery
$("#documentosObligatorios").on("submit", function (event) {
  console.log("ola");
  // alert( "Handler for `submit` called." );
  event.preventDefault();
  let formData = new FormData(this);

  formData.append('rut', $('#idRutInput').val()); // Agregar el valor del input de tipo texto



  console.log(formData);

  $.ajax({
    url: "./controller/addPersonal.php",
    method: "POST",
    data: formData,
    cache: false,
    contentType: false,
    processData: false
  }).done(function(data) {
 //   $( this ).addClass( "done" );
    console.log(data)
  });

});

// FUNCION QUE VERIFICA SI EL RUT A REGISTRAR YA ESTA INGRESADO
$(document).ready(function() {
  $('#idRutInput').on('blur', function() {
    var rut = $(this).val();
    $.ajax({
      url: './controller/check_rut.php',
      type: 'POST',
      data: {rut: rut},
      success: function(response) {
        $('#rut-validation').html(response);
      }
    });
  });
});





// FUNCION PARA LIMPIAR EL INPUT FILE
function clearFileInput(inputId) {
  var fileInput = document.getElementById(inputId);
  fileInput.value = "";
}

