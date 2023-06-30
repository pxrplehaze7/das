<?php 
include("../controller/config/conexion.php");
$idDEC = $_POST['idDec'];

$sqlAlerta = "UPDATE decretos
SET Confirmacion = 1
WHERE IDdecreto = $idDEC";

if (mysqli_query($conn, $sqlAlerta)) {
  $response = array(
    'success' => true,
    'message' => 'El decreto ha sido confirmado.'
  );
} else {
  $response = array(
    'success' => false,
    'message' => 'Hubo un error al confirmar el decreto: ' . mysqli_error($conn)
  );
}

mysqli_close($conn);

echo json_encode($response);
?>
