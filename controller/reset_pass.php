<?php
include("../controller/config/conexion.php");
$iduser = $_POST['nameidu'];
$rutr    = $_POST['nameRut'];
$rutSinGuion = str_replace('-', '', $rutr);
$pass = substr($rutSinGuion, 0, -1); 
$pass = "DAS" . $pass;
$hashedPass = password_hash($pass, PASSWORD_DEFAULT);

// SE INSERTAN DATOS A LA BASE DE DATOS
$sqlReset = "UPDATE usuario SET 
  Contrasenna = '$hashedPass'
WHERE IDUsuario = '$iduser'";

if (mysqli_query($conn, $sqlReset)) {
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


