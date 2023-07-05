<?php
if (isset($_POST['idhonorario'])) {
include("./config/conexion.php");
$idtraH = $_POST['idhonorario'];
$rutPersona = $_POST['nameRut'];
$numdecreto  = $_POST['nameDecreto'];
if ($_POST['nameSelectLugar'] != "") {
  // Si no está vacío, se asigna el valor
  $lugar = $_POST['nameSelectLugar'];
} else {
  $lugar = NULL;
}
$sector = $_POST['nameSelectSector'];
$host = $_SERVER['HTTP_HOST'];
$ruta = 'PDFS/HONORARIO/';
$estadoDecreto = -1;
$tipoHonorario = $_POST['nametipoh'];
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

$carpetaIDH = $ruta . $idtraH . '/';
$carpetaContratoH = $carpetaIDH . 'CONTRATO/';

if (!file_exists($carpetaIDH)) {
  mkdir($carpetaIDH, 0777, true);
}

if (!file_exists($carpetaContratoH)) {
  mkdir($carpetaContratoH, 0777, true);
}

if ($fechaActual < $fechaAlerta) {
  $estadoDecreto = 1;
} elseif ($fechaActual >= $fechaAlerta && $fechaActual < $finDecreto) {
  $estadoDecreto = 2;
} elseif ($fechaActual > $finDecreto) {
  $estadoDecreto = 0;
}

if ($estadoDecreto == 1 || $estadoDecreto == 0) {
  $confirmacion = 1;
} elseif ($estadoDecreto == 2) {
  $confirmacion = 0;
}


$lugar = mysqli_real_escape_string($conn, $lugar);
$sector = mysqli_real_escape_string($conn, $sector);
$numdecreto = mysqli_real_escape_string($conn, $numdecreto);

$pdfContrato = (!empty($_FILES['nameDocContratoInput']['name'])) ? uniqid() . '.pdf' : '';

if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM honorario WHERE Rut = '$rutPersona'")) > 0) {

  $ruta_ContratoFINAL = NULL;

  if (!empty($pdfContrato)) {
    $nombreContrato = 'CONTRATO_' . str_replace('-', '_', $fechaSubidaCon) . '_' . $pdfContrato;
    $ruta_ContratoFINAL = $carpetaContratoH . $nombreContrato;
    move_uploaded_file($_FILES['nameDocContratoInput']['tmp_name'], $ruta_ContratoFINAL);
    $ruta_ContratoFINAL = 'http://' . $host . '/das/controller/' . $ruta_ContratoFINAL;
  }



  $consultaFile = "SELECT * FROM honorario WHERE IDTraH = '$idtraH'";
  $resFile = mysqli_query($conn, $consultaFile);
  if (mysqli_num_rows($resFile) == 1) {
    $RDoc = mysqli_fetch_assoc($resFile);
    $generoP    = $RDoc['Genero'];
    $inscripcionOno = $RDoc['Inscripcion'];
    $medicoOno = $RDoc['Medico'];
    $ruta_EstudiosFINAL = $RDoc['RutaEstudio'];
    $ruta_CedulaFINAL = $RDoc['RutaCedula'];
    $ruta_AntecedentesFINAL = $RDoc['RutaAntec'];
    $ruta_CurriculumFINAL = $RDoc['RutaCV'];
    $ruta_InscripcionFINAL = $RDoc['RutaInscripcion'];
    $ruta_ExamenMFINAL = $RDoc['RutaExaM'];
  }


  if (
    // HONORARIO HOMBRE O MUJER ES MÉDICO Y PRESENTA INSCRIPCIÓN -- probado
    (
      $medicoOno == "Si" &&
      $inscripcionOno == 1 &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_InscripcionFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_ExamenMFINAL) &&
      !empty($ruta_AntecedentesFINAL))
    ||
    // HONORARIO HOMBRE O MUJER ES MÉDICO Y NO PRESENTA INSCRIPCIÓN --probado
    (
      $medicoOno == "Si" &&
      $inscripcionOno == 0 &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_ExamenMFINAL) &&
      !empty($ruta_AntecedentesFINAL))
    ||
    // HONORARIO HOMBRE O MUJER QUE NO ES MÉDICO PERO PRESENTA INSCRIPCIÓN --probado
    (
      $medicoOno == "No" &&
      $inscripcionOno == 1 &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_InscripcionFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_AntecedentesFINAL))
    ||
    // HONORARIO HOMBRE O MUJER QUE NO ES MÉDICO NI PRESENTA INSCRIPCIÓN --probado
    (
      $medicoOno == "No" &&
      $inscripcionOno == 0 &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_AntecedentesFINAL)
    )
  ) {
    $cumple = 1;
  } else {
    $cumple = 0;
  }



  $sqlDecretos = "INSERT INTO decretosh (IDTraH,TipodeHono,IDLugar,IDSector,NDecreto,FechaDoc,RutaCon,FechaInicio,FechaTermino,FechaAlerta,Estado,Confirmacion)
    VALUES ('$idtraH','$tipoHonorario','$lugar','$sector','$numdecreto','$fechaDocumento','$ruta_ContratoFINAL','$inicioDecreto','$finDecreto','$fechaAlerta','$estadoDecreto','$confirmacion')";

  $sqlcumpleH = "UPDATE honorario SET Cumple = $cumple WHERE IDTraH = $idtraH";
  echo $sqlcumpleH;

  try {
    $resultadoDecretos = mysqli_query($conn, $sqlDecretos);
    $actualizacumple = mysqli_query($conn, $sqlcumpleH);

    if ((!$resultadoDecretos) && (!$actualizacumple)) {
      throw new Exception(mysqli_error($conn));
    } else {
      echo "<script>
      Swal.fire({
        icon: 'success',
        title: 'Guardado Correctamente',
        showCancelButton: false,
        cancelButtonText: 'No',
        confirmButtonText: 'OK',
        confirmButtonColor: '#009CFD'
      }).then((result) => {
        if (result.isConfirmed) {
          // Limpiar los input y select
          var inputs = document.querySelectorAll('input:not(#idRutInputdec):not(#idPersona)');
          for (var i = 0; i < inputs.length; i++) {
            inputs[i].value = '';
          }
          var selects = document.querySelectorAll('select');
          for (var i = 0; i < selects.length; i++) {
            selects[i].selectedIndex = 0;
          }
        } else {
          // Redireccionar a info_honorario.php
          location.href = 'info_honorario.php?id=$idtraH';
        }
      });
    </script>";

      // Agregar el código para preguntar si desea registrar otro decreto
      echo "<script>
      function registrarOtroDecretos() {
        Swal.fire({
          icon: 'question',
          title: '¿Desea registrar otro decreto?',
          showCancelButton: true,
          cancelButtonText: 'No',
          confirmButtonText: 'Sí',
          confirmButtonColor: '#00c4a0',
          cancelButtonColor: '#ba0051'
        }).then((result) => {
          if (result.isConfirmed) {
            // Limpiar los input y select
            var inputs = document.querySelectorAll('input:not(#idRutInputdec):not(#idPersona)');
            for (var i = 0; i < inputs.length; i++) {
              inputs[i].value = '';
            }
            var selects = document.querySelectorAll('select');
            for (var i = 0; i < selects.length; i++) {
              selects[i].selectedIndex = 0;
            }
            document.getElementById('idSelectSector').value = '';

          } else {
            // Redireccionar a info_honorario.php
            location.href = 'info_honorario.php?idh=$idtraH';
           
          }
        });
      }
      registrarOtroDecretos();
    </script>";
    }
  } catch (Exception $e) {
    http_response_code(400); // Bad request
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
  http_response_code(400); // Bad request

  echo "<script> Swal.fire({
    icon: 'error',
    title: 'El rut no existe, no se han subido archivos.',
    showConfirmButton: false,
    timer: 3000
  });</script>";
  exit();
}
mysqli_close($conn);
} else {
  // No se ha recibido una ID válida, mostrar mensaje de error o realizar acciones adicionales
  echo "No se ha recibido una ID válida";
  exit();
}
?>