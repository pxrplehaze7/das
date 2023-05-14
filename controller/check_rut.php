<?php
// Conexión a la base de datos
require("./config/conexion.php");

// Verificar si el RUT ya está registrado en la base de datos
$rut = $_POST['rut'];
$sql = "SELECT * FROM trabajador WHERE Rut='$rut'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // El RUT ya está registrado, devolver respuesta indicando que no es válido
  echo "<p style='color: red;padding-left: 9px;padding-top: 5px;'>ESTE RUT YA ESTÁ REGISTRADO</p>";
} else {
  // El RUT no está registrado, devolver respuesta indicando que es válido
  echo "<p style='color: green;padding-left: 9px;padding-top: 5px;'>ESTE RUT ES VÁLIDO</p>";
}
$conn->close();
?>
