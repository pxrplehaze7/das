<?php
// CONEXION A LA BASE DE DATOS
include("./config/conexion.php");

//SE RECIBEN LOS DATOS DE LOS INPUTS DESDE EL FORM
$idTrabajador = $_POST['idTrab'];
$desde        = $_POST['nameInicio'];
$hasta        = $_POST['nameFin'];
$fecha        = $desde . '-' . $hasta;
$apelo        = $_POST['nameApeloRes'];
$rut          = $_POST['rutCapacitacion'];
$fecha = mysqli_real_escape_string($conn, $fecha);
$apelo = mysqli_real_escape_string($conn, $apelo);


$pdfcalificacion = str_replace(array(' ', '(', ')'), '_', $_FILES['nameCalifdoc']['name']);
$pdfapelo        = str_replace(array(' ', '(', ')'), '_', $_FILES['nameApelacionDoc']['name']);