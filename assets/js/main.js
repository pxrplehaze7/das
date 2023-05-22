// jquery
$("#documentosObligatorios").on("submit", function (event) {
  console.log("ola");
  // alert( "Handler for `submit` called." );
  event.preventDefault();


  //SELECCIONA EL ELEMENTO  DEL HTML CON EL tCon Y LO ASIGNA A LA VARIABLE selectCat
  let selectCat = document.querySelector('#idSelectCat');
  if (selectCat.value == 1) {
    //SI EL VALOR ES IGUAL A 1 REVISA SI LOS INPUT RADIO ESTAN VACIOS
    if (!document.querySelector('#idSiMedico').checked && !document.querySelector('#idNoMedico').checked) {
      //SI ESTAN VACIOS ENVIA ALERTA
      alert('Debe indicar si es medico o no')
      return
    }
  }

  var radios = document.querySelectorAll('input[type="radio"]');



  let formData = new FormData(this);

  formData.append('rut', $('#idRutInput').val()); // Agrega el valor del input de tipo texto



  console.log(formData);

  $.ajax({
    url: "./controller/addPersonal.php",
    method: "POST",
    data: formData,
    cache: false,
    contentType: false,
    processData: false
  }).done(function (data) {
    //   $( this ).addClass( "done" );
    //console.log(data)
    $('body' ).append( data );
  });

});

// FUNCION QUE VERIFICA SI EL RUT A REGISTRAR YA ESTA INGRESADO
$(document).ready(function () {
  $('#idRutInput').on('blur', function () {
    var rut = $(this).val();

    if (rut.trim() !== '') {
      if (rut.length === 10 || rut.length === 9) { // Agrega esta condición para validar la longitud del RUT
        $.ajax({
          url: './controller/check_rut.php',
          type: 'POST',
          data: { rut: rut },
          success: function (response) {
            $('#rut-validation').html(response);
          }
        });
      } else {
        $('#rut-validation').html('El RUT debe ir sin puntos y con guión'); 
      }
    }
  });
});




// FUNCION PARA LIMPIAR EL INPUT FILE
function clearFileInput(inputId) {
  var fileInput = document.getElementById(inputId);
  fileInput.value = "";
}



const lugarSelect = document.getElementById('idSelectLugar');
const sectorSelect = document.getElementById('idSelectSector');

if(lugarSelect){
// LISTENER AL CAMBIO DEL SELECT LUGAR
lugarSelect.addEventListener('change', function () {
  const lugarId = lugarSelect.value;
  //OBTIENE EL VALOR DEL SELECT Y SE ASIGNA A CONST

  if (lugarId === '2') {
    // SI LA OPCION SELECCIONADA TIENE ID 2 ESTABLECE ESTAS OPCIONES
    sectorSelect.innerHTML = `
        <option value="No aplica">No Aplica</option>
        <option value="Óptica Municipal">Óptica Municipal</option>
        <option value="Centro de Salud Integral Ruka Antu">Centro de Salud Integral Ruka Antu</option>
      `;
  } else if (lugarId === '4') {
    // SI LA OPCION SELECCIONADA TIENE ID 4 ESTABLECE ESTAS OPCIONES
    sectorSelect.innerHTML = `
         <option value="No aplica">No Aplica</option>
         <option value="Laboratorio Dental">Laboratorio Dental</option>
      `;
    } else if (lugarId === '1') {
      // SI LA OPCION SELECCIONADA TIENE ID 1 ESTABLECE ESTAS OPCIONES
      sectorSelect.innerHTML = `
           <option value="No aplica">No Aplica</option>
           <option value="Droguería">Droguería</option>
        `;
      } else if (lugarId === '5') {
        // SI LA OPCION SELECCIONADA TIENE ID 5 ESTABLECE ESTAS OPCIONES
        sectorSelect.innerHTML = `
             <option value="No aplica">No Aplica</option>
             <option value="Farmacia Municipal">Farmacia Municipal</option>
             <option value="Casa de Salud Mental">Casa de Salud Mental</option>
          `;
  } else {
    // SI ES DISTINTO
    sectorSelect.innerHTML = `
        <option value="No aplica">No Aplica</option>
      `;
  }
});
}

$(document).ready(function() {
  $("#documentosApelacion").on("submit", function(event) {
    event.preventDefault();

    if (!$('#idNoApelo').is(":checked") && !$('#idSiApelo').is(":checked")) {
      // Si no se ha seleccionado ninguna opción
      alert('Debe indicar si apelo o no.');
      return;
    }


    let formData = new FormData(this);
    console.log(formData);

    $.ajax({
      url: "./controller/addCalificacion.php",
      method: "POST",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    }).done(function(data) {
      console.log(data);
    });
  });
});


