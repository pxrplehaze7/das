<?php
include("./config/conexion.php");
$idh = $_POST['idh'];
$rutHonorario = $_POST['nameRutEditar'];
$host = $_SERVER['HTTP_HOST'];

// Obtén la fecha actual en la zona horaria correcta
$fechaActual = new DateTime('now', new DateTimeZone('America/Santiago'));
$fechaActual = $fechaActual->format('d-m-Y');

// CARPETA DONDE SE GUARDARAN CARPETAS SEGUN LA ID
$ruta = 'PDFS/HONORARIO/';
$pdfAntecedentes = (!empty($_FILES['nameANTECEdocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfCedula = (!empty($_FILES['nameCeduladocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfCurriculum = (!empty($_FILES['nameCVdocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfExamenM = (!empty($_FILES['nameExaMdocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfEstudios = (!empty($_FILES['nameEstudiodocEDIT']['name'])) ? uniqid() . '.pdf' : '';
$pdfInscripcion = (!empty($_FILES['nameInscripdocEDIT']['name'])) ? uniqid() . '.pdf' : '';

$consultaFile = "SELECT * FROM honorario WHERE Rut = '$rutHonorario'";
$resFile = mysqli_query($conn, $consultaFile);
if (mysqli_num_rows($resFile) == 1) {
  $EditP = mysqli_fetch_assoc($resFile);
  $generoP    = $EditP['Genero'];
  $inscripcionOno = $EditP['Inscripcion'];
  $medicoOno = $EditP['Medico'];
  $idHonorario = $EditP['IDTraH'];
}

// REVISA SI EL RUT EXISTE EN LA BASE DE DATOS
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM honorario WHERE Rut = '$rutHonorario'")) > 0) {

  // SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
 
  if (!empty($pdfAntecedentes)) {
    $nombreAntecedentes = 'ANTECEDENTES_' . str_replace('-', '_', $fechaActual) . '_' . $pdfAntecedentes;
    $ruta_AntecedentesFINAL = $ruta . $idHonorario . '/' . $nombreAntecedentes;
    move_uploaded_file($_FILES['nameANTECEdocEDIT']['tmp_name'], $ruta_AntecedentesFINAL);
    $ruta_AntecedentesFINAL = 'http://' . $host . '/das/controller/' . $ruta_AntecedentesFINAL;
  } else {
    $ruta_AntecedentesFINAL = $EditP['RutaAntec'];
  }
  
  if (!empty($pdfCedula)) {
    $nombreCedula = 'CEDULA_' . str_replace('-', '_', $fechaActual) . '_' . $pdfCedula;
    $ruta_CedulaFINAL = $ruta . $idHonorario . '/' . $nombreCedula;
    move_uploaded_file($_FILES['nameCeduladocEDIT']['tmp_name'], $ruta_CedulaFINAL);
    $ruta_CedulaFINAL = 'http://' . $host . '/das/controller/' . $ruta_CedulaFINAL;
  } else {
    $ruta_CedulaFINAL = $EditP['RutaCedula'];
  }
  if (!empty($pdfCurriculum)) {
    $nombreCurriculum = 'CURRICULUM_' . str_replace('-', '_', $fechaActual) . '_' . $pdfCurriculum;
    $ruta_CurriculumFINAL = $ruta . $idHonorario . '/' . $nombreCurriculum;
    move_uploaded_file($_FILES['nameCVdocEDIT']['tmp_name'], $ruta_CurriculumFINAL);
    $ruta_CurriculumFINAL = 'http://' . $host . '/das/controller/' . $ruta_CurriculumFINAL;
  } else {
    $ruta_CurriculumFINAL = $EditP['RutaCV'];
  }
  if (!empty($pdfExamenM)) {
    $nombreExamenM = 'EUNACOM_' . str_replace('-', '_', $fechaActual) . '_' . $pdfExamenM;
    $ruta_ExamenMFINAL = $ruta . $idHonorario . '/' . $nombreExamenM;
    move_uploaded_file($_FILES['nameExaMdocEDIT']['tmp_name'], $ruta_ExamenMFINAL);
    $ruta_ExamenMFINAL = 'http://' . $host . '/das/controller/' . $ruta_ExamenMFINAL;
  } else {
    $ruta_ExamenMFINAL = $EditP['RutaExaM'];
  }
 
  if (!empty($pdfEstudios)) {
    $nombreEstudios = 'ESTUDIOS_' . str_replace('-', '_', $fechaActual) . '_' . $pdfEstudios;
    $ruta_EstudiosFINAL = $ruta . $idHonorario . '/' . $nombreEstudios;
    move_uploaded_file($_FILES['nameEstudiodocEDIT']['tmp_name'], $ruta_EstudiosFINAL);
    $ruta_EstudiosFINAL = 'http://' . $host . '/das/controller/' . $ruta_EstudiosFINAL;
  } else {
    $ruta_EstudiosFINAL = $EditP['RutaEstudio'];
  }
  
  if (!empty($pdfInscripcion)) {
    $nombreInscripcion = 'INSCRIPCION_' . str_replace('-', '_', $fechaActual) . '_' . $pdfInscripcion;
    $ruta_InscripcionFINAL = $ruta . $idHonorario . '/' . $nombreInscripcion;
    move_uploaded_file($_FILES['nameInscripdocEDIT']['tmp_name'], $ruta_InscripcionFINAL);
    $ruta_InscripcionFINAL = 'http://' . $host . '/das/controller/' . $ruta_InscripcionFINAL;
  } else {
    $ruta_InscripcionFINAL = $EditP['RutaInscripcion'];
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


  // SE INSERTAN DATOS A LA BASE DE DATOS
  $sqlHonoEdit = " UPDATE honorario SET 
    RutaAntec = '$ruta_AntecedentesFINAL',
    RutaCV = '$ruta_CurriculumFINAL',
    RutaCedula = '$ruta_CedulaFINAL',
    RutaEstudio = '$ruta_EstudiosFINAL',
    RutaExaM = '$ruta_ExamenMFINAL',
    RutaInscripcion = '$ruta_InscripcionFINAL',
    Cumple = '$cumple'
    WHERE Rut = '$rutHonorario'";

  try {
    $resultado = mysqli_query($conn, $sqlHonoEdit);
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
      $files = glob($ruta . $idHonorario . '/*');
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
