<?php
// Conexión a la base de datos
// $conn = mysqli_connect('localhost', 'root', '', 'pruebaarchivo');
$conn = mysqli_connect('localhost', 'root', '', 'dasPruebas');

// Verificación de la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>