<?php
// Conexión a la base de datos
$conn = mysqli_connect('localhost', 'root', '', 'das');

// Verificación de la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>