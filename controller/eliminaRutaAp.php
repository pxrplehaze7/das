<?php
include("./config/conexion.php");
$idCalificacion = $_POST['idCalificacion'];
$rutaApelacion = $_POST['rutaApelacion'];

$sqlRutaap = "UPDATE calificaciones SET RutaApelacion = '' WHERE IDCalif = '$idCalificacion'";

if (mysqli_query($conn, $sqlRutaap)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
?>
