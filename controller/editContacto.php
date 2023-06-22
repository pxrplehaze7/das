<?php
include("../controller/config/conexion.php");
$idtrab = $_POST['laid'];
$CelularP   = $_POST['nameCelular'];
$correoP    = $_POST['nameCorreo'];
$CelularP   = str_replace(" ", "", $CelularP);
$correoP    = str_replace(" ", "", $correoP); 
$correoP    = strtolower($correoP);
$sql = "UPDATE trabajador SET 
        CelularTra = '$CelularP',
        CorreoTra = '$correoP'
        WHERE IDTra = '$idtrab'";
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
