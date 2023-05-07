// jquery
$("#documentos").on("submit", function (event) {
  console.log("ola");
  // alert( "Handler for `submit` called." );
  event.preventDefault();
  let formData = new FormData(this);

  formData.append('nombre', $('#nombre').val()); // Agregar el valor del input de tipo texto



  console.log(formData);

  $.ajax({
    url: "./controller/procesoDatos.php",
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

