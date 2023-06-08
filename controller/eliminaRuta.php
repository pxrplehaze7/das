<?php
include("./config/conexion.php");
$rut = $_POST['rut'];
$campo = $_POST['campo'];
$sqlRuta = "UPDATE trabajador SET $campo='' WHERE Rut='$rut'";
$resultado = mysqli_query($conn, $sqlRuta);
if ($resultado) {
    echo "Exito"; // Agregar esta línea para indicar éxito
  } else {
    echo "Error al eliminar el archivo: " . mysqli_error($conn);
  }
?>
