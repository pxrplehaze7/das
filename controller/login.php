<?php
include("../controller/config/conexion.php");

// Obtener los datos del formulario
$correo = $_POST['correoL'];
$contrasenna = $_POST['contrasennaL'];

// Consultar la base de datos para verificar las credenciales
$sql = "SELECT * FROM usuario WHERE CorreoU = '$correo' AND Contrasenna = '$contrasenna'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $rol = $row['Rol'];
    $nombre = $row['NombreU'];
    $apellidop = $row['ApellidoP'];
    $apellidom = $row['ApellidoM'];

    // Iniciar sesión o establecer las variables de sesión necesarias
    session_start();
    $_SESSION['correo'] = $correo;
    $_SESSION['rol'] = $rol;
    
    $nombreCompleto = $nombre;
    if (!empty($apellidop)) {
        $nombreCompleto .= ' ' . $apellidop;
    }
    if (!empty($apellidom)) {
        $nombreCompleto .= ' ' . $apellidom;
    }
    
    $_SESSION['nombre'] = $nombreCompleto;

    // Redireccionar al usuario según su rol
    header('Location:../home.php');
    exit();
} else {
    // Las credenciales son incorrectas, redireccionar al formulario de inicio de sesión con un mensaje de error
    header('Location: index.html?error=1');
    exit();
}

$conn->close();
?>

