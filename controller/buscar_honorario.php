<?php
session_start();

include("./config/conexion.php");
$rut = $_POST['nameBuscaRutHonorario'];
$sqlDatosTra = "SELECT  IDTraH, NombreH, PaternoH, MaternoH, Rut, Genero, Inscripcion, Profesion, Medico, CelularH, CorreoH, RutaCV, RutaAntec, RutaCedula, RutaEstudio, RutaExaM, RutaInscripcion, Observ
              FROM honorario 
              WHERE Rut='$rut' LIMIT 1";
$resultadoDatosTra = mysqli_query($conn, $sqlDatosTra);
if (mysqli_num_rows($resultadoDatosTra) == 1) {
    $honorario = mysqli_fetch_assoc($resultadoDatosTra);
    $idh = $honorario['IDTraH'];
    echo $idh;

} else {
    if ($_SESSION['rol'] == '1') {
        http_response_code(400); // Bad request
        echo "
        <script>
          Swal.fire({
            title: 'Usuario no encontrado',
            text: '¿Desea registrar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00c4a0',
            cancelButtonColor: '#ba0051',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No',
            allowOutsideClick: false
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'registro_honorario.php';
            } else {
            }
          });
        </script>";
    } else {
      http_response_code(400); // Bad request
        echo "
        <script>
          Swal.fire({
            title: 'Persona no encontrada',
            text: 'No se ha encontrado a la persona.',
            icon: 'error',
            confirmButtonColor: '#009cfd',
            confirmButtonText: 'Aceptar',
            allowOutsideClick: false
          });
        </script>";
    }
}
?>
