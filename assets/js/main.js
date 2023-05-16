


// jquery
$("#documentosObligatorios").on("submit", function (event) {
  console.log("ola");
  // alert( "Handler for `submit` called." );
  event.preventDefault();


  let selectCat = document.querySelector('#idSelectCat');
  if (selectCat.value == 1) {
    if (!document.querySelector('#idSiMedico').checked && !document.querySelector('#idNoMedico').checked) {
      alert('Debe indicar si es medico o no')
      return
    }

  }
  var radios = document.querySelectorAll('input[type="radio"]');



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
  }).done(function (data) {
    //   $( this ).addClass( "done" );
    console.log(data)
  });

});

// FUNCION QUE VERIFICA SI EL RUT A REGISTRAR YA ESTA INGRESADO
$(document).ready(function () {
  $('#idRutInput').on('blur', function () {
    var rut = $(this).val();
    if (rut.trim() !== '') { // Verifica si el campo no está vacío
      $.ajax({
        url: './controller/check_rut.php',
        type: 'POST',
        data: { rut: rut },
        success: function (response) {
          $('#rut-validation').html(response);
        }
      });
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

lugarSelect.addEventListener('change', function () {
  const lugarId = lugarSelect.value;

  if (lugarId === '2') {
    sectorSelect.innerHTML = `
        <option value="No aplica">No Aplica</option>
        <option value="Óptica Municipal">Óptica Municipal</option>
        <option value="Centro de Salud Integral Ruka Antu">Centro de Salud Integral Ruka Antu</option>
      `;
  

  } else if (lugarId === '4') {
    sectorSelect.innerHTML = `
         <option value="No Aplica">No Aplica</option>
         <option value="Laboratorio Dental">Laboratorio Dental</option>
      `;
    
  } else {
    sectorSelect.innerHTML = `
        <option value="No Aplica">No aplica</option>
      `;
   
  }
});


