<?php
// Conexión a la base de datos
require("./config/conexion.php");

// Verificar si el correo ya está registrado en la base de datos
$correo = $_POST['correo'];
$sqlcorreoU = "SELECT * FROM usuario WHERE CorreoU='$correo'";
$resultcorreo = $conn->query($sqlcorreoU);
if ($resultcorreo->num_rows > 0) {
  // El correo ya está registrado, devolver respuesta indicando que no es válido
  echo '<div class="alert alert-danger" role="alert">Este correo ya está registrado</div>';
} else {
  // El correo no está registrado, devolver respuesta indicando que es válido
  echo "VALIDO";
}
$conn->close();
?>
