<?php
session_start();

// Recibimos los datos del formulario
$usuario = $_POST['nameCorreoU'];
$pass = $_POST['nameClaveU'];

// Conectamos a la base de datos
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "das";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

// Verificamos que el usuario este registrado
$queryUsuario = "SELECT * FROM usuario WHERE CorreoU ='$usuario' AND Contrasenna='$pass'";
$resultQueryUsuario = mysqli_query($conn, $queryUsuario);

//Este if revisa que exista una fila que coincida con el usuario
if (mysqli_num_rows($resultQueryUsuario) == 1) {
    // Si encuentra un resultado, iniciamos la sesión y guardamos los datos del usuario en variables de sesión
    $_SESSION['username'] = $usuario;
    $_SESSION['password'] = $pass;

    // Redireccionamos al usuario al listado de trabajadores
    header("Location: listado.php");

}else {
    // Si los datos entregados por el usuario no coinciden, mostramos un mensaje de error
    echo "Correo Electrónico o contraseña incorrecta";
}

mysqli_close($conn);
//Cerramos la conexión
?>



