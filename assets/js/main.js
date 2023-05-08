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

