<?php
// CONEXION A LA BASE DE DATOS
include("./config/conexion.php");

//SE RECIBEN LOS DATOS DE LOS INPUTS DESDE EL FORM
$idTrabajador = $_POST['nameTrabCa'];
$desde        = $_POST['nameInicio'];
$hasta        = $_POST['nameFin'];

$apelo        = $_POST['nameApeloRes'];
$rut          = $_POST['rutCapacitacion'];

$desde = mysqli_real_escape_string($conn, $desde);
$hasta = mysqli_real_escape_string($conn, $hasta);
$apelo = mysqli_real_escape_string($conn, $apelo);

$fecha        = $desde . '-' . $hasta;
$fecha = mysqli_real_escape_string($conn, $fecha);

$pdfcalificacion = str_replace(array(' ', '(', ')'), '_', $_FILES['nameCalifdoc']['name']);
$pdfapelo        = str_replace(array(' ', '(', ')'), '_', $_FILES['nameApelacionDoc']['name']);


// OBTIENE EL NOMBRE EL HOST
$host = $_SERVER['HTTP_HOST'];

// CARPETA DONDE SE GUARDARAN CARPETAS SEGUN RUT
$ruta = 'pdfs_personal/';
$rutaCalificaciones = 'CALIFICACIONES/';

// CARPETAS CON NOMBRE SEGUN EL RUT, SI NO EXISTE LA CREA
if (!file_exists($ruta . $rut . $rutaCalificaciones)) {
    mkdir($ruta . $rut . $rutaCalificaciones, 0777, true);

    // SUBCARPETAS CREADAS PARA ALMACENAR DOCUMENTOS
    mkdir($ruta . $rut . $rutaCalificaciones . '/APELACIONES/', 0777, true);
    mkdir($ruta . $rut . $rutaCalificaciones . '/CALIFICACIONES/', 0777, true);
}

// REVISA SI EL RUT EXISTE EN LA BASE DE DATOS
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM trabajador WHERE Rut = '$rut'")) > 0) {
    $ruta_CalifFINAL          = NULL;
    $ruta_ApelaFINAL          = NULL;

    if (!empty($pdfcalificacion)) {
        //CREA LA RUTA FINAL DEL ARCHIVO 
        $ruta_CalifFINAL = $ruta . $rut . $rutaCalificaciones . '/CALIFICACIONES/' . $pdfcalificacion;
        //EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
        move_uploaded_file($_FILES['nameCalifdoc']['tmp_name'], $ruta_CalifFINAL);
        //SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
        $ruta_CalifFINAL = 'http://' . $host . '/das/controller/' . $ruta_CalifFINAL;
    }

    //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
    if (!empty($pdfapelo)) {
        //CREA LA RUTA FINAL DEL ARCHIVO 
        $ruta_ApelaFINAL = $ruta . $rut . $rutaCalificaciones . '/APELACIONES/' . $pdfapelo;
        //EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
        move_uploaded_file($_FILES['nameApelacionDoc']['tmp_name'], $ruta_ApelaFINAL);
        //SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
        $ruta_ApelaFINAL = 'http://' . $host . '/das/controller/' . $ruta_ApelaFINAL;
    }


    // SE INSERTAN DATOS A LA BASE DE DATOS
    $sqlCalificacion = " INSERT INTO calificaciones (IDTra, fecha, apelo, RutaApelacion, RutaCalificacion) 
  VALUES ('$idTrabajador','$fecha','$apelo','$ruta_ApelaFINAL', '$ruta_CalifFINAL')";


    //VERIFICA SI LA CONSULTA SE EJECUTO CORRECTAMENTE
    if (mysqli_query($conn, $sqlCalificacion)) {
        echo "Archivos guardados correctamente en la ruta";
    } else {
        echo "Error al guardar los archivos: " . mysqli_error($conn);
    }
} else {
    echo "RUT NO EXISTE";
}
