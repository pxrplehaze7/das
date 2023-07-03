<?php
session_start();

include("./config/conexion.php");
$rut = $_POST['nameBuscaRutContrata'];
$sqlDatosTra = "SELECT cat.NombreCat, afp.NombreAFP, pre.NombrePrev, tra.IDAFP, tra.IDPrev, tra.IDTra , NombreTra, PaternoTra, MaternoTra, Rut, Genero, Inscripcion, Profesion, Medico, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaDJur,RutaSerM, RutaSCom, RutaExaM, RutaInscripcion, Observ
              FROM trabajador tra
              INNER JOIN categoria cat  ON (cat.IDCat   = tra.IDCat)
              INNER JOIN afp afp        ON (afp.IDAFP   = tra.IDAFP)
              INNER JOIN prevision pre ON (pre.IDPrev  = tra.IDPrev)
              WHERE Rut='$rut' LIMIT 1";
$resultadoDatosTra = mysqli_query($conn, $sqlDatosTra);
if (mysqli_num_rows($resultadoDatosTra) == 1) {
    $persona = mysqli_fetch_assoc($resultadoDatosTra);
    $idtra = $persona['IDTra'];
    echo $idtra;

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
              window.location.href = 'registro_contrata_i.php';
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
