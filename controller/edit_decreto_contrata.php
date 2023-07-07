<?php
if (isset($_POST['iddecreto'])) {
  include("./config/conexion.php");
  $idtra = $_POST['nameidtrab'];
  $iddecreto = $_POST['iddecreto'];
echo "la id del trabajador es:".$idtra;

  $rutPersona = $_POST['nameRutt'];

  echo "el rut del trabajador es:".$rutPersona;

  $numdecreto  = $_POST['nameDecreto'];
  if ($_POST['nameSelectLugar'] != "") {
    // Si no está vacío, se asigna el valor
    $lugar = $_POST['nameSelectLugar'];
  } else {
    $lugar = NULL;
  }
  $sector = $_POST['nameSelectSector'];
  $tipoContrato = $_POST['nameSelectCon'];
  $host = $_SERVER['HTTP_HOST'];
  $ruta = 'PDFS/CONTRATA/';
  $estadoDecreto = -1;
  $fechaDocumento = $_POST['nameFechaDocumento'];
  $fechaDocumento = date('Y-m-d', strtotime($fechaDocumento));
  $inicioDecreto = $_POST['nameFechaInicio'];
  $inicioDecreto = date('Y-m-d', strtotime($inicioDecreto));
  echo "inicio decreto del trabajador es:".$inicioDecreto;
  echo "fecha doc decreto del trabajador es:".$fechaDocumento;

  if (empty($_POST['nameFechaTermino'])) {
    if ($tipoContrato != 3) {
      echo "<script> Swal.fire({
      icon: 'error',
      title: 'La fecha de término del decreto es obligatoria.',
      showConfirmButton: false,
      timer: 3000
    });</script>";
      exit();
    } else {
      $finDecreto = '2200-05-10';
    }
  } else {
    $finDecreto = $_POST['nameFechaTermino'];
    $finDecreto = date('Y-m-d', strtotime($finDecreto));
  }
  echo "fin decreto del trabajador es:".$finDecreto;

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

  if ($estadoDecreto == 1 || $estadoDecreto == 0) {
    $confirmacion = 1;
  } elseif ($estadoDecreto == 2) {
    $confirmacion = 0;
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

    $consultaFile = "SELECT * FROM trabajador WHERE IDTra = $idtra";
    $resFile = mysqli_query($conn, $consultaFile);
    if (mysqli_num_rows($resFile) == 1) {
      $RDoc = mysqli_fetch_assoc($resFile);
      $generoP    = $RDoc['Genero'];
      $inscripcionOno = $RDoc['Inscripcion'];
      $medicoOno = $RDoc['Medico'];
      $ruta_DJuradaFINAL = $RDoc['RutaDJur'];
      $ruta_EstudiosFINAL = $RDoc['RutaEstudio'];
      $ruta_CedulaFINAL = $RDoc['RutaCedula'];
      $ruta_AntecedentesFINAL = $RDoc['RutaAntec'];
      $ruta_nacFINAL = $RDoc['RutaNac'];
      $ruta_afpFINAL = $RDoc['RutaAFP'];
      $ruta_PrevisionFINAL = $RDoc['RutaPrev'];
      $ruta_CurriculumFINAL = $RDoc['RutaCV'];
      $ruta_SaludCompatFINAL = $RDoc['RutaSCom'];
      $ruta_militarFINAL = $RDoc['RutaSerM'];
      $ruta_InscripcionFINAL = $RDoc['RutaInscripcion'];
      $ruta_ExamenMFINAL = $RDoc['RutaExaM'];
    }

    if (
      // HOMBRE NO HONORARIO, NO ES MÉDICO NI PRESENTA INSCRIPCIÓN --probado
      ($generoP == "Masculino" &&
        $medicoOno == "No" &&
        $inscripcionOno == 0 &&
        !empty($ruta_DJuradaFINAL) &&
        !empty($ruta_EstudiosFINAL) &&
        !empty($ruta_CedulaFINAL) &&
        !empty($ruta_AntecedentesFINAL) &&
        !empty($ruta_nacFINAL) &&
        !empty($ruta_afpFINAL) &&
        !empty($ruta_PrevisionFINAL) &&
        !empty($ruta_CurriculumFINAL) &&
        !empty($ruta_SaludCompatFINAL) &&
        !empty($ruta_militarFINAL)
      )
      ||
      // HOMBRE NO HONORARIO, ES MÉDICO Y PRESENTA INSCRIPCIÓN --probado
      ($generoP == "Masculino" &&
        $medicoOno == "Si" &&
        $inscripcionOno == 1 &&
        !empty($ruta_DJuradaFINAL) &&
        !empty($ruta_EstudiosFINAL) &&
        !empty($ruta_CedulaFINAL) &&
        !empty($ruta_AntecedentesFINAL) &&
        !empty($ruta_nacFINAL) &&
        !empty($ruta_afpFINAL) &&
        !empty($ruta_PrevisionFINAL) &&
        !empty($ruta_CurriculumFINAL) &&
        !empty($ruta_SaludCompatFINAL) &&
        !empty($ruta_militarFINAL) &&
        !empty($ruta_InscripcionFINAL) &&
        !empty($ruta_ExamenMFINAL)
      )
      ||
      // HOMBRE NO HONORARIO, ES MÉDICO Y NO PRESENTA INSCRIPCIÓN --probado
      ($generoP == "Masculino" &&
        $medicoOno == "Si" &&
        $inscripcionOno == 0 &&
        !empty($ruta_DJuradaFINAL) &&
        !empty($ruta_EstudiosFINAL) &&
        !empty($ruta_CedulaFINAL) &&
        !empty($ruta_AntecedentesFINAL) &&
        !empty($ruta_nacFINAL) &&
        !empty($ruta_afpFINAL) &&
        !empty($ruta_PrevisionFINAL) &&
        !empty($ruta_CurriculumFINAL) &&
        !empty($ruta_SaludCompatFINAL) &&
        !empty($ruta_militarFINAL) &&
        !empty($ruta_ExamenMFINAL)
      )
      ||
      // HOMBRE NO HONORARIO, NO ES MÉDICO Y PRESENTA INSCRIPCIÓN --probado
      ($generoP == "Masculino" &&
        $medicoOno == "No" &&
        $inscripcionOno == 1 &&
        !empty($ruta_DJuradaFINAL) &&
        !empty($ruta_EstudiosFINAL) &&
        !empty($ruta_CedulaFINAL) &&
        !empty($ruta_AntecedentesFINAL) &&
        !empty($ruta_nacFINAL) &&
        !empty($ruta_afpFINAL) &&
        !empty($ruta_PrevisionFINAL) &&
        !empty($ruta_CurriculumFINAL) &&
        !empty($ruta_SaludCompatFINAL) &&
        !empty($ruta_militarFINAL) &&
        !empty($ruta_InscripcionFINAL)
      )
      ||
      // MUJER NO HONORARIO, ES MÉDICO Y PRESENTA INSCRIPCIÓN --probado
      ($generoP == "Femenino" &&
        $medicoOno == "Si" &&
        $inscripcionOno == 1 &&
        !empty($ruta_DJuradaFINAL) &&
        !empty($ruta_EstudiosFINAL) &&
        !empty($ruta_CedulaFINAL) &&
        !empty($ruta_AntecedentesFINAL) &&
        !empty($ruta_nacFINAL) &&
        !empty($ruta_afpFINAL) &&
        !empty($ruta_PrevisionFINAL) &&
        !empty($ruta_CurriculumFINAL) &&
        !empty($ruta_SaludCompatFINAL) &&
        !empty($ruta_InscripcionFINAL) &&
        !empty($ruta_ExamenMFINAL)
      )
      ||
      // MUJER NO HONORARIO, ES MÉDICO Y NO PRESENTA INSCRIPCIÓN --probado
      ($generoP == "Femenino" &&
        $medicoOno == "Si" &&
        $inscripcionOno == 0 &&
        !empty($ruta_DJuradaFINAL) &&
        !empty($ruta_EstudiosFINAL) &&
        !empty($ruta_CedulaFINAL) &&
        !empty($ruta_AntecedentesFINAL) &&
        !empty($ruta_nacFINAL) &&
        !empty($ruta_afpFINAL) &&
        !empty($ruta_PrevisionFINAL) &&
        !empty($ruta_CurriculumFINAL) &&
        !empty($ruta_SaludCompatFINAL) &&
        !empty($ruta_ExamenMFINAL)
      )
      ||
      // MUJER NO HONORARIO, NO ES MÉDICO Y PRESENTA INSCRIPCIÓN --probado
      ($generoP == "Femenino" &&
        $medicoOno == "No" &&
        $inscripcionOno == 1 &&
        !empty($ruta_DJuradaFINAL) &&
        !empty($ruta_EstudiosFINAL) &&
        !empty($ruta_CedulaFINAL) &&
        !empty($ruta_AntecedentesFINAL) &&
        !empty($ruta_nacFINAL) &&
        !empty($ruta_afpFINAL) &&
        !empty($ruta_PrevisionFINAL) &&
        !empty($ruta_CurriculumFINAL) &&
        !empty($ruta_SaludCompatFINAL) &&
        !empty($ruta_InscripcionFINAL)
      )
      ||
      // MUJER NO HONORARIO, NO ES MÉDICO Y NO PRESENTA INSCRIPCIÓN --probado
      ($generoP == "Femenino" &&
        $medicoOno == "No" &&
        $inscripcionOno == 0 &&
        !empty($ruta_DJuradaFINAL) &&
        !empty($ruta_EstudiosFINAL) &&
        !empty($ruta_CedulaFINAL) &&
        !empty($ruta_AntecedentesFINAL) &&
        !empty($ruta_nacFINAL) &&
        !empty($ruta_afpFINAL) &&
        !empty($ruta_PrevisionFINAL) &&
        !empty($ruta_CurriculumFINAL) &&
        !empty($ruta_SaludCompatFINAL)
      )
    ) {
      $cumple = 1;
    } else {
      $cumple = 0;
    }

    $sqlDecretos = "UPDATE decretos SET
    IDCon = $tipoContrato,
    IDLugar = $lugar,
    IDSector = $sector,
    NDecreto = $numdecreto,
    RutaCon = '$ruta_ContratoFINAL',
    FechaDoc = '$fechaDocumento',
    FechaInicio = '$inicioDecreto',
    FechaTermino = '$finDecreto',
    FechaAlerta = '$fechaAlerta',
    Estado = $estadoDecreto
    WHERE IDdecreto = $iddecreto";

echo "la consulta es: " . $sqlDecretos;



    $sqlcumple = "UPDATE trabajador SET Cumple = $cumple WHERE IDTra =$idtra";
    try {
      $resultadoDecretos = mysqli_query($conn, $sqlDecretos);
      $actualizacumple = mysqli_query($conn, $sqlcumple);

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
      })
    </script>";

        
      }
    } catch (Exception $e) {
      http_response_code(400);
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
    http_response_code(400);

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













