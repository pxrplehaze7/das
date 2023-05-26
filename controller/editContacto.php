<?php
include("../controller/config/conexion.php");

$rutInicial = $_POST['rutInicio'];
$CelularP   = $_POST['nameCelular'];
$correoP    = $_POST['nameCorreo'];

$CelularP   = str_replace(" ", "", $CelularP);
$correoP    = str_replace(" ", "", $correoP); 

// Consulta SQL para actualizar los datos
$sql = "UPDATE trabajador SET 
        CelularTra = '$CelularP',
        CorreoTra = '$correoP'
        WHERE Rut = '$rutInicial'";

// Ejecutar consulta SQL
if (mysqli_query($conn, $sql)) {
    echo "Información actualizada correctamente.";
} else {
    echo "Error al actualizar la información: " . mysqli_error($conn);
}

// Cerrar conexión
mysqli_close($conn);
?>
