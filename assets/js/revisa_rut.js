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
  