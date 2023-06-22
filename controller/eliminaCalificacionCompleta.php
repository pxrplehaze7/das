<?php
if (isset($_POST['idCalificacion'])) {
    $idcalificacion = $_POST['idCalificacion'];

    include("../controller/config/conexion.php");

    $eliminarcalificacion = "DELETE FROM calificaciones WHERE IDCalif = '$idcalificacion'";
    if (mysqli_query($conn, $eliminarcalificacion)) {
        echo "Calificación eliminada exitosamente.";
    } else {
        echo "Error al eliminar la calificación: " . mysqli_error($conn);
    }
    mysqli_close($conn);
} else {
    echo "No se recibió el ID de la calificacion a eliminar.";
}
