<?php
// CONEXION A LA BASE DE DATOS
include("./config/conexion.php");
$sqlids = "SELECT MAX(IDTra) AS ultimoID FROM trabajador";
$resides = mysqli_query($conn, $sqlids);
$ids = mysqli_fetch_assoc($resides);
$ultimoID = $ids['ultimoID'];

if ($ultimoID === null) {
  $ultimoID = 0;
}
$idtra = $ultimoID + 1;


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
$fechaActual = new DateTime('now', new DateTimeZone('America/Santiago'));

// Formatea la fecha actual en el formato deseado (d-m-Y)
$fechaActual = $fechaActual->format('d-m-Y');

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
$pdfContrato = (!empty($_FILES['nameDocContratoInput']['name'])) ? uniqid() . '.pdf' : '';
$pdfInscripcion = (!empty($_FILES['nameInscripdoc']['name'])) ? uniqid() . '.pdf' : '';



// CARPETAS CON NOMBRE SEGUN EL RUT, SI NO EXISTE LA CREA
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
  $ruta_ContratoFINAL     = NULL;
  $ruta_InscripcionFINAL  = NULL;

  //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA

  if (!empty($pdfAFP)) {
    // CREA EL NOMBRE DEL ARCHIVO CONCATENANDO 'afp' Y LA FECHA ACTUAL
    $nombreAFP = 'AFP_' . str_replace('-', '_', $fechaActual) . '_' . $pdfAFP;
    // CREA LA RUTA FINAL DEL ARCHIVO
    $ruta_afpFINAL = $ruta . $idtra . '/' . $nombreAFP;
    // EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['nameAFPdoc']['tmp_name'], $ruta_afpFINAL);
    // SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_afpFINAL = 'http://' . $host . '/das/controller/' . $ruta_afpFINAL;
  }

  // SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfNacimiento)) {
    $nombreNacimiento = 'CNACIMIENTO_' . str_replace('-', '_', $fechaActual) . '_' . $pdfNacimiento;
    $ruta_nacFINAL = $ruta . $idtra . '/' . $nombreNacimiento;
    move_uploaded_file($_FILES['nameNACdoc']['tmp_name'], $ruta_nacFINAL);
    $ruta_nacFINAL = 'http://' . $host . '/das/controller/' . $ruta_nacFINAL;
  }

  if (!empty($pdfMilitar)) {
    $nombreMilitar = 'SMILITAR_' . str_replace('-', '_', $fechaActual) . '_' . $pdfMilitar;
    $ruta_militarFINAL = $ruta . $idtra . '/' . $nombreMilitar;
    move_uploaded_file($_FILES['nameMilitarDoc']['tmp_name'], $ruta_militarFINAL);
    $ruta_militarFINAL = 'http://' . $host . '/das/controller/' . $ruta_militarFINAL;
  }

  if (!empty($pdfAntecedentes)) {
    $nombreAntecedentes = 'ANTECEDENTES_' . str_replace('-', '_', $fechaActual) . '_' . $pdfAntecedentes;
    $ruta_AntecedentesFINAL = $ruta . $idtra . '/' . $nombreAntecedentes;
    move_uploaded_file($_FILES['nameANTECEdoc']['tmp_name'], $ruta_AntecedentesFINAL);
    $ruta_AntecedentesFINAL = 'http://' . $host . '/das/controller/' . $ruta_AntecedentesFINAL;
  }

  if (!empty($pdfCedula)) {
    $nombreCedula = 'CEDULA_' . str_replace('-', '_', $fechaActual) . '_' . $pdfCedula;
    $ruta_CedulaFINAL = $ruta . $idtra . '/' . $nombreCedula;
    move_uploaded_file($_FILES['nameCeduladoc']['tmp_name'], $ruta_CedulaFINAL);
    $ruta_CedulaFINAL = 'http://' . $host . '/das/controller/' . $ruta_CedulaFINAL;
  }

  if (!empty($pdfCurriculum)) {
    $nombreCurriculum = 'CURRICULUM_' . str_replace('-', '_', $fechaActual) . '_' . $pdfCurriculum;
    $ruta_CurriculumFINAL = $ruta . $idtra . '/' . $nombreCurriculum;
    move_uploaded_file($_FILES['nameCVdoc']['tmp_name'], $ruta_CurriculumFINAL);
    $ruta_CurriculumFINAL = 'http://' . $host . '/das/controller/' . $ruta_CurriculumFINAL;
  }

  if (!empty($pdfExamenM)) {
    $nombreExamenM = 'EUNACOM_' . str_replace('-', '_', $fechaActual) . '_' . $pdfExamenM;
    $ruta_ExamenMFINAL = $ruta . $idtra . '/' . $nombreExamenM;
    move_uploaded_file($_FILES['nameExaMdoc']['tmp_name'], $ruta_ExamenMFINAL);
    $ruta_ExamenMFINAL = 'http://' . $host . '/das/controller/' . $ruta_ExamenMFINAL;
  }

  if (!empty($pdfPrevision)) {
    $nombrePrevision = 'PREVISION_' . str_replace('-', '_', $fechaActual) . '_' . $pdfPrevision;
    $ruta_PrevisionFINAL = $ruta . $idtra . '/' . $nombrePrevision;
    move_uploaded_file($_FILES['namePREVdoc']['tmp_name'], $ruta_PrevisionFINAL);
    $ruta_PrevisionFINAL = 'http://' . $host . '/das/controller/' . $ruta_PrevisionFINAL;
  }

  if (!empty($pdfEstudios)) {
    $nombreEstudios = 'ESTUDIOS_' . str_replace('-', '_', $fechaActual) . '_' . $pdfEstudios;
    $ruta_EstudiosFINAL = $ruta . $idtra . '/' . $nombreEstudios;
    move_uploaded_file($_FILES['nameEstudiodoc']['tmp_name'], $ruta_EstudiosFINAL);
    $ruta_EstudiosFINAL = 'http://' . $host . '/das/controller/' . $ruta_EstudiosFINAL;
  }

  if (!empty($pdfDJurada)) {
    $nombreDJurada = 'DJURADA_' . str_replace('-', '_', $fechaActual) . '_' . $pdfDJurada;
    $ruta_DJuradaFINAL = $ruta . $idtra . '/' . $nombreDJurada;
    move_uploaded_file($_FILES['nameDJuradadoc']['tmp_name'], $ruta_DJuradaFINAL);
    $ruta_DJuradaFINAL = 'http://' . $host . '/das/controller/' . $ruta_DJuradaFINAL;
  }

  if (!empty($pdfSaludCompat)) {
    $nombreSaludCompat = 'SCOMPATIBLE_' . str_replace('-', '_', $fechaActual) . '_' . $pdfSaludCompat;
    $ruta_SaludCompatFINAL = $ruta . $idtra . '/' . $nombreSaludCompat;
    move_uploaded_file($_FILES['nameSCompatibledoc']['tmp_name'], $ruta_SaludCompatFINAL);
    $ruta_SaludCompatFINAL = 'http://' . $host . '/das/controller/' . $ruta_SaludCompatFINAL;
  }

  if (!empty($pdfContrato)) {
    $nombreContrato = 'CONTRATO_' . str_replace('-', '_', $fechaActual) . '_' . $pdfContrato;
    $ruta_ContratoFINAL = $ruta . $idtra . '/' . $nombreContrato;
    move_uploaded_file($_FILES['nameDocContratoInput']['tmp_name'], $ruta_ContratoFINAL);
    $ruta_ContratoFINAL = 'http://' . $host . '/das/controller/' . $ruta_ContratoFINAL;
  }

  if (!empty($pdfInscripcion)) {
    $nombreInscripcion = 'INSCRIPCION_' . str_replace('-', '_', $fechaActual) . '_' . $pdfInscripcion;
    $ruta_InscripcionFINAL = $ruta . $idtra . '/' . $nombreInscripcion;
    move_uploaded_file($_FILES['nameInscripdoc']['tmp_name'], $ruta_InscripcionFINAL);
    $ruta_InscripcionFINAL = 'http://' . $host . '/das/controller/' . $ruta_InscripcionFINAL;
  }



  if (
    (
      // HONORARIO HOMBRE O MUJER ES MÉDICO Y PRESENTA INSCRIPCIÓN *VERSIÓN CON ANTECEDENTES, PREGUNTAR POR CONTRATO
      ($generoP == "Masculino" || $generoP == "Femenino") &&
      $contratoP == 3 &&
      $medicoOno == "Si" &&
      $inscripcionOno == TRUE &&
      !empty($ruta_ContratoFINAL) &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_InscripcionFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_ExamenMFINAL) &&
      !empty($ruta_AntecedentesFINAL)
    )
    ||
    // HONORARIO HOMBRE O MUJER QUE NO ES MÉDICO PERO PRESENTA INSCRIPCIÓN *VERSIÓN CON ANTECEDENTES, PREGUNTAR POR CONTRATO
    (($generoP == "Masculino" || $generoP == "Femenino") &&
      $contratoP == 3 &&
      $medicoOno == "No" &&
      $inscripcionOno == TRUE &&
      !empty($ruta_ContratoFINAL) &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_InscripcionFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_AntecedentesFINAL))
    ||
    // HONORARIO HOMBRE O MUJER QUE NO ES MÉDICO NI PRESENTA INSCRIPCIÓN *VERSIÓN CON ANTECEDENTES, PREGUNTAR POR CONTRATO
    (($generoP == "Masculino" || $generoP == "Femenino") &&
      $contratoP == 3 &&
      $medicoOno == "No" &&
      $inscripcionOno == FALSE &&
      !empty($ruta_ContratoFINAL) &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_AntecedentesFINAL))
    ||
    // HOMBRE NO HONORARIO, NO ES MÉDICO NI PRESENTA INSCRIPCIÓN
    ($generoP == "Masculino" &&
      $contratoP != 3 &&
      $medicoOno == "No" &&
      $inscripcionOno == FALSE &&
      !empty($ruta_ContratoFINAL) &&
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
    // HOMBRE NO HONORARIO, ES MÉDICO Y PRESENTA INSCRIPCIÓN
    ($generoP == "Masculino" &&
      $contratoP != 3 &&
      $medicoOno == "Si" &&
      $inscripcionOno == TRUE &&
      !empty($ruta_ContratoFINAL) &&
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
    // HOMBRE NO HONORARIO, ES MÉDICO Y NO PRESENTA INSCRIPCIÓN
    ($generoP == "Masculino" &&
      $contratoP != 3 &&
      $medicoOno == "Si" &&
      $inscripcionOno == FALSE &&
      !empty($ruta_ContratoFINAL) &&
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
    // HOMBRE NO HONORARIO, NO ES MÉDICO Y PRESENTA INSCRIPCIÓN
    ($generoP == "Masculino" &&
      $contratoP != 3 &&
      $medicoOno == "No" &&
      $inscripcionOno == TRUE &&
      !empty($ruta_ContratoFINAL) &&
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
    // MUJER NO HONORARIO, ES MÉDICO Y PRESENTA INSCRIPCIÓN
    ($generoP == "Femenino" &&
      $contratoP != 3 &&
      $medicoOno == "Si" &&
      $inscripcionOno == TRUE &&
      !empty($ruta_ContratoFINAL) &&
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
    // MUJER NO HONORARIO, ES MÉDICO Y NO PRESENTA INSCRIPCIÓN
    ($generoP == "Femenino" &&
      $contratoP != 3 &&
      $medicoOno == "Si" &&
      $inscripcionOno == FALSE &&
      !empty($ruta_ContratoFINAL) &&
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
    // MUJER NO HONORARIO, NO ES MÉDICO Y PRESENTA INSCRIPCIÓN
    ($generoP == "Femenino" &&
      $contratoP != 3 &&
      $medicoOno == "No" &&
      $inscripcionOno == TRUE &&
      !empty($ruta_ContratoFINAL) &&
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
    // MUJER NO HONORARIO, NO ES MÉDICO Y NO PRESENTA INSCRIPCIÓN
    ($generoP == "Femenino" &&
      $contratoP != 3 &&
      $medicoOno == "No" &&
      $inscripcionOno == FALSE &&
      !empty($ruta_ContratoFINAL) &&
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
    $cumple = TRUE;
  } else {
    $cumple = FALSE;
  }







  // SE INSERTAN DATOS A LA BASE DE DATOS
  $sqlTrabajador = " INSERT INTO trabajador (IDTra,IDCat,IDCon,IDAFP,IDPrev,IDLugar,IDSector,NombreTra,PaternoTra,MaternoTra,Rut,Decreto,Genero,Medico,Profesion,CelularTra,CorreoTra,RutaPrev,RutaCV,RutaAFP,RutaNac,RutaAntec,RutaCedula,RutaEstudio,RutaDJur,RutaSerM,RutaSCom,RutaExaM,RutaContrato,Observ,RutaInscripcion,Cumple,Inscripcion)
   VALUES ($idtra,$categoriaP,$contratoP,$afpP,$prevP,$lugarP,$sector,'$nombreP','$paternoP','$maternoP','$rutPersona','$decreto','$generoP','$medicoOno','$profesionP','$CelularP','$correoP','$ruta_PrevisionFINAL','$ruta_CurriculumFINAL','$ruta_afpFINAL','$ruta_nacFINAL','$ruta_AntecedentesFINAL','$ruta_CedulaFINAL','$ruta_EstudiosFINAL','$ruta_DJuradaFINAL','$ruta_militarFINAL','$ruta_SaludCompatFINAL','$ruta_ExamenMFINAL','$ruta_ContratoFINAL','$obsP','$ruta_InscripcionFINAL','$cumple','$inscripcionOno')";


  //VERIFICA SI LA CONSULTA SE EJECUTO CORRECTAMENTE


  try {
    $resultado = mysqli_query($conn, $sqlTrabajador);

    // echo "error";
    if (!$resultado) {
      throw new Exception(mysqli_error($conn));
    } else {
      echo "<script> Swal.fire({
        icon: 'success',
        title: 'Guardado Correctamente',
        showConfirmButton: false,
        timer: 3000
      });</script>";

      echo "<script>
      var inputs = document.querySelectorAll('input');
      for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
      }
    </script>";
    }
  } catch (Exception $e) {

    // Eliminar los archivos antes de eliminar la carpeta si hubo un error de inserción
    if (file_exists($ruta . $idtra)) {
      $files = glob($ruta . $idtra . '/*'); // Obtener todos los archivos dentro de la carpeta
      foreach ($files as $file) {
        if (is_file($file)) {
          unlink($file); // Eliminar cada archivo
        }
      }
      rmdir($ruta . $idtra); // Eliminar la carpeta vacía
    }

    echo "<script> 
    Swal.fire({
      icon: 'error',
      title: `Error al guardar los archivos: " . $e->getMessage() . "`,
      showConfirmButton: false,
      timer: 3600
    });
    </script>";
  }
}

// SE CIERRA LA CONEXION A LA BASE DE DATOS
mysqli_close($conn);
