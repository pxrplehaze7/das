<?php
// Conexión a la base de datos
require("./config/conexion.php");
$rut = $_POST['rut'];
$sql = "SELECT * FROM trabajador WHERE Rut='$rut'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo '<div id="rut-validationU" class="alert alert-danger" role="alert">Este RUT ya está registrado</div>';
} else {
  echo "VALIDO";
}
$conn->close();
?>