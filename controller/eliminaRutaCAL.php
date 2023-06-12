<?php
include("./config/conexion.php");
$idCalificacion = $_POST['idCalificacion'];
$rutaCalificacion = $_POST['rutaCalificacion'];

$sqlRutacal = "UPDATE calificaciones SET RutaCalificacion = '' WHERE IDCalif = '$idCalificacion'";

if (mysqli_query($conn, $sqlRutacal)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
?>
