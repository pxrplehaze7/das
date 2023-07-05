<?php
include("./config/conexion.php");
$idinforme = $_POST['idInforme'];
$rutainforme = $_POST['rutaInforme'];
$sqlrutainf = "UPDATE informes SET RutaInforme = '' WHERE IDinf = '$idinforme'";
if (mysqli_query($conn, $sqlrutainf)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
?>
