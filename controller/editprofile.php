<?php
include("../controller/config/conexion.php");
$idperf    = $_POST['idperson'];
$nombreU    = $_POST['namePersona'];
$paternoU   = $_POST['namePaterno'];
$maternoU   = $_POST['nameMaterno'];
$correoU    = $_POST['nameCorreo'];
$pass       = $_POST['namePass'];
$correoU    = str_replace(" ", "", $correoU); 
$correoU    = strtolower($correoU);
$hashedPass = password_hash($pass, PASSWORD_DEFAULT);
$sqlcambio = "UPDATE usuario SET
NombreU = '$nombreU',
ApellidoP = '$paternoU',
ApellidoM = '$maternoU',
CorreoU = '$correoU',
Contrasenna = '$hashedPass'
WHERE IDUsuario = '$idperf'";
if (mysqli_query($conn, $sqlcambio)) {
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
