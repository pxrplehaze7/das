<?php
// CONEXION A LA BASE DE DATOS
include("./config/conexion.php");

//SE RECIBEN LOS DATOS DE LOS INPUTS DESDE EL FORM
$idTrabajador = $_POST['nameTrabCa'];
$desde        = $_POST['nameInicio'];
$hasta        = $_POST['nameFin'];
$apelo        = $_POST['nameApeloRes'];
$rut          = $_POST['nameRutCa'];

// OBTIENE EL NOMBRE EL HOST
$host = $_SERVER['HTTP_HOST'];

// CARPETA DONDE SE GUARDARAN CARPETAS SEGUN RUT
$ruta = 'pdfs_personal/';

$desde = mysqli_real_escape_string($conn, $desde);
$hasta = mysqli_real_escape_string($conn, $hasta);
$apelo = mysqli_real_escape_string($conn, $apelo);

$fecha = $desde . '-' . $hasta;
$fecha = mysqli_real_escape_string($conn, $fecha);

$pdfcalificacion = str_replace(array(' ', '(', ')'), '_', $_FILES['nameCalifdoc']['name']);
$pdfapelo        = str_replace(array(' ', '(', ')'), '_', $_FILES['nameApelacionDoc']['name']);

// Generar nombres únicos para los archivos
$pdfcalificacion = uniqid() . '_' . $pdfcalificacion;
$pdfapelo = uniqid() . '_' . $pdfapelo;

if (!file_exists($ruta . $rut)) {
    mkdir($ruta . $rut, 0777, true);
}
$rutaCalificaciones = $ruta . $rut . '/CALIFICACIONES/';
if (!file_exists($rutaCalificaciones)) {
    mkdir($rutaCalificaciones, 0777, true);
}
$rutasubCalificaciones = $rutaCalificaciones . 'CALIFICACIONES/';
$rutaApelaciones = $rutaCalificaciones . 'APELACIONES/';

if (!file_exists($rutasubCalificaciones)) {
    mkdir($rutasubCalificaciones, 0777, true);
}
if (!file_exists($rutaApelaciones)) {
    mkdir($rutaApelaciones, 0777, true);
}

// REVISA SI EL RUT EXISTE EN LA BASE DE DATOS
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM trabajador WHERE Rut = '$rut'")) > 0) {
    $ruta_CalifFINAL = NULL;
    $ruta_ApelaFINAL = NULL;

    if (!empty($_FILES['nameCalifdoc']['tmp_name'])) {
        $ruta_CalifFINAL = $rutasubCalificaciones . $pdfcalificacion;
        move_uploaded_file($_FILES['nameCalifdoc']['tmp_name'], $ruta_CalifFINAL);
        $ruta_CalifFINAL = 'http://' . $host . '/das/controller/' . $ruta_CalifFINAL;
    }

    if (!empty($_FILES['nameApelacionDoc']['tmp_name'])) {
        $ruta_ApelaFINAL = $rutaApelaciones . $pdfapelo;
        move_uploaded_file($_FILES['nameApelacionDoc']['tmp_name'], $ruta_ApelaFINAL);
        $ruta_ApelaFINAL = 'http://' . $host . '/das/controller/' . $ruta_ApelaFINAL;
    }

    // SE INSERTAN DATOS A LA BASE DE DATOS
    $sqlCalificacion = "INSERT INTO calificaciones (IDTra, fecha, apelo, RutaApelacion, RutaCalificacion) 
    VALUES ('$idTrabajador','$fecha','$apelo','$ruta_ApelaFINAL', '$ruta_CalifFINAL')";

    if (mysqli_query($conn, $sqlCalificacion)) {
        echo "Archivos guardados correctamente en la ruta";
    } else {
        echo "Error al guardar los archivos: " . mysqli_error($conn);
    }
} else {
    echo "RUT NO EXISTE";
}
?>
