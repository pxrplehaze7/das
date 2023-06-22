<?php
include("./config/conexion.php");
$rut = $_POST['nameBuscaRut'];
$sqlDatosTra = "SELECT cat.NombreCat, con.NombreCon, afp.NombreAFP, pre.NombrePrev, lug.NombreLug, sec.NombreSector, tra.IDAFP, tra.IDPrev, tra.IDTra , tra.IDCon, NombreTra, PaternoTra, MaternoTra, Decreto, Rut, Genero, Inscripcion, Profesion, Medico, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaContrato, RutaDJur,RutaSerM, RutaSCom, RutaExaM, RutaInscripcion, Observ
                  FROM trabajador tra
                  INNER JOIN categoria cat  ON (cat.IDCat   = tra.IDCat)
                  INNER JOIN contrato con   ON (con.IDCon   = tra.IDCon)
                  INNER JOIN afp afp        ON (afp.IDAFP   = tra.IDAFP)
                  INNER JOIN lugar lug      ON (lug.IDLugar = tra.IDLugar)
                  INNER JOIN sector sec ON (sec.IDSector  = tra.IDSector)
                  INNER JOIN prevision pre ON (pre.IDPrev  = tra.IDPrev)
                  WHERE Rut='$rut' LIMIT 1";
$resultadoDatosTra = mysqli_query($conn, $sqlDatosTra);
if (mysqli_num_rows($resultadoDatosTra) == 1) {
    $persona = mysqli_fetch_assoc($resultadoDatosTra);
    $idtra = $persona['IDTra'];
    echo $idtra;

} else {
    http_response_code(400);//bad request
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
        allowOutsideClick: false,
        cancelButtonText: 'No'

      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'registro.php';
        } else {
          window.location.href = 'home.php';
        }
      });
    </script>";
}
