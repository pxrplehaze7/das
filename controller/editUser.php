<?php
include("../controller/config/conexion.php");
$iduser = $_POST['nameidu'];
$nombreU    = $_POST['namePersona'];
$paternoU   = $_POST['namePaterno'];
$maternoU   = $_POST['nameMaterno'];
$correoU    = $_POST['nameCorreo'];
$permiso    = $_POST['namePermiso'];
$correoU    = str_replace(" ", "", $correoU);

// SE INSERTAN DATOS A LA BASE DE DATOS
$sqlUsuarioE = "UPDATE usuario SET 
  NombreU = '$nombreU',
  ApellidoP = '$paternoU',
  ApellidoM = '$maternoU',
  CorreoU = '$correoU',
  Rol = '$permiso'
WHERE IDUsuario = '$iduser'";

if (mysqli_query($conn, $sqlUsuarioE)) {
    // La actualización fue exitosa
    $response = array(
        'success' => true,
        'message' => 'Usuario registrado exitosamente.'
    );
    echo json_encode($response);
} else {
    // Error al actualizar
    $response = array(
        'success' => false,
        'message' => 'Error al registrar: ' . mysqli_error($conn)
    );
    echo json_encode($response);
}

// Cerrar conexión
mysqli_close($conn);
?>


