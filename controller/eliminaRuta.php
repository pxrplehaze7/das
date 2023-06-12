<?php
include("./config/conexion.php");
$idtra = $_POST['idtra'];
$campo = $_POST['campo'];
$sqlRuta = "UPDATE trabajador SET $campo='' WHERE IDTra='$idtra'";
$resultado = mysqli_query($conn, $sqlRuta);
if ($resultado) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}

?>
