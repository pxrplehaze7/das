<?php
include("./config/conexion.php");
if (isset($_POST['lugarSeleccionado'])) {
    $lugarSeleccionado = $_POST['lugarSeleccionado'];
    $respuesta = array();
    $sql = "SELECT IDSector, NombreSector FROM sector WHERE IDLugar = $lugarSeleccionado";
    $result = mysqli_query($conn, $sql);
  
    $i=0;


    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $respuesta[$i] = $row;
            $i++;
        }
    }

    echo json_encode($respuesta);
}
?>
