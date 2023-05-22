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
// $obsP       = $_POST['nameObserv'];
$host = $_SERVER['HTTP_HOST'];

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



$afpP       = $_POST['nameSelectAFP'] != "" ? $_POST['nameSelectAFP'] : NULL;
$prevP       = $_POST['nameSelectPrev'] != "" ? $_POST['nameSelectPrev'] : NULL;


$correoP = str_replace(' ', '', $correoP);

$nombreP    = mysqli_real_escape_string($conn, $nombreP);
$paternoP   = mysqli_real_escape_string($conn, $paternoP);
$maternoP   = mysqli_real_escape_string($conn, $maternoP);
$categoriaP = mysqli_real_escape_string($conn, $categoriaP);
$profesionP = mysqli_real_escape_string($conn, $profesionP);
$lugarP     = mysqli_real_escape_string($conn, $lugarP);
$sector     = mysqli_real_escape_string($conn, $sector);
// $obsP       = mysqli_real_escape_string($conn, $obsP);
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

// OBTIENE EL NOMBRE EL HOST


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

  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfAFP)) {
    // CREA LA RUTA FINAL DEL ARCHIVO 
    $ruta_afpFINAL = $ruta . $rutPersona . '/' . $pdfAFP;
    // EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['nameAFPdoc']['tmp_name'], $ruta_afpFINAL);
    // SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_afpFINAL = 'http://' . $host . '/das/controller/' . $ruta_afpFINAL;
  }

  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfNacimiento)) {
    //CREA LA RUTA FINAL DEL ARCHIVO 
    $ruta_nacFINAL = $ruta . $rutPersona . '/' . $pdfNacimiento;
    //EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['nameNACdoc']['tmp_name'], $ruta_nacFINAL);
    //SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_nacFINAL = 'http://' . $host . '/das/controller/' . $ruta_nacFINAL;
  }

  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfMilitar)) {
    //CREA LA RUTA FINAL DEL ARCHIVO 
    $ruta_militarFINAL = $ruta . $rutPersona . '/' . $pdfMilitar;
    //EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['nameMilitarDoc']['tmp_name'], $ruta_militarFINAL);
    //SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_militarFINAL = 'http://' . $host . '/das/controller/' . $ruta_militarFINAL;
  }

  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfAntecedentes)) {
    //CREA LA RUTA FINAL DEL ARCHIVO 
    $ruta_AntecedentesFINAL = $ruta . $rutPersona . '/' . $pdfAntecedentes;
    //EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['nameANTECEdoc']['tmp_name'], $ruta_AntecedentesFINAL);
    //SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_AntecedentesFINAL = 'http://' . $host . '/das/controller/' . $ruta_AntecedentesFINAL;
  }


  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfCedula)) {
    //CREA LA RUTA FINAL DEL ARCHIVO 
    $ruta_CedulaFINAL       = $ruta . $rutPersona . '/' . $pdfCedula;
    //EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['nameCeduladoc']['tmp_name'], $ruta_CedulaFINAL);
    //SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_CedulaFINAL       = 'http://' . $host . '/das/controller/' . $ruta_CedulaFINAL;
  }


  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfCurriculum)) {
    //CREA LA RUTA FINAL DEL ARCHIVO 
    $ruta_CurriculumFINAL   = $ruta . $rutPersona . '/' . $pdfCurriculum;
    //EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['nameCVdoc']['tmp_name'], $ruta_CurriculumFINAL);
    //SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_CurriculumFINAL   = 'http://' . $host . '/das/controller/' . $ruta_CurriculumFINAL;
  }

  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfExamenM)) {
    //CREA LA RUTA FINAL DEL ARCHIVO 
    $ruta_ExamenMFINAL      = $ruta . $rutPersona . '/' . $pdfExamenM;
    //EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['nameExaMdoc']['tmp_name'], $ruta_ExamenMFINAL);
    //SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_ExamenMFINAL      = 'http://' . $host . '/das/controller/' . $ruta_ExamenMFINAL;
  }

  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfPrevision)) {
    //CREA LA RUTA FINAL DEL ARCHIVO 
    $ruta_PrevisionFINAL    = $ruta . $rutPersona . '/' . $pdfPrevision;
    //EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['namePREVdoc']['tmp_name'], $ruta_PrevisionFINAL);
    //SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_PrevisionFINAL    = 'http://' . $host . '/das/controller/' . $ruta_PrevisionFINAL;
  }

  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfEstudios)) {
    //CREA LA RUTA FINAL DEL ARCHIVO 
    $ruta_EstudiosFINAL     = $ruta . $rutPersona . '/' . $pdfEstudios;
    //EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['nameEstudiodoc']['tmp_name'], $ruta_EstudiosFINAL);
    //SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_EstudiosFINAL     = 'http://' . $host . '/das/controller/' . $ruta_EstudiosFINAL;
  }

  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfDJurada)) {
    //CREA LA RUTA FINAL DEL ARCHIVO 
    $ruta_DJuradaFINAL      = $ruta . $rutPersona . '/' . $pdfDJurada;
    //EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['nameDJuradadoc']['tmp_name'], $ruta_DJuradaFINAL);
    //SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_DJuradaFINAL      = 'http://' . $host . '/das/controller/' . $ruta_DJuradaFINAL;
  }

  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfSaludCompat)) {
    //CREA LA RUTA FINAL DEL ARCHIVO 
    $ruta_SaludCompatFINAL  = $ruta . $rutPersona . '/' . $pdfSaludCompat;
    //EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['nameSCompatibledoc']['tmp_name'], $ruta_SaludCompatFINAL);
    //SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_SaludCompatFINAL  = 'http://' . $host . '/das/controller/' . $ruta_SaludCompatFINAL;
  }

  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfContrato)) {
    //CREA LA RUTA FINAL DEL ARCHIVO 
    $ruta_ContratoFINAL  = $ruta . $rutPersona . '/' . $pdfContrato;
    //EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['nameDocContratoInput']['tmp_name'], $ruta_ContratoFINAL);
    //SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_ContratoFINAL  = 'http://' . $host . '/das/controller/' . $ruta_ContratoFINAL;
  }


  // SE INSERTAN DATOS A LA BASE DE DATOS
  $sqlTrabajador = " INSERT INTO trabajador (IDCat, IDCon, IDAFP, IDPrev, IDLugar, NombreTra, PaternoTra, MaternoTra, Rut, Decreto, Genero, Medico, Profesion, Sector, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaDJur, RutaSerM, RutaSCom, RutaExaM, RutaContrato) VALUES ($categoriaP,$contratoP,$afpP,$prevP,$lugarP,'$nombreP','$paternoP','$maternoP','$rutPersona','$decreto','$generoP','$medicoOno','$profesionP','$sector','$CelularP','$correoP','$ruta_PrevisionFINAL','$ruta_CurriculumFINAL','$ruta_afpFINAL','$ruta_nacFINAL','$ruta_AntecedentesFINAL','$ruta_CedulaFINAL','$ruta_EstudiosFINAL','$ruta_DJuradaFINAL','$ruta_militarFINAL','$ruta_SaludCompatFINAL','$ruta_ExamenMFINAL','$ruta_ContratoFINAL')";


  // Observ,'$obsP' eliminadas

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

