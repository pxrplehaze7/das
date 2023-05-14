<?php
//print_r($_FILES)
//imprime lo que recibe por FILE



// Conectar a la base de datos
include("./config/conexion.php");


//recibir datos de inputs
$nombreP    = $_POST['namePersona'];
$paternoP   = $_POST['namePaterno'];
$maternoP   = $_POST['nameMaterno'];
$rutPersona = $_POST['rut'];
$generoP    = $_POST['nameGenero'];
$CelularP   = $_POST['nameCelular'];
$correoP    = $_POST['nameCorreo'];
$categoriaP = $_POST['nameSelectCat'];
$profesionP = $_POST['nameProfesion'];
$contratoP  = $_POST['nameSelectCon'];
$lugarP     = $_POST['nameSelectLugar'];
$afpP       = $_POST['nameSelectAFP'];
$prevP      = $_POST['nameSelectPrev'];
$obsP       = $_POST['nameObserv'];
$medicoOno  = $_POST['nameMedico'];


//Elimina los espacios y los reemplazapor _
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




// Obtener el nombre del host (localhost)
$host = $_SERVER['HTTP_HOST'];

// Ruta donde se guardarán los archivos PDF
$ruta = 'pdfs_personal/';

// Crear una carpeta con el valor del input de tipo texto
if (!file_exists($ruta . $rutPersona)) {
    mkdir($ruta . $rutPersona, 0777, true);

    // Crear subcarpetas para los archivos AFP y de nacimiento
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
}

// Crear la ruta final del archivo
$ruta_afpFINAL          = $ruta . $rutPersona . '/AFP/' . $pdfAFP;
$ruta_nacFINAL          = $ruta . $rutPersona . '/C_NACIMIENTO/' . $pdfNacimiento;
$ruta_militarFINAL      = $ruta . $rutPersona . '/S_MILITAR/' . $pdfMilitar;
$ruta_AntecedentesFINAL = $ruta . $rutPersona . '/C_ANTECEDENTES/' . $pdfAntecedentes;
$ruta_CedulaFINAL       = $ruta . $rutPersona . '/COPIA_CEDULA/' . $pdfCedula;
$ruta_CurriculumFINAL   = $ruta . $rutPersona . '/C_VITAE/' . $pdfCurriculum;
$ruta_ExamenMFINAL      = $ruta . $rutPersona . '/EXAMEN_MEDICO_U/' . $pdfExamenM;
$ruta_PrevisionFINAL    = $ruta . $rutPersona . '/C_PREVISION/' . $pdfPrevision;
$ruta_EstudiosFINAL     = $ruta . $rutPersona . '/C_ESTUDIOS/' . $pdfEstudios;
$ruta_DJuradaFINAL      = $ruta . $rutPersona . '/DEC_JURADA/' . $pdfDJurada;
$ruta_SaludCompatFINAL  = $ruta . $rutPersona . '/C_SALUD_COMPATIBLE/' . $pdfSaludCompat;

// Mover los archivos PDF a la nueva ubicación
move_uploaded_file($_FILES['nameAFPdoc']['tmp_name'], $ruta_afpFINAL);
move_uploaded_file($_FILES['nameNACdoc']['tmp_name'], $ruta_nacFINAL);
move_uploaded_file($_FILES['nameMilitarDoc']['tmp_name'], $ruta_militarFINAL);
move_uploaded_file($_FILES['nameANTECEdoc']['tmp_name'], $ruta_AntecedentesFINAL);
move_uploaded_file($_FILES['nameCeduladoc']['tmp_name'], $ruta_CedulaFINAL);
move_uploaded_file($_FILES['nameCVdoc']['tmp_name'], $ruta_CurriculumFINAL);
move_uploaded_file($_FILES['nameExaMdoc']['tmp_name'], $ruta_ExamenMFINAL);
move_uploaded_file($_FILES['namePREVdoc']['tmp_name'], $ruta_PrevisionFINAL);
move_uploaded_file($_FILES['nameEstudiodoc']['tmp_name'], $ruta_EstudiosFINAL);
move_uploaded_file($_FILES['nameDJuradadoc']['tmp_name'], $ruta_DJuradaFINAL);
move_uploaded_file($_FILES['nameSCompatibledoc']['tmp_name'], $ruta_SaludCompatFINAL);


// Construir la URL completa a la ubicación del archivo
$url_afpFINAL          = 'http://' . $host . '/das/controller/' . $ruta_afpFINAL;
$url_nacFINAL          = 'http://' . $host . '/das/controller/' . $ruta_nacFINAL;
$url_militarFINAL      = 'http://' . $host . '/das/controller/' . $ruta_militarFINAL;
$url_AntecedentesFINAL = 'http://' . $host . '/das/controller/' . $ruta_AntecedentesFINAL;
$url_CedulaFINAL       = 'http://' . $host . '/das/controller/' . $ruta_CedulaFINAL;
$url_CurriculumFINAL   = 'http://' . $host . '/das/controller/' . $ruta_CurriculumFINAL;
$url_ExamenMFINAL      = 'http://' . $host . '/das/controller/' . $ruta_ExamenMFINAL;
$url_PrevisionFINAL    = 'http://' . $host . '/das/controller/' . $ruta_PrevisionFINAL;
$url_EstudiosFINAL     = 'http://' . $host . '/das/controller/' . $ruta_EstudiosFINAL;
$url_DJuradaFINAL      = 'http://' . $host . '/das/controller/' . $ruta_DJuradaFINAL;
$url_SaludCompatFINAL  = 'http://' . $host . '/das/controller/' . $ruta_SaludCompatFINAL;


// Insertar la ruta final del archivo en la base de datos

$sqlTrabajador = "INSERT INTO trabajador (IDCat, IDCon, IDAFP, IDPrev, IDLugar, NombreTra, PaternoTra, MaternoTra, Rut, Sexo, Profesion, Medico, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaDJur, RutaSerM, RutaSCom, RutaExaM, Observ) VALUES ('$categoriaP','$contratoP','$afpP','$prevP','$lugarP','$nombreP','$paternoP','$maternoP','$rutPersona','$generoP','$profesionP','$medicoOno','$CelularP','$correoP','$url_PrevisionFINAL','$url_CurriculumFINAL','$url_afpFINAL','$url_nacFINAL','$url_AntecedentesFINAL','$url_CedulaFINAL','$url_EstudiosFINAL','$url_DJuradaFINAL','$url_militarFINAL','$url_SaludCompatFINAL','$url_ExamenMFINAL', '$obsP')";



if (mysqli_query($conn, $sqlTrabajador)) {
    echo "Archivos guardados correctamente en la ruta";
} else {
    echo "Error al guardar los archivos: " . mysqli_error($conn);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
