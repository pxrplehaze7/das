<?php
// Conexión a la base de datos
require("./config/conexion.php");

// Verificar si el RUT ya está registrado en la base de datos
$rut = $_POST['rut'];
$sqlrutU = "SELECT * FROM usuario WHERE RutU='$rut'";
$resultrutU = $conn->query($sqlrutU);
if ($resultrutU->num_rows > 0) {
    // El RUT ya está registrado, devolver respuesta indicando que no es válido
    echo '<div id="rut-validationU" class="alert alert-danger" role="alert">Este RUT ya está registrado</div>';
} else {
    // El RUT no está registrado, devolver respuesta indicando que es válido
    echo "VALIDO";
  }
  $conn->close();
  ?>