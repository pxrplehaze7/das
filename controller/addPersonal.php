<?php
// CONEXION A LA BASE DE DATOS
include("./config/conexion.php");

//SE RECIBEN LOS DATOS DE LOS INPUTS DESDE EL FORM
$rutPersona = $_POST['rut'];
$nombreP    = $_POST['namePersona'];
$paternoP   = $_POST['namePaterno'];
$maternoP   = $_POST['nameMaterno'];
$generoP    = $_POST['nameGenero'];
$CelularP   = $_POST['nameCelular'];
$correoP    = $_POST['nameCorreo'];
$sector     = $_POST['nameSelectSector'];
$profesionP = $_POST['nameProfesion'];
$decreto     = $_POST['nameDecreto'];
$obsP       = $_POST['nameObserv'];
$inscripcionOno = $_POST['nameInscrip'];
$afpP       = $_POST['nameSelectAFP'];
$prevP       = $_POST['nameSelectPrev'];
$cumple = FALSE;
$host = $_SERVER['HTTP_HOST'];
$fechaActual = date('d-m-Y');

// CARPETA DONDE SE GUARDARAN CARPETAS SEGUN RUT
$ruta = 'pdfs_personal/';

// SE ASIGNA EL VALOR DEL SELECT CATEGORIA A LA VARIABLE
$categoriaP = $_POST['nameSelectCat'];
if ($categoriaP == 1) {
  // SI ES IGUAL A 1 (CATEGORIA A) TOMA EL VALOR DEL INPUT RADIO Y LO ASIGNA A LA VARIABLE
  $medicoOno  = $_POST['nameMedico'];
} else {
  //SI ES DISTINTO DE 1, SE ASIGNA UN NO
  $medicoOno  = 'No';
}


if ($_POST['nameSelectCon'] != "") {
  //SI NO ESTA VACIO, SE ASIGNA EL VALOR
  $contratoP = $_POST['nameSelectCon'];
  //SI ESTA VACIO SE ASIGNA UN NULL
} else {
  $contratoP = NULL;
}

if ($_POST['nameSelectLugar'] != "") {
  //SI NO ESTA VACIO, SE ASIGNA EL VALOR
  $lugarP = $_POST['nameSelectLugar'];
  //SI ESTA VACIO SE ASIGNA UN NULL
} else {
  $lugarP = NULL;
}




$nombreP    = mysqli_real_escape_string($conn, $nombreP);
$paternoP   = mysqli_real_escape_string($conn, $paternoP);
$maternoP   = mysqli_real_escape_string($conn, $maternoP);
$categoriaP = mysqli_real_escape_string($conn, $categoriaP);
$profesionP = mysqli_real_escape_string($conn, $profesionP);
$lugarP     = mysqli_real_escape_string($conn, $lugarP);
$sector     = mysqli_real_escape_string($conn, $sector);
$obsP       = mysqli_real_escape_string($conn, $obsP);
$decreto    = mysqli_real_escape_string($conn, $decreto);
$CelularP   = str_replace(" ", "", $CelularP); // ELIMINA ESPACIOS DE LA CADENA
$correoP    = str_replace(" ", "", $correoP); // ELIMINA ESPACIOS DE LA CADENA


//ELIMINA LOS ESPACIOS EN EL NOMBRE DEL PDF Y LOS REEMPLAZA POR _ _
$pdfAFP          = str_replace(array(' ', '(', ')'), '_', $_FILES['nameAFPdoc']['name']);
$pdfNacimiento   = str_replace(array(' ', '(', ')'), '_', $_FILES['nameNACdoc']['name']);
$pdfMilitar      = str_replace(array(' ', '(', ')'), '_', $_FILES['nameMilitarDoc']['name']);
$pdfAntecedentes = str_replace(array(' ', '(', ')'), '_', $_FILES['nameANTECEdoc']['name']);
$pdfCedula       = str_replace(array(' ', '(', ')'), '_', $_FILES['nameCeduladoc']['name']);
$pdfCurriculum   = str_replace(array(' ', '(', ')'), '_', $_FILES['nameCVdoc']['name']);
$pdfExamenM      = str_replace(array(' ', '(', ')'), '_', $_FILES['nameExaMdoc']['name']);
$pdfPrevision    = str_replace(array(' ', '(', ')'), '_', $_FILES['namePREVdoc']['name']);
$pdfEstudios     = str_replace(array(' ', '(', ')'), '_', $_FILES['nameEstudiodoc']['name']);
$pdfDJurada      = str_replace(array(' ', '(', ')'), '_', $_FILES['nameDJuradadoc']['name']);
$pdfSaludCompat  = str_replace(array(' ', '(', ')'), '_', $_FILES['nameSCompatibledoc']['name']);
$pdfContrato     = str_replace(array(' ', '(', ')'), '_', $_FILES['nameDocContratoInput']['name']);
$pdfInscripcion  = str_replace(array(' ', '(', ')'), '_', $_FILES['nameInscripdoc']['name']);


// CARPETAS CON NOMBRE SEGUN EL RUT, SI NO EXISTE LA CREA
if (!file_exists($ruta . $rutPersona)) {
  mkdir($ruta . $rutPersona, 0777, true);
}


// REVISA SI EL RUT EXISTE EN LA BASE DE DATOS
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM trabajador WHERE Rut = '$rutPersona'")) > 0) {
  echo "El rut ya existe, no se han subido archivos.";
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
  $ruta_ContratoFINAL     = NULL;
  $ruta_InscripcionFINAL  = NULL;

  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA

  if (!empty($pdfAFP)) {
    // CREA EL NOMBRE DEL ARCHIVO CONCATENANDO 'afp' Y LA FECHA ACTUAL
    $nombreAFP = 'AFP_' . str_replace('-', '_', $fechaActual) . '_' . $pdfAFP;
    // CREA LA RUTA FINAL DEL ARCHIVO
    $ruta_afpFINAL = $ruta . $rutPersona . '/' . $nombreAFP;
    // EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['nameAFPdoc']['tmp_name'], $ruta_afpFINAL);
    // SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_afpFINAL = 'http://' . $host . '/das/controller/' . $ruta_afpFINAL;
  }

  // SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfNacimiento)) {
    $nombreNacimiento = 'CNACIMIENTO_' . str_replace('-', '_', $fechaActual) . '_' . $pdfNacimiento;
    $ruta_nacFINAL = $ruta . $rutPersona . '/' . $nombreNacimiento;
    move_uploaded_file($_FILES['nameNACdoc']['tmp_name'], $ruta_nacFINAL);
    $ruta_nacFINAL = 'http://' . $host . '/das/controller/' . $ruta_nacFINAL;
  }

  if (!empty($pdfMilitar)) {
    $nombreMilitar = 'SMILITAR_' . str_replace('-', '_', $fechaActual) . '_' . $pdfMilitar;
    $ruta_militarFINAL = $ruta . $rutPersona . '/' . $nombreMilitar;
    move_uploaded_file($_FILES['nameMilitarDoc']['tmp_name'], $ruta_militarFINAL);
    $ruta_militarFINAL = 'http://' . $host . '/das/controller/' . $ruta_militarFINAL;
  }

  if (!empty($pdfAntecedentes)) {
    $nombreAntecedentes = 'ANTECEDENTES_' . str_replace('-', '_', $fechaActual) . '_' . $pdfAntecedentes;
    $ruta_AntecedentesFINAL = $ruta . $rutPersona . '/' . $nombreAntecedentes;
    move_uploaded_file($_FILES['nameANTECEdoc']['tmp_name'], $ruta_AntecedentesFINAL);
    $ruta_AntecedentesFINAL = 'http://' . $host . '/das/controller/' . $ruta_AntecedentesFINAL;
  }

  if (!empty($pdfCedula)) {
    $nombreCedula = 'CEDULA_' . str_replace('-', '_', $fechaActual) . '_' . $pdfCedula;
    $ruta_CedulaFINAL = $ruta . $rutPersona . '/' . $nombreCedula;
    move_uploaded_file($_FILES['nameCeduladoc']['tmp_name'], $ruta_CedulaFINAL);
    $ruta_CedulaFINAL = 'http://' . $host . '/das/controller/' . $ruta_CedulaFINAL;
  }

  if (!empty($pdfCurriculum)) {
    $nombreCurriculum = 'CURRICULUM_' . str_replace('-', '_', $fechaActual) . '_' . $pdfCurriculum;
    $ruta_CurriculumFINAL = $ruta . $rutPersona . '/' . $nombreCurriculum;
    move_uploaded_file($_FILES['nameCVdoc']['tmp_name'], $ruta_CurriculumFINAL);
    $ruta_CurriculumFINAL = 'http://' . $host . '/das/controller/' . $ruta_CurriculumFINAL;
  }

  if (!empty($pdfExamenM)) {
    $nombreExamenM = 'EUNACOM_' . date('d-m-y') . '_' . $pdfExamenM;
    $ruta_ExamenMFINAL = $ruta . $rutPersona . '/' . $nombreExamenM;
    move_uploaded_file($_FILES['nameExaMdoc']['tmp_name'], $ruta_ExamenMFINAL);
    $ruta_ExamenMFINAL = 'http://' . $host . '/das/controller/' . $ruta_ExamenMFINAL;
  }

  if (!empty($pdfPrevision)) {
    $nombrePrevision = 'PREVISION_' . date('d-m-y') . '_' . $pdfPrevision;
    $ruta_PrevisionFINAL = $ruta . $rutPersona . '/' . $nombrePrevision;
    move_uploaded_file($_FILES['namePREVdoc']['tmp_name'], $ruta_PrevisionFINAL);
    $ruta_PrevisionFINAL = 'http://' . $host . '/das/controller/' . $ruta_PrevisionFINAL;
  }

  if (!empty($pdfEstudios)) {
    $nombreEstudios = 'ESTUDIOS_' . date('d-m-y') . '_' . $pdfEstudios;
    $ruta_EstudiosFINAL = $ruta . $rutPersona . '/' . $nombreEstudios;
    move_uploaded_file($_FILES['nameEstudiodoc']['tmp_name'], $ruta_EstudiosFINAL);
    $ruta_EstudiosFINAL = 'http://' . $host . '/das/controller/' . $ruta_EstudiosFINAL;
  }

  if (!empty($pdfDJurada)) {
    $nombreDJurada = 'DJURADA_' . date('d-m-y') . '_' . $pdfDJurada;
    $ruta_DJuradaFINAL = $ruta . $rutPersona . '/' . $nombreDJurada;
    move_uploaded_file($_FILES['nameDJuradadoc']['tmp_name'], $ruta_DJuradaFINAL);
    $ruta_DJuradaFINAL = 'http://' . $host . '/das/controller/' . $ruta_DJuradaFINAL;
  }

  if (!empty($pdfSaludCompat)) {
    $nombreSaludCompat = 'SCOMPATIBLE_' . date('d-m-y') . '_' . $pdfSaludCompat;
    $ruta_SaludCompatFINAL = $ruta . $rutPersona . '/' . $nombreSaludCompat;
    move_uploaded_file($_FILES['nameSCompatibledoc']['tmp_name'], $ruta_SaludCompatFINAL);
    $ruta_SaludCompatFINAL = 'http://' . $host . '/das/controller/' . $ruta_SaludCompatFINAL;
  }

  if (!empty($pdfContrato)) {
    $nombreContrato = 'CONTRATO_' . date('d-m-y') . '_' . $pdfContrato;
    $ruta_ContratoFINAL = $ruta . $rutPersona . '/' . $nombreContrato;
    move_uploaded_file($_FILES['nameDocContratoInput']['tmp_name'], $ruta_ContratoFINAL);
    $ruta_ContratoFINAL = 'http://' . $host . '/das/controller/' . $ruta_ContratoFINAL;
  }

  if (!empty($pdfInscripcion)) {
    $nombreInscripcion = 'INSCRIPCION_' . date('d-m-y') . '_' . $pdfInscripcion;
    $ruta_InscripcionFINAL = $ruta . $rutPersona . '/' . $nombreInscripcion;
    move_uploaded_file($_FILES['nameInscripdoc']['tmp_name'], $ruta_InscripcionFINAL);
    $ruta_InscripcionFINAL = 'http://' . $host . '/das/controller/' . $ruta_InscripcionFINAL;
  }



  if (
    // SI ES HOMBRE O MUJER Y ES HONORARIO Y MEDICO
    (($generoP == "Masculino" || $generoP == "Femenino") && $medicoOno == "Si" && $inscripcionOno == 0 && $contratoP == 3 && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_ExamenMFINAL) && !empty($ruta_InscripcionFINAL))
    ||
    // SI ES HOMBRE O MUJER Y ES HONORARIO PERO NO MEDICO
    (($generoP == "Masculino" || $generoP == "Femenino") && $medicoOno == "No" && $inscripcionOno == 0 && $contratoP == 3 && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_ContratoFINAL))
    ||
    // SI ES HOMBRE Y NO ES HONORARIO NI MEDICO
    ($generoP == "Masculino" && $contratoP != 3 && $medicoOno == "No" && $inscripcionOno == 0 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_militarFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL))
    ||
    // SI ES HOMBRE, MEDICO Y NO ES HONORARIO
    ($generoP == "Masculino" && $medicoOno == "Si" && $contratoP != 3 && $inscripcionOno == 0 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_militarFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_ExamenMFINAL) && !empty($ruta_InscripcionFINAL))
    ||
    // SI ES MUJER, MEDICO Y NO ES HONORARIO
    ($generoP == "Femenino" && $medicoOno == "Si" && $contratoP != 3 && $inscripcionOno == 0 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_ExamenMFINAL) && !empty($ruta_InscripcionFINAL))
    ||
    // SI ES MUJER, NO ES MEDICO NI HONORARIO
    ($generoP == "Femenino" && $medicoOno == "No" && $contratoP != 3 && $inscripcionOno == 0 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL))
    ||
    // SI ES HOMBRE O MUJER Y ES HONORARIO Y MEDICO y SUBE INSCRIPCION
    (($generoP == "Masculino" || $generoP == "Femenino") && $medicoOno == "Si" && $inscripcionOno == 1 && $contratoP == 3 && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_ExamenMFINAL) && !empty($ruta_InscripcionFINAL))
    ||
    // SI ES HOMBRE O MUJER Y ES HONORARIO PERO NO MEDICO y SUBE INSCRIPCION
    (($generoP == "Masculino" || $generoP == "Femenino") && $medicoOno == "No" && $contratoP == 3 && $inscripcionOno == 1 && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_InscripcionFINAL))
    ||
    // SI ES HOMBRE Y NO ES HONORARIO NI MEDICO Y SUBE INSCRIPCION
    ($generoP == "Masculino" && $contratoP != 3 && $medicoOno == "No" && $inscripcionOno == 1 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_militarFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_InscripcionFINAL))
    ||
    // SI ES HOMBRE, MEDICO Y NO ES HONORARIO Y SUBEINSCRIPCION
    ($generoP == "Masculino" && $medicoOno == "Si" && $contratoP != 3 && $inscripcionOno == 1 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_militarFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_ExamenMFINAL) && !empty($ruta_InscripcionFINAL))
    ||
    // SI ES MUJER, MEDICO Y NO ES HONORARIO Y SUBE INSCRIPCION
    ($generoP == "Femenino" && $medicoOno == "Si" && $contratoP != 3 && $inscripcionOno == 1 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_ExamenMFINAL) && !empty($ruta_InscripcionFINAL))
    ||
    // SI ES MUJER, NO ES MEDICO NI HONORARIO Y SUBE INSCRIPCION
    ($generoP == "Femenino" && $medicoOno == "No" && $contratoP != 3 && $inscripcionOno == 1 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_InscripcionFINAL))
  ) {
    $cumple = "Si Cumple";
  } else {
    $cumple = "No Cumple";
  }


  // SE INSERTAN DATOS A LA BASE DE DATOS
  $sqlTrabajador = " INSERT INTO trabajador (IDCat,IDCon,IDAFP,IDPrev,IDLugar,IDSector,NombreTra,PaternoTra,MaternoTra,Rut,Decreto,Genero,Medico,Profesion,CelularTra,CorreoTra,RutaPrev,RutaCV,RutaAFP,RutaNac,RutaAntec,RutaCedula,RutaEstudio,RutaDJur,RutaSerM,RutaSCom,RutaExaM,RutaContrato,Observ,RutaInscripcion,Cumple,Inscripcion) VALUES ($categoriaP,$contratoP,$afpP,$prevP,$lugarP,$sector,'$nombreP','$paternoP','$maternoP','$rutPersona','$decreto','$generoP','$medicoOno','$profesionP','$CelularP','$correoP','$ruta_PrevisionFINAL','$ruta_CurriculumFINAL','$ruta_afpFINAL','$ruta_nacFINAL','$ruta_AntecedentesFINAL','$ruta_CedulaFINAL','$ruta_EstudiosFINAL','$ruta_DJuradaFINAL','$ruta_militarFINAL','$ruta_SaludCompatFINAL','$ruta_ExamenMFINAL','$ruta_ContratoFINAL','$obsP','$ruta_InscripcionFINAL','$cumple','$inscripcionOno')";


  //VERIFICA SI LA CONSULTA SE EJECUTO CORRECTAMENTE


  try {
    $resultado = mysqli_query($conn, $sqlTrabajador);

    if (!$resultado) {
      throw new Exception(mysqli_error($conn));
    } else {
      echo "<script> Swal.fire({
        icon: 'success',
        title: 'Guardado Correctamente',
        showConfirmButton: false,
        timer: 3000
      });</script>";
    }
  } catch (Exception $e) {
    echo "<script> Swal.fire({
      icon: 'error',
      title: 'Error al guardar los archivos: " . $e->getMessage() . "',
      showConfirmButton: false,
      timer: 3000
    });</script>";
    // Eliminar los archivos antes de eliminar la carpeta si hubo un error de inserción
    if (file_exists($ruta . $rutPersona)) {
      $files = glob($ruta . $rutPersona . '/*'); // Obtener todos los archivos dentro de la carpeta
      foreach ($files as $file) {
        if (is_file($file)) {
          unlink($file); // Eliminar cada archivo
        }
      }
      rmdir($ruta . $rutPersona); // Eliminar la carpeta vacía

    }

    echo "<script> Swal.fire({
      icon: 'error',
      title: 'Error al guardar los archivos: " . $e->getMessage() . "',
      showConfirmButton: false,
      timer: 3000
    });</script>";
  }
}

// SE CIERRA LA CONEXION A LA BASE DE DATOS
mysqli_close($conn);
