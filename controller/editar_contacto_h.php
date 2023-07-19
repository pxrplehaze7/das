<?php
include("../controller/config/conexion.php");
$idh = $_POST['idh'];
$CelularP   = trim($_POST['nameCelular']);
$correoP    = trim($_POST['nameCorreo']);
$CelularP   = str_replace(" ", "", $CelularP);
$correoP    = str_replace(" ", "", $correoP); 
$correoP    = strtolower($correoP);
$sql = "UPDATE honorario SET 
        CelularH = '$CelularP',
        CorreoH = '$correoP'
        WHERE IDTraH = '$idh'";
if (mysqli_query($conn, $sql)) {
    $response = array(
        'success' => true,
        'message' => 'Información actualizada correctamente.'
    );
    echo json_encode($response);
} else {
    $response = array(
        'success' => false,
        'message' => 'Error al actualizar la información: ' . mysqli_error($conn)
    );
    echo json_encode($response);
}
mysqli_close($conn);
?>
