<?php
include("./config/conexion.php");
$idtrab = $_POST['laid'];
$rutPersona = $_POST['nameRutEditar'];
$host = $_SERVER['HTTP_HOST'];

// Obtén la fecha actual en la zona horaria correcta
$fechaActual = new DateTime('now', new DateTimeZone('America/Santiago'));
$fechaActual = $fechaActual->format('d-m-Y');

// CARPETA DONDE SE GUARDARAN CARPETAS SEGUN LA ID
$ruta = 'PDFS/CONTRATA_E_INDEFINIDOS/';
$pdfNacimiento = (!empty($_FILES['nameNACdocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfAntecedentes = (!empty($_FILES['nameANTECEdocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfAFP = (!empty($_FILES['nameAFPdocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfMilitar = (!empty($_FILES['nameMilitarDocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfCedula = (!empty($_FILES['nameCeduladocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfCurriculum = (!empty($_FILES['nameCVdocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfExamenM = (!empty($_FILES['nameExaMdocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfPrevision = (!empty($_FILES['namePREVdocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfEstudios = (!empty($_FILES['nameEstudiodocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfDJurada = (!empty($_FILES['nameDJuradadocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfSaludCompat = (!empty($_FILES['nameSCompatibledocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfInscripcion = (!empty($_FILES['nameInscripdocEDIT']['name'])) ? uniqid() . '.pdf' : '';


// CARPETAS CON NOMBRE LA ID, SI NO EXISTE LA CREA
if (!file_exists($ruta . $idtrab)) {
  mkdir($ruta . $idtrab, 0777, true);
}

$consultaFile = "SELECT * FROM trabajador WHERE Rut = '$rutPersona'";
$resFile = mysqli_query($conn, $consultaFile);
if (mysqli_num_rows($resFile) == 1) {
  $EditP = mysqli_fetch_assoc($resFile);
  $generoP    = $EditP['Genero'];
  $inscripcionOno = $EditP['Inscripcion'];
  $medicoOno = $EditP['Medico'];
  $idt = $EditP['IDTra'];
}

// REVISA SI EL RUT EXISTE EN LA BASE DE DATOS
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM trabajador WHERE Rut = '$rutPersona'")) > 0) {

  // SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfNacimiento)) {
    $nombreNacimiento = 'CNACIMIENTO_' . str_replace('-', '_', $fechaActual) . '_' . $pdfNacimiento;
    $ruta_nacFINAL = $ruta . $idt . '/' . $nombreNacimiento;
    move_uploaded_file($_FILES['nameNACdocEDIT']['tmp_name'], $ruta_nacFINAL);
    $ruta_nacFINAL = 'http://' . $host . '/das/controller/' . $ruta_nacFINAL;
  } else {
    $ruta_nacFINAL = $EditP['RutaNac'];
  }
  if (!empty($pdfAntecedentes)) {
    $nombreAntecedentes = 'ANTECEDENTES_' . str_replace('-', '_', $fechaActual) . '_' . $pdfAntecedentes;
    $ruta_AntecedentesFINAL = $ruta . $idt . '/' . $nombreAntecedentes;
    move_uploaded_file($_FILES['nameANTECEdocEDIT']['tmp_name'], $ruta_AntecedentesFINAL);
    $ruta_AntecedentesFINAL = 'http://' . $host . '/das/controller/' . $ruta_AntecedentesFINAL;
  } else {
    $ruta_AntecedentesFINAL = $EditP['RutaAntec'];
  }
  if (!empty($pdfAFP)) {
    $nombreAFP = 'AFP_' . str_replace('-', '_', $fechaActual) . '_' . $pdfAFP;
    $ruta_afpFINAL = $ruta . $idt . '/' . $nombreAFP;
    move_uploaded_file($_FILES['nameAFPdocEDIT']['tmp_name'], $ruta_afpFINAL);
    $ruta_afpFINAL = 'http://' . $host . '/das/controller/' . $ruta_afpFINAL;
  } else {
    $ruta_afpFINAL = $EditP['RutaAFP'];
  }
  if (!empty($pdfMilitar)) {
    $nombreMilitar = 'SMILITAR_' . str_replace('-', '_', $fechaActual) . '_' . $pdfMilitar;
    $ruta_militarFINAL = $ruta . $idt . '/' . $nombreMilitar;
    move_uploaded_file($_FILES['nameMilitarDocEDIT']['tmp_name'], $ruta_militarFINAL);
    $ruta_militarFINAL = 'http://' . $host . '/das/controller/' . $ruta_militarFINAL;
  } else {
    $ruta_militarFINAL = $EditP['RutaSerM'];
  }
  if (!empty($pdfCedula)) {
    $nombreCedula = 'CEDULA_' . str_replace('-', '_', $fechaActual) . '_' . $pdfCedula;
    $ruta_CedulaFINAL = $ruta . $idt . '/' . $nombreCedula;
    move_uploaded_file($_FILES['nameCeduladocEDIT']['tmp_name'], $ruta_CedulaFINAL);
    $ruta_CedulaFINAL = 'http://' . $host . '/das/controller/' . $ruta_CedulaFINAL;
  } else {
    $ruta_CedulaFINAL = $EditP['RutaCedula'];
  }
  if (!empty($pdfCurriculum)) {
    $nombreCurriculum = 'CURRICULUM_' . str_replace('-', '_', $fechaActual) . '_' . $pdfCurriculum;
    $ruta_CurriculumFINAL = $ruta . $idt . '/' . $nombreCurriculum;
    move_uploaded_file($_FILES['nameCVdocEDIT']['tmp_name'], $ruta_CurriculumFINAL);
    $ruta_CurriculumFINAL = 'http://' . $host . '/das/controller/' . $ruta_CurriculumFINAL;
  } else {
    $ruta_CurriculumFINAL = $EditP['RutaCV'];
  }
  if (!empty($pdfExamenM)) {
    $nombreExamenM = 'EUNACOM_' . str_replace('-', '_', $fechaActual) . '_' . $pdfExamenM;
    $ruta_ExamenMFINAL = $ruta . $idt . '/' . $nombreExamenM;
    move_uploaded_file($_FILES['nameExaMdocEDIT']['tmp_name'], $ruta_ExamenMFINAL);
    $ruta_ExamenMFINAL = 'http://' . $host . '/das/controller/' . $ruta_ExamenMFINAL;
  } else {
    $ruta_ExamenMFINAL = $EditP['RutaExaM'];
  }
  if (!empty($pdfPrevision)) {
    $nombrePrevision = 'PREVISION_' . str_replace('-', '_', $fechaActual) . '_' . $pdfPrevision;
    $ruta_PrevisionFINAL = $ruta . $idt . '/' . $nombrePrevision;
    move_uploaded_file($_FILES['namePREVdocEDIT']['tmp_name'], $ruta_PrevisionFINAL);
    $ruta_PrevisionFINAL = 'http://' . $host . '/das/controller/' . $ruta_PrevisionFINAL;
  } else {
    $ruta_PrevisionFINAL = $EditP['RutaPrev'];
  }
  if (!empty($pdfEstudios)) {
    $nombreEstudios = 'ESTUDIOS_' . str_replace('-', '_', $fechaActual) . '_' . $pdfEstudios;
    $ruta_EstudiosFINAL = $ruta . $idt . '/' . $nombreEstudios;
    move_uploaded_file($_FILES['nameEstudiodocEDIT']['tmp_name'], $ruta_EstudiosFINAL);
    $ruta_EstudiosFINAL = 'http://' . $host . '/das/controller/' . $ruta_EstudiosFINAL;
  } else {
    $ruta_EstudiosFINAL = $EditP['RutaEstudio'];
  }
  if (!empty($pdfDJurada)) {
    $nombreDJurada = 'DJURADA_' . str_replace('-', '_', $fechaActual) . '_' . $pdfDJurada;
    $ruta_DJuradaFINAL = $ruta . $idt . '/' . $nombreDJurada;
    move_uploaded_file($_FILES['nameDJuradadocEDIT']['tmp_name'], $ruta_DJuradaFINAL);
    $ruta_DJuradaFINAL = 'http://' . $host . '/das/controller/' . $ruta_DJuradaFINAL;
  } else {
    $ruta_DJuradaFINAL = $EditP['RutaDJur'];
  }
  if (!empty($pdfSaludCompat)) {
    $nombreSaludCompat = 'SCOMPATIBLE_' . str_replace('-', '_', $fechaActual) . '_' . $pdfSaludCompat;
    $ruta_SaludCompatFINAL = $ruta . $idt . '/' . $nombreSaludCompat;
    move_uploaded_file($_FILES['nameSCompatibledocEDIT']['tmp_name'], $ruta_SaludCompatFINAL);
    $ruta_SaludCompatFINAL = 'http://' . $host . '/das/controller/' . $ruta_SaludCompatFINAL;
  } else {
    $ruta_SaludCompatFINAL = $EditP['RutaSCom'];
  }
 
  if (!empty($pdfInscripcion)) {
    $nombreInscripcion = 'INSCRIPCION_' . str_replace('-', '_', $fechaActual) . '_' . $pdfInscripcion;
    $ruta_InscripcionFINAL = $ruta . $idt . '/' . $nombreInscripcion;
    move_uploaded_file($_FILES['nameInscripdocEDIT']['tmp_name'], $ruta_InscripcionFINAL);
    $ruta_InscripcionFINAL = 'http://' . $host . '/das/controller/' . $ruta_InscripcionFINAL;
  } else {
    $ruta_InscripcionFINAL = $EditP['RutaInscripcion'];
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


  // SE INSERTAN DATOS A LA BASE DE DATOS
  $sqlTraEdit = " UPDATE trabajador SET 
    RutaNac = '$ruta_nacFINAL',
    RutaAntec = '$ruta_AntecedentesFINAL',
    RutaPrev = '$ruta_PrevisionFINAL',
    RutaCV = '$ruta_CurriculumFINAL',
    RutaAFP = '$ruta_afpFINAL',
    RutaCedula = '$ruta_CedulaFINAL',
    RutaEstudio = '$ruta_EstudiosFINAL',
    RutaDJur = '$ruta_DJuradaFINAL',
    RutaSerM = '$ruta_militarFINAL',
    RutaSCom = '$ruta_SaludCompatFINAL',
    RutaExaM = '$ruta_ExamenMFINAL',
    RutaInscripcion = '$ruta_InscripcionFINAL',
    Cumple = '$cumple'
    WHERE Rut = '$rutPersona'";

  try {
    $resultado = mysqli_query($conn, $sqlTraEdit);
    if (!$resultado) {
      throw new Exception(mysqli_error($conn));
    } else {
      echo "<script> Swal.fire({
        icon: 'success',
        title: 'Guardado Correctamente',
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#009CFD' }).then(() => {
          location.reload(); // Recarga la página
        });
      </script>";
      echo "<script>
      var inputs = document.querySelectorAll('input.tipofile');
      for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
      }
    </script>
    ";
    }
  } catch (Exception $e) {
    if (file_exists($ruta . $idt)) {
      $files = glob($ruta . $idt . '/*');
      foreach ($files as $file) {
        if (is_file($file)) {
          unlink($file);
        }
      }
      rmdir($ruta . $idt);
    }
    echo "<script> 
    Swal.fire({
      icon: 'error',
      title: `Error al guardar los archivos: " . $e->getMessage() . "`,
      showConfirmButton: true,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#009CFD'    });
    </script>";
  }
}
mysqli_close($conn);
