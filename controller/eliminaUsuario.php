<?php
if (isset($_POST['idUsuario'])) {
    $idUsuario = $_POST['idUsuario'];

    include("../controller/config/conexion.php");

    $eliminarUsuario = "DELETE FROM usuario WHERE IDUsuario = '$idUsuario'";
    if (mysqli_query($conn, $eliminarUsuario)) {
        echo "Usuario eliminado exitosamente.";
    } else {
        echo "Error al eliminar el usuario: " . mysqli_error($conn);
    }
    mysqli_close($conn);
} else {
    echo "No se recibió el ID del usuario a eliminar.";
}
