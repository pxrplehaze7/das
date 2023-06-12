<?php
include("../controller/config/conexion.php");



$nombreU    = $_POST['namePersona'];
$paternoU   = $_POST['namePaterno'];
$maternoU   = $_POST['nameMaterno'];
$correoU    = $_POST['nameCorreo'];
$pass       = $_POST['namePass'];
$permiso    = $_POST['namePermiso'];
$correoU    = str_replace(" ", "", $correoU); 



  // SE INSERTAN DATOS A LA BASE DE DATOS
  $sqlUsuario = " INSERT INTO usuario (NombreU,ApellidoP,ApellidoM,CorreoU,Contrasenna,Rol)
   VALUES ('$nombreU','$paternoU','$maternoU','$correoU','$pass',$permiso)";


if (mysqli_query($conn, $sqlUsuario)) {
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
