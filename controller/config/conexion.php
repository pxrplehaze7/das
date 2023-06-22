<?php

$conn = mysqli_connect('localhost', 'root', '', 'das');

// SE VERIFICAN LOS DATOS DE CONEXION
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>