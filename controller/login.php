<?php
session_start();

include("../controller/config/conexion.php");

$correo = $_POST['correoL'];
$contrasenna = $_POST['contrasennaL'];

$sql = "SELECT * FROM usuario WHERE CorreoU = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashedPass = $row['Contrasenna'];
    
    // Verificar la contraseña utilizando password_verify()
    if (password_verify($contrasenna, $hashedPass)) {
        $rol = $row['Rol'];
        $nombre = $row['NombreU'];
        $apellidop = $row['ApellidoP'];
        $apellidom = $row['ApellidoM'];
        $idusuariop = $row['IDUsuario'];
    
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
    }
}

$_SESSION['login_error'] = true;
header('Location: ../index.php');
exit();

$conn->close();
?>
