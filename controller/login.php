<?php
include("../controller/config/conexion.php");

$correo = $_POST['correoL'];
$contrasenna = $_POST['contrasennaL'];

$sql = "SELECT * FROM usuario WHERE CorreoU = '$correo' AND Contrasenna = '$contrasenna'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $rol = $row['Rol'];
    $nombre = $row['NombreU'];
    $apellidop = $row['ApellidoP'];
    $apellidom = $row['ApellidoM'];
    $idusuariop = $row['IDUsuario'];

    session_start();

    $_SESSION['correo'] = $correo;
    $_SESSION['rol'] = $rol;
    $_SESSION['idperfil'] = $idusuariop;

    $nombreCompleto = $nombre;
    if (!empty($apellidop)) {
        $nombreCompleto .= ' ' . $apellidop;
    }
    if (!empty($apellidom)) {
        $nombreCompleto .= ' ' . $apellidom;
    }
    
    $_SESSION['nombre'] = $nombreCompleto;

    header('Location:../home.php');
    exit();
} else {
    header('Location: index.html?error=1');
    exit();
}

$conn->close();
?>

