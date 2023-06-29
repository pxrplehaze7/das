<?php
include("./config/conexion.php");

$idtra = $_POST['laid'];
$rutPersona = $_POST['nameRut'];
$numdecreto  = $_POST['nameDecreto'];
if ($_POST['nameSelectLugar'] != "") {
  // Si no está vacío, se asigna el valor
  $lugar = $_POST['nameSelectLugar'];
} else {
  $lugar = NULL;
}
$sector = $_POST['nameSelectSector'];
$tipoContrato = $_POST['nameSelectCon'];
$confirmacion = FALSE;
$host = $_SERVER['HTTP_HOST'];
$ruta = 'pdfs_personal/';
$estadoDecreto = -1;

$fechaDocumento = $_POST['nameFechaDocumento'];
$fechaDocumento = date('Y-m-d', strtotime($fechaDocumento));

$inicioDecreto = $_POST['nameFechaInicio'];
$inicioDecreto = date('Y-m-d', strtotime($inicioDecreto));

$finDecreto = $_POST['nameFechaTermino'];
$finDecreto = date('Y-m-d', strtotime($finDecreto));

$fechaActual = new DateTime('now', new DateTimeZone('America/Santiago'));
$fechaActual = $fechaActual->format('Y-m-d');
$fechaSubidaCon = date('d-m-y');
$fechaAlerta = date('Y-m-d', strtotime('-5 day', strtotime($finDecreto)));

$carpetaIdtra = $ruta . $idtra . '/';
$carpetaContrato = $carpetaIdtra . 'CONTRATO/';

if (!file_exists($carpetaIdtra)) {
  mkdir($carpetaIdtra, 0777, true);
}

if (!file_exists($carpetaContrato)) {
  mkdir($carpetaContrato, 0777, true);
}

if ($fechaActual < $fechaAlerta) {
  $estadoDecreto = 1;
} elseif ($fechaActual >= $fechaAlerta && $fechaActual < $finDecreto) {
  $estadoDecreto = 2;
} elseif ($fechaActual > $finDecreto) {
  $estadoDecreto = 0;
}

$lugar = mysqli_real_escape_string($conn, $lugar);
$sector = mysqli_real_escape_string($conn, $sector);
$numdecreto = mysqli_real_escape_string($conn, $numdecreto);

$pdfContrato = (!empty($_FILES['nameDocContratoInput']['name'])) ? uniqid() . '.pdf' : '';

if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM trabajador WHERE Rut = '$rutPersona'")) > 0) {

  $ruta_ContratoFINAL = NULL;

  if (!empty($pdfContrato)) {
    $nombreContrato = 'CONTRATO_' . str_replace('-', '_', $fechaSubidaCon) . '_' . $pdfContrato;
    $ruta_ContratoFINAL = $carpetaContrato . $nombreContrato;
    move_uploaded_file($_FILES['nameDocContratoInput']['tmp_name'], $ruta_ContratoFINAL);
    $ruta_ContratoFINAL = 'http://' . $host . '/das/controller/' . $ruta_ContratoFINAL;
  }

  $sqlDecretos = "INSERT INTO decretos (IDTra,IDCon,IDLugar,IDSector,NDecreto,FechaDoc,RutaCon,FechaInicio,FechaTermino,FechaAlerta,Estado,Confirmacion)
    VALUES ('$idtra','$tipoContrato','$lugar','$sector','$numdecreto','$fechaDocumento','$ruta_ContratoFINAL','$inicioDecreto','$finDecreto','$fechaAlerta','$estadoDecreto','$confirmacion')";

  $sqlcumple = "UPDATE trabajador
SET Cumple = 0
WHERE IDTra = $idtra
AND EXISTS (
  SELECT 1
  FROM decretos
  WHERE decretos.IDTra = trabajador.IDTra
  AND decretos.Estado = 0
  AND decretos.Confirmacion = 0
)";

  try {
    $resultadoDecretos = mysqli_query($conn, $sqlDecretos);
    $actualizacumple = mysqli_query($conn, $sqlcumple);

    if ((!$resultadoDecretos) && (!$actualizacumple)) {
      throw new Exception(mysqli_error($conn));
    } else {
      echo "<script> Swal.fire({
        icon: 'success',
        title: 'Guardado Correctamente',
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#009CFD'
      });</script>";

      echo "<script>
      var inputs = document.querySelectorAll('input:not(#idRutInputdec):not(#idPersona)');
      for (var i = 0; i < inputs.length; i++) {
          inputs[i].value = '';
      }
  </script>";
    }
  } catch (Exception $e) {
    echo "<script> 
    Swal.fire({
      icon: 'error',
      title: 'Error al guardar los archivos: " . $e->getMessage() . "',
      showConfirmButton: true,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#009CFD'
    });
    </script>";
  }
} else {
  echo "<script> Swal.fire({
    icon: 'error',
    title: 'El rut no existe, no se han subido archivos.',
    showConfirmButton: false,
    timer: 3000
  });</script>";
  exit();
}

mysqli_close($conn);
