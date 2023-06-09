<?php
include("./config/conexion.php");
$rut = $_POST['rut'];
$campo = $_POST['campo'];
$sqlRuta = "UPDATE trabajador SET $campo='' WHERE Rut='$rut'";
$resultado = mysqli_query($conn, $sqlRuta);
if ($resultado) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}

?>
