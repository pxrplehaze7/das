<?php
include("./config/conexion.php");
$sqlids = "SELECT MAX(IDTra) AS ultimoID FROM trabajador";
$resides = mysqli_query($conn, $sqlids);
$ids = mysqli_fetch_assoc($resides);
$ultimoID = $ids['ultimoID'];

if ($ultimoID === null) {
  $ultimoID = 0;
}
$idtra = $ultimoID + 1;

$rutPersona = $_POST['rut'];
$nombreP    = trim($_POST['namePersona']);
$paternoP   = trim($_POST['namePaterno']);
$maternoP   = trim($_POST['nameMaterno']);
$generoP    = $_POST['nameGenero'];
$CelularP   = $_POST['nameCelular'];
$correoP    = strtolower(trim($_POST['nameCorreo']));
$profesionP = trim($_POST['nameProfesion']);
$obsP       = $_POST['nameObserv'];
$inscripcionOno = $_POST['nameInscrip'];
$afpP       = $_POST['nameSelectAFP'];
$prevP       = $_POST['nameSelectPrev'];
$host = $_SERVER['HTTP_HOST'];
$fechaActual = new DateTime('now', new DateTimeZone('America/Santiago'));
$fechaActual = $fechaActual->format('d-m-Y');
$fechaSubidaDoc = $fechaActual;
$ruta = 'PDFS/CONTRATA_E_INDEFINIDOS/';
$fechaActual = strtotime($fechaActual);
$cumple = 0;

$categoriaP = $_POST['nameSelectCat'];
if ($categoriaP == 1) {
  // SI ES IGUAL A 1 (CATEGORIA A) TOMA EL VALOR DEL INPUT RADIO Y LO ASIGNA A LA VARIABLE
  $medicoOno  = $_POST['nameMedico'];
} else {
  //SI ES DISTINTO DE 1, SE ASIGNA UN NO
  $medicoOno  = 'No';
}

$nombreP    = mysqli_real_escape_string($conn, $nombreP);
$paternoP   = mysqli_real_escape_string($conn, $paternoP);
$maternoP   = mysqli_real_escape_string($conn, $maternoP);
$categoriaP = mysqli_real_escape_string($conn, $categoriaP);
$profesionP = mysqli_real_escape_string($conn, $profesionP);
$obsP       = mysqli_real_escape_string($conn, $obsP);
$CelularP   = str_replace(" ", "", $CelularP);
$correoP    = str_replace(" ", "", $correoP);

$pdfNacimiento = (!empty($_FILES['nameNACdoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfAntecedentes = (!empty($_FILES['nameANTECEdoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfAFP = (!empty($_FILES['nameAFPdoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfMilitar = (!empty($_FILES['nameMilitarDoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfCedula = (!empty($_FILES['nameCeduladoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfCurriculum = (!empty($_FILES['nameCVdoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfExamenM = (!empty($_FILES['nameExaMdoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfPrevision = (!empty($_FILES['namePREVdoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfEstudios = (!empty($_FILES['nameEstudiodoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfDJurada = (!empty($_FILES['nameDJuradadoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfSaludCompat = (!empty($_FILES['nameSCompatibledoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfInscripcion = (!empty($_FILES['nameInscripdoc']['name'])) ? uniqid() . '.pdf' : '';



// CARPETAS CON NOMBRE LA ID, SI NO EXISTE LA CREA
if (!file_exists($ruta . $idtra)) {
  mkdir($ruta . $idtra, 0777, true);
}

// REVISA SI EL RUT EXISTE EN LA BASE DE DATOS
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM trabajador WHERE Rut = '$rutPersona'")) > 0) {
  echo "<script> Swal.fire({
    icon: 'error',
    title: 'El rut ya existe, no se han subido archivos.',
    showConfirmButton: false,
    timer: 3000
  });</script>";
  exit();
} else {
  //SI EL RUT NO EXISTE, SE ASIGNA NULL A LA RUTA FINAL
  $ruta_afpFINAL          = NULL;
  $ruta_nacFINAL          = NULL;
  $ruta_militarFINAL      = NULL;
  $ruta_AntecedentesFINAL = NULL;
  $ruta_CedulaFINAL       = NULL;
  $ruta_CurriculumFINAL   = NULL;
  $ruta_ExamenMFINAL      = NULL;
  $ruta_PrevisionFINAL    = NULL;
  $ruta_EstudiosFINAL     = NULL;
  $ruta_DJuradaFINAL      = NULL;
  $ruta_SaludCompatFINAL  = NULL;
  $ruta_InscripcionFINAL  = NULL;

  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfAFP)) {
    // CREA EL NOMBRE DEL ARCHIVO CONCATENANDO 'afp' Y LA FECHA ACTUAL
    $nombreAFP = 'AFP_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfAFP;
    // CREA LA RUTA FINAL DEL ARCHIVO
    $ruta_afpFINAL = $ruta . $idtra . '/' . $nombreAFP;
    // EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['nameAFPdoc']['tmp_name'], $ruta_afpFINAL);
    // SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_afpFINAL = 'http://' . $host . '/das/controller/' . $ruta_afpFINAL;
  }
  // SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfNacimiento)) {
    $nombreNacimiento = 'CNACIMIENTO_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfNacimiento;
    $ruta_nacFINAL = $ruta . $idtra . '/' . $nombreNacimiento;
    move_uploaded_file($_FILES['nameNACdoc']['tmp_name'], $ruta_nacFINAL);
    $ruta_nacFINAL = 'http://' . $host . '/das/controller/' . $ruta_nacFINAL;
  }
  if (!empty($pdfMilitar)) {
    $nombreMilitar = 'SMILITAR_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfMilitar;
    $ruta_militarFINAL = $ruta . $idtra . '/' . $nombreMilitar;
    move_uploaded_file($_FILES['nameMilitarDoc']['tmp_name'], $ruta_militarFINAL);
    $ruta_militarFINAL = 'http://' . $host . '/das/controller/' . $ruta_militarFINAL;
  }
  if (!empty($pdfAntecedentes)) {
    $nombreAntecedentes = 'ANTECEDENTES_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfAntecedentes;
    $ruta_AntecedentesFINAL = $ruta . $idtra . '/' . $nombreAntecedentes;
    move_uploaded_file($_FILES['nameANTECEdoc']['tmp_name'], $ruta_AntecedentesFINAL);
    $ruta_AntecedentesFINAL = 'http://' . $host . '/das/controller/' . $ruta_AntecedentesFINAL;
  }
  if (!empty($pdfCedula)) {
    $nombreCedula = 'CEDULA_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfCedula;
    $ruta_CedulaFINAL = $ruta . $idtra . '/' . $nombreCedula;
    move_uploaded_file($_FILES['nameCeduladoc']['tmp_name'], $ruta_CedulaFINAL);
    $ruta_CedulaFINAL = 'http://' . $host . '/das/controller/' . $ruta_CedulaFINAL;
  }
  if (!empty($pdfCurriculum)) {
    $nombreCurriculum = 'CURRICULUM_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfCurriculum;
    $ruta_CurriculumFINAL = $ruta . $idtra . '/' . $nombreCurriculum;
    move_uploaded_file($_FILES['nameCVdoc']['tmp_name'], $ruta_CurriculumFINAL);
    $ruta_CurriculumFINAL = 'http://' . $host . '/das/controller/' . $ruta_CurriculumFINAL;
  }
  if (!empty($pdfExamenM)) {
    $nombreExamenM = 'EUNACOM_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfExamenM;
    $ruta_ExamenMFINAL = $ruta . $idtra . '/' . $nombreExamenM;
    move_uploaded_file($_FILES['nameExaMdoc']['tmp_name'], $ruta_ExamenMFINAL);
    $ruta_ExamenMFINAL = 'http://' . $host . '/das/controller/' . $ruta_ExamenMFINAL;
  }
  if (!empty($pdfPrevision)) {
    $nombrePrevision = 'PREVISION_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfPrevision;
    $ruta_PrevisionFINAL = $ruta . $idtra . '/' . $nombrePrevision;
    move_uploaded_file($_FILES['namePREVdoc']['tmp_name'], $ruta_PrevisionFINAL);
    $ruta_PrevisionFINAL = 'http://' . $host . '/das/controller/' . $ruta_PrevisionFINAL;
  }
  if (!empty($pdfEstudios)) {
    $nombreEstudios = 'ESTUDIOS_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfEstudios;
    $ruta_EstudiosFINAL = $ruta . $idtra . '/' . $nombreEstudios;
    move_uploaded_file($_FILES['nameEstudiodoc']['tmp_name'], $ruta_EstudiosFINAL);
    $ruta_EstudiosFINAL = 'http://' . $host . '/das/controller/' . $ruta_EstudiosFINAL;
  }
  if (!empty($pdfDJurada)) {
    $nombreDJurada = 'DJURADA_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfDJurada;
    $ruta_DJuradaFINAL = $ruta . $idtra . '/' . $nombreDJurada;
    move_uploaded_file($_FILES['nameDJuradadoc']['tmp_name'], $ruta_DJuradaFINAL);
    $ruta_DJuradaFINAL = 'http://' . $host . '/das/controller/' . $ruta_DJuradaFINAL;
  }
  if (!empty($pdfSaludCompat)) {
    $nombreSaludCompat = 'SCOMPATIBLE_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfSaludCompat;
    $ruta_SaludCompatFINAL = $ruta . $idtra . '/' . $nombreSaludCompat;
    move_uploaded_file($_FILES['nameSCompatibledoc']['tmp_name'], $ruta_SaludCompatFINAL);
    $ruta_SaludCompatFINAL = 'http://' . $host . '/das/controller/' . $ruta_SaludCompatFINAL;
  }
  if (!empty($pdfInscripcion)) {
    $nombreInscripcion = 'INSCRIPCION_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfInscripcion;
    $ruta_InscripcionFINAL = $ruta . $idtra . '/' . $nombreInscripcion;
    move_uploaded_file($_FILES['nameInscripdoc']['tmp_name'], $ruta_InscripcionFINAL);
    $ruta_InscripcionFINAL = 'http://' . $host . '/das/controller/' . $ruta_InscripcionFINAL;
  }





  $sqlTrabajador = "INSERT INTO trabajador (IDTra,IDCat,IDAFP,IDPrev,NombreTra,PaternoTra,MaternoTra,Rut,Genero,Medico,Profesion,CelularTra,CorreoTra,RutaPrev,RutaCV,RutaAFP,RutaNac,RutaAntec,RutaCedula,RutaEstudio,RutaDJur,RutaSerM,RutaSCom,RutaExaM,Observ,RutaInscripcion,Cumple,Inscripcion)
VALUES ($idtra,$categoriaP,$afpP,$prevP,'$nombreP','$paternoP','$maternoP','$rutPersona','$generoP','$medicoOno','$profesionP','$CelularP','$correoP','$ruta_PrevisionFINAL','$ruta_CurriculumFINAL','$ruta_afpFINAL','$ruta_nacFINAL','$ruta_AntecedentesFINAL','$ruta_CedulaFINAL','$ruta_EstudiosFINAL','$ruta_DJuradaFINAL','$ruta_militarFINAL','$ruta_SaludCompatFINAL','$ruta_ExamenMFINAL','$obsP','$ruta_InscripcionFINAL','$cumple','$inscripcionOno')";

  try {
    $resultadoTrabajador = mysqli_query($conn, $sqlTrabajador);

    if (!$resultadoTrabajador) {
      throw new Exception(mysqli_error($conn));
    } else {

      // echo $idtra;
      echo "<script>
      Swal.fire({
        icon: 'success',
        title: 'Guardado Correctamente',
        showConfirmButton: false,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#009CFD'
      }).then(() => {
        window.location.href = 'registro_dec_contrata.php?id=' + $idtra;
      });
    </script>";
    }
  } catch (Exception $e) {
    // SE ELIMINARAN LOS ARCHIVOS ANTES DE ELIMINAR LA CARPETA; SI HUBO ERROR EN LA INSERCION
    if (file_exists($ruta . $idtra)) {
      $files = glob($ruta . $idtra . '/*'); //SE OBTIENEN TODOS LOS ARCHIVOS DENTRO DE LA CARPETA
      foreach ($files as $file) {
        if (is_file($file)) {
          unlink($file); //SE ELIMINA CADA ARCHIVO
        }
      }
      rmdir($ruta . $idtra); //SE ELIMINA LA CARPETA VACIA
    }
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
}
mysqli_close($conn);
