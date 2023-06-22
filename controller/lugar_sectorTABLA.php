<?php
include("./config/conexion.php");
if (isset($_POST['lugarSeleccionado'])) {
    $lugarSeleccionado = $_POST['lugarSeleccionado'];
    $respuesta = array();
    // SE AGREGA LA OPCION SELECCIONE AL INICIO DEL ARREGLO DE RESPUESTA
    $respuesta[] = array('IDSector' => '0', 'NombreSector' => 'Selecciona');

    $sql = "SELECT IDSector, NombreSector FROM sector WHERE IDLugar = $lugarSeleccionado";
    $result = mysqli_query($conn, $sql);
  
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $respuesta[] = $row;
        }
    }
    echo json_encode($respuesta);
}
?>
