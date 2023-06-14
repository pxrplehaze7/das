<?php
include("../controller/config/conexion.php");
//ARREGLAR TODO
$correo = $_POST['correoL'];
$contrasenna = $_POST['contrasennaL'];

// Ejemplo básico de autenticación (solo como referencia, no lo uses en producción sin mejoras de seguridad)
$sql = "SELECT * FROM usuario WHERE CorreoU = '$correo' AND Contrasenna = '$contrasenna'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $rol = $row['Rol'];

    // Iniciar sesión o establecer las variables de sesión necesarias
    session_start();
    $_SESSION['correo'] = $correo;
    $_SESSION['rol'] = $rol;

    // Redireccionar al usuario según su rol
    if ($rol == 'administrador') {
        header('Location: pagina_administrador.php');
    } elseif ($rol == 'usuario') {
        header('Location: pagina_usuario.php');
    } else {
        // Rol desconocido, redireccionar a una página de error
        header('Location: error.php');
    }
    exit();
} else {
    // Las credenciales son incorrectas, redireccionar al formulario de inicio de sesión con un mensaje de error
    header('Location: index.html?error=1');
    exit();
}

$conn->close();
?>

