<?php
if (isset($_POST['idinf'])) {
    $idinforme = $_POST['idinf'];
    include("../controller/config/conexion.php");
    $eliminarinforme = "DELETE FROM informes WHERE IDinf = '$idinforme'";
    if (mysqli_query($conn, $eliminarinforme)) {
        echo "Informe eliminado exitosamente.";
    } else {
        echo "Error al eliminar el informe: " . mysqli_error($conn);
    }
    mysqli_close($conn);
} else {
    echo "No se recibió el ID del informe a eliminar.";
}
