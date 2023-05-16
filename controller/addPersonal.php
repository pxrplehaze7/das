<?php
// Conectar a la base de datos
include("./config/conexion.php");

//recibir datos de inputs
$rutPersona = $_POST['rut'];
$nombreP    = $_POST['namePersona'];
$paternoP   = $_POST['namePaterno'];
$maternoP   = $_POST['nameMaterno'];
$generoP    = $_POST['nameGenero'];
$CelularP   = $_POST['nameCelular'];
$correoP    = $_POST['nameCorreo'];
$categoriaP = $_POST['nameSelectCat'];
if($categoriaP==1){
  $medicoOno  = $_POST['nameMedico'];
}else{
  $medicoOno  = 'No';
}
$profesionP = $_POST['nameProfesion'];
$contratoP  = $_POST['nameSelectCon'];
$lugarP     = $_POST['nameSelectLugar'];
$afpP       = $_POST['nameSelectAFP']!=""?$_POST['nameSelectAFP']:NULL;
$prevP      = $_POST['nameSelectPrev'];
$obsP       = $_POST['nameObserv'];

$sector     = $_POST['nameSelectSector'];
$decreto     = $_POST['nameDecreto'];


$nombreP = mysqli_real_escape_string($conn, $nombreP);
$paternoP = mysqli_real_escape_string($conn, $paternoP);
$maternoP = mysqli_real_escape_string($conn, $maternoP);
$categoriaP = mysqli_real_escape_string($conn, $categoriaP);
$profesionP = mysqli_real_escape_string($conn, $profesionP);
$lugarP = mysqli_real_escape_string($conn, $lugarP);
$sector = mysqli_real_escape_string($conn, $sector);
$obsP = mysqli_real_escape_string($conn, $obsP);
$decreto = mysqli_real_escape_string($conn, $decreto);


$CelularP = str_replace(" ", "", $CelularP); // eliminar espacios
$correoP = str_replace(" ", "", $correoP); // eliminar espacios










//Elimina los espacios y los reemplaza por _
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

$pdfContrato  = str_replace(array(' ', '(', ')'), '_', $_FILES['nameDocContratoInput']['name']);

// Obtener el nombre del host (localhost)
$host = $_SERVER['HTTP_HOST'];

// Ruta donde se guardarán los archivos PDF
$ruta = 'pdfs_personal/';

// Crear una carpeta con el valor del input de tipo texto
if (!file_exists($ruta . $rutPersona)) {
    mkdir($ruta . $rutPersona, 0777, true);

    // Crear subcarpetas para los archivos
    mkdir($ruta . $rutPersona . '/AFP/', 0777, true);
    mkdir($ruta . $rutPersona . '/C_NACIMIENTO/', 0777, true);
    mkdir($ruta . $rutPersona . '/S_MILITAR/', 0777, true);
    mkdir($ruta . $rutPersona . '/C_ANTECEDENTES/', 0777, true);
    mkdir($ruta . $rutPersona . '/COPIA_CEDULA/', 0777, true);
    mkdir($ruta . $rutPersona . '/C_VITAE/', 0777, true);
    mkdir($ruta . $rutPersona . '/EXAMEN_MEDICO_U/', 0777, true);
    mkdir($ruta . $rutPersona . '/C_PREVISION/', 0777, true);
    mkdir($ruta . $rutPersona . '/C_ESTUDIOS/', 0777, true);
    mkdir($ruta . $rutPersona . '/DEC_JURADA/', 0777, true);
    mkdir($ruta . $rutPersona . '/C_SALUD_COMPATIBLE/', 0777, true);

    mkdir($ruta . $rutPersona . '/CONTRATO/', 0777, true);
}


// Verificar si el rut ya existe en la base de datos
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM trabajador WHERE Rut = '$rutPersona'")) > 0) {
    echo "El rut ya existe, no se han subido archivos.";
} else {

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
    $ruta_ContratoFINAL  = NULL;

    if (!empty($pdfAFP)) {
        // Crear la ruta final del archivo
        $ruta_afpFINAL = $ruta . $rutPersona . '/AFP/' . $pdfAFP;
          // Mover los archivos PDF a la nueva ubicación
        move_uploaded_file($_FILES['nameAFPdoc']['tmp_name'], $ruta_afpFINAL);
        // Construir la URL completa a la ubicación del archivo
        $ruta_afpFINAL = 'http://' . $host . '/das/controller/' . $ruta_afpFINAL;
    }

    if (!empty($pdfNacimiento)) {
        // Crear la ruta final del archivo
        $ruta_nacFINAL = $ruta . $rutPersona . '/C_NACIMIENTO/' . $pdfNacimiento;
          // Mover los archivos PDF a la nueva ubicación
        move_uploaded_file($_FILES['nameNACdoc']['tmp_name'], $ruta_nacFINAL);
        // Construir la URL completa a la ubicación del archivo
        $ruta_nacFINAL = 'http://' . $host . '/das/controller/' . $ruta_nacFINAL;
    }

    if (!empty($pdfMilitar)) {
        // Crear la ruta final del archivo
        $ruta_militarFINAL = $ruta . $rutPersona . '/S_MILITAR/' . $pdfMilitar;
          // Mover los archivos PDF a la nueva ubicación
        move_uploaded_file($_FILES['nameMilitarDoc']['tmp_name'], $ruta_militarFINAL);
        // Construir la URL completa a la ubicación del archivo
        $ruta_militarFINAL = 'http://' . $host . '/das/controller/' . $ruta_militarFINAL;
    }

    if (!empty($pdfAntecedentes)) {
        // Crear la ruta final del archivo
        $ruta_AntecedentesFINAL = $ruta . $rutPersona . '/C_ANTECEDENTES/' . $pdfAntecedentes;
          // Mover los archivos PDF a la nueva ubicación
        move_uploaded_file($_FILES['nameANTECEdoc']['tmp_name'], $ruta_AntecedentesFINAL);
        // Construir la URL completa a la ubicación del archivo
        $ruta_AntecedentesFINAL = 'http://' . $host . '/das/controller/' . $ruta_AntecedentesFINAL;
    }


    if (!empty($pdfCedula)) {
        // Crear la ruta final del archivo
        $ruta_CedulaFINAL       = $ruta . $rutPersona . '/COPIA_CEDULA/' . $pdfCedula;
          // Mover los archivos PDF a la nueva ubicación
        move_uploaded_file($_FILES['nameCeduladoc']['tmp_name'], $ruta_CedulaFINAL);
        // Construir la URL completa a la ubicación del archivo
        $ruta_CedulaFINAL       = 'http://' . $host . '/das/controller/' . $ruta_CedulaFINAL;
    }


    if (!empty($pdfCurriculum)) {
        // Crear la ruta final del archivo
        $ruta_CurriculumFINAL   = $ruta . $rutPersona . '/C_VITAE/' . $pdfCurriculum;
          // Mover los archivos PDF a la nueva ubicación
        move_uploaded_file($_FILES['nameCVdoc']['tmp_name'], $ruta_CurriculumFINAL);
        // Construir la URL completa a la ubicación del archivo
        $ruta_CurriculumFINAL   = 'http://' . $host . '/das/controller/' . $ruta_CurriculumFINAL;
    }

    if (!empty($pdfExamenM)) {
        // Crear la ruta final del archivo
        $ruta_ExamenMFINAL      = $ruta . $rutPersona . '/EXAMEN_MEDICO_U/' . $pdfExamenM;
          // Mover los archivos PDF a la nueva ubicación
        move_uploaded_file($_FILES['nameExaMdoc']['tmp_name'], $ruta_ExamenMFINAL);
        // Construir la URL completa a la ubicación del archivo
        $ruta_ExamenMFINAL      = 'http://' . $host . '/das/controller/' . $ruta_ExamenMFINAL;
    }

    if (!empty($pdfPrevision)) {
        // Crear la ruta final del archivo
        $ruta_PrevisionFINAL    = $ruta . $rutPersona . '/C_PREVISION/' . $pdfPrevision;
          // Mover los archivos PDF a la nueva ubicación
        move_uploaded_file($_FILES['namePREVdoc']['tmp_name'], $ruta_PrevisionFINAL);
        // Construir la URL completa a la ubicación del archivo
        $ruta_PrevisionFINAL    = 'http://' . $host . '/das/controller/' . $ruta_PrevisionFINAL;
    }

    if (!empty($pdfEstudios)) {
        // Crear la ruta final del archivo
        $ruta_EstudiosFINAL     = $ruta . $rutPersona . '/C_ESTUDIOS/' . $pdfEstudios;
          // Mover los archivos PDF a la nueva ubicación
        move_uploaded_file($_FILES['nameEstudiodoc']['tmp_name'], $ruta_EstudiosFINAL);
        // Construir la URL completa a la ubicación del archivo
        $ruta_EstudiosFINAL     = 'http://' . $host . '/das/controller/' . $ruta_EstudiosFINAL;
    }

    if (!empty($pdfDJurada)) {
        // Crear la ruta final del archivo
        $ruta_DJuradaFINAL      = $ruta . $rutPersona . '/DEC_JURADA/' . $pdfDJurada;
          // Mover los archivos PDF a la nueva ubicación
        move_uploaded_file($_FILES['nameDJuradadoc']['tmp_name'], $ruta_DJuradaFINAL);
        // Construir la URL completa a la ubicación del archivo
        $ruta_DJuradaFINAL      = 'http://' . $host . '/das/controller/' . $ruta_DJuradaFINAL;
    }

    if (!empty($pdfSaludCompat)) {
        // Crear la ruta final del archivo
        $ruta_SaludCompatFINAL  = $ruta . $rutPersona . '/C_SALUD_COMPATIBLE/' . $pdfSaludCompat;
          // Mover los archivos PDF a la nueva ubicación
        move_uploaded_file($_FILES['nameSCompatibledoc']['tmp_name'], $ruta_SaludCompatFINAL);
        // Construir la URL completa a la ubicación del archivo
        $ruta_SaludCompatFINAL  = 'http://' . $host . '/das/controller/' . $ruta_SaludCompatFINAL;
    }

    if (!empty($pdfContrato)) {
      // Crear la ruta final del archivo
      $ruta_ContratoFINAL  = $ruta . $rutPersona . '/CONTRATO/' . $pdfContrato;
        // Mover los archivos PDF a la nueva ubicación
      move_uploaded_file($_FILES['nameDocContratoInput']['tmp_name'], $ruta_ContratoFINAL);
      // Construir la URL completa a la ubicación del archivo
      $ruta_ContratoFINAL  = 'http://' . $host . '/das/controller/' . $ruta_ContratoFINAL;
  }
       
        
    
    // Insertar la ruta final del archivo en la base de datos

    $sqlTrabajador = " INSERT INTO trabajador (IDCat, IDCon, IDAFP, IDPrev, IDLugar, NombreTra, PaternoTra, MaternoTra, Rut, Decreto, Genero, Medico, Profesion, Sector, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaDJur, RutaSerM, RutaSCom, RutaExaM, RutaContrato, Observ) VALUES ('$categoriaP','$contratoP',$afpP,'$prevP','$lugarP','$nombreP','$paternoP','$maternoP','$rutPersona','$decreto','$generoP','$medicoOno','$profesionP','$sector','$CelularP','$correoP','$ruta_PrevisionFINAL','$ruta_CurriculumFINAL',' $ruta_afpFINAL','$ruta_nacFINAL','$ruta_AntecedentesFINAL','$ruta_CedulaFINAL','$ruta_EstudiosFINAL','$ruta_DJuradaFINAL','$ruta_militarFINAL','$ruta_SaludCompatFINAL','$ruta_ExamenMFINAL','$ruta_ContratoFINAL','$obsP')";
    
         


    if (mysqli_query($conn, $sqlTrabajador)) {

        echo "Archivos guardados correctamente en la ruta";
    } else {
        echo "Error al guardar los archivos: " . mysqli_error($conn);
    }

}
    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
