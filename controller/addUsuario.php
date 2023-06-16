<?php
include("../controller/config/conexion.php");

$rut        = $_POST['nameRut'];
$nombreU    = $_POST['namePersona'];
$paternoU   = $_POST['namePaterno'];
$maternoU   = $_POST['nameMaterno'];
$correoU    = $_POST['nameCorreo'];
$permiso    = $_POST['namePermiso'];

$rutSinGuion = str_replace('-', '', $rut);
$pass = substr($rutSinGuion, 0, -1); 
$pass = "DAS" . $pass;
$correoU    = str_replace(" ", "", $correoU); 


  // SE INSERTAN DATOS A LA BASE DE DATOS
  $sqlUsuario = " INSERT INTO usuario (RutU,NombreU,ApellidoP,ApellidoM,CorreoU,Contrasenna,Rol)
   VALUES ('$rut','$nombreU','$paternoU','$maternoU','$correoU','$pass',$permiso)";


if (mysqli_query($conn, $sqlUsuario)) {
    // La actualización fue exitosa
    $response = array(
        'success' => true,
        'message' => 'Usuario registrado exitosamente.',
        'tempPass' => $pass
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
