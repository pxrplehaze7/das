<?php
include("../controller/config/conexion.php");
$iduser = $_POST['nameidu'];
$nombreU    = trim($_POST['namePersona']);
$paternoU   = trim($_POST['namePaterno']);
$maternoU   = trim($_POST['nameMaterno']);
$correoU    = trim($_POST['nameCorreo']);
$permiso    = $_POST['namePermiso'];
$correoU    = str_replace(" ", "", $correoU);
$correoU    = strtolower($correoU);

$sqlUsuarioE = "UPDATE usuario SET 
  NombreU = '$nombreU',
  ApellidoP = '$paternoU',
  ApellidoM = '$maternoU',
  CorreoU = '$correoU',
  Rol = '$permiso'
WHERE IDUsuario = '$iduser'";
if (mysqli_query($conn, $sqlUsuarioE)) {
    $response = array(
        'success' => true,
        'message' => 'Usuario registrado exitosamente.'
    );
    echo json_encode($response);
} else {
    $response = array(
        'success' => false,
        'message' => 'Error al registrar: ' . mysqli_error($conn)
    );
    echo json_encode($response);
}
mysqli_close($conn);
?>


