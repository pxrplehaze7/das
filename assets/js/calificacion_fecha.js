
$("#fechacalif").on("input", function () {
    var input = $(this).val();
    var regex = /^\d{4}-\d{4}$/;
    if (!regex.test(input)) {
      $(this).addClass("is-invalid");
    } else {
      $(this).removeClass("is-invalid");
    }
  });
  
  const nameInicioInput = document.getElementById('idInicio');
  const nameFinInput = document.getElementById('idFin');
  
  nameInicioInput.addEventListener('input', fechaNumeros);
  nameFinInput.addEventListener('input', fechaNumeros);
  
  function fechaNumeros(event) {
    const input = event.target;
    const sanitizedValue = input.value.replace(/[^0-9]/g, '');
    input.value = sanitizedValue;
  }
  
  
  