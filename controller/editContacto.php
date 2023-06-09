<?php
include("../controller/config/conexion.php");

$idTrabajador = $_POST['idTrabajador'];
$CelularP   = $_POST['nameCelular'];
$correoP    = $_POST['nameCorreo'];

$CelularP   = str_replace(" ", "", $CelularP);
$correoP    = str_replace(" ", "", $correoP); 

// Consulta SQL para actualizar los datos
$sql = "UPDATE trabajador SET 
        CelularTra = '$CelularP',
        CorreoTra = '$correoP'
        WHERE IDTra = '$idTrabajador'";

// Ejecutar consulta SQL
if (mysqli_query($conn, $sql)) {
    // La actualización fue exitosa
    $response = array(
        'success' => true,
        'message' => 'Información actualizada correctamente.'
    );
    echo json_encode($response);
} else {
    // Error al actualizar
    $response = array(
        'success' => false,
        'message' => 'Error al actualizar la información: ' . mysqli_error($conn)
    );
    echo json_encode($response);
}

// Cerrar conexión
mysqli_close($conn);
?>
