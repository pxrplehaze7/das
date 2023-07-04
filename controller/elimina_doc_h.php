<?php
include("./config/conexion.php");
$idh = $_POST['idh'];
$campo = $_POST['campo'];
$sqlRuta = "UPDATE honorario SET $campo='' WHERE IDTraH='$idh'";
$resultado = mysqli_query($conn, $sqlRuta);
if ($resultado) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}

$consultaFile = "SELECT * FROM honorario WHERE IDTraH = '$idh'";
$resFile = mysqli_query($conn, $consultaFile);
if (mysqli_num_rows($resFile) == 1) {
  // Si se encuentra una persona, se asigna el resultado a $persona
  $EditP = mysqli_fetch_assoc($resFile);
  $generoP    = $EditP['Genero'];
  $inscripcionOno = $EditP['Inscripcion'];
  $medicoOno = $EditP['Medico'];
}

// REVISA SI EL RUT EXISTE EN LA BASE DE DATOS
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM honorario WHERE IDTraH = '$idh'")) > 0) {

  $ruta_AntecedentesFINAL = $EditP['RutaAntec'];
  $ruta_CedulaFINAL = $EditP['RutaCedula'];
  $ruta_CurriculumFINAL = $EditP['RutaCV'];
  $ruta_ExamenMFINAL = $EditP['RutaExaM'];
  $ruta_EstudiosFINAL = $EditP['RutaEstudio'];
  $ruta_InscripcionFINAL = $EditP['RutaInscripcion'];
}

if (
  (
    // HONORARIO HOMBRE O MUJER ES MÉDICO Y PRESENTA INSCRIPCIÓN *VERSIÓN CON ANTECEDENTES, PREGUNTAR POR CONTRATO
    
    $medicoOno == "Si" &&
    $inscripcionOno == TRUE &&
    !empty($ruta_CurriculumFINAL) &&
    !empty($ruta_CedulaFINAL) &&
    !empty($ruta_InscripcionFINAL) &&
    !empty($ruta_EstudiosFINAL) &&
    !empty($ruta_ExamenMFINAL) &&
    !empty($ruta_AntecedentesFINAL)
  )
  ||
  (
    // HONORARIO HOMBRE O MUJER ES MÉDICO Y NO PRESENTA INSCRIPCIÓN *VERSIÓN CON ANTECEDENTES, PREGUNTAR POR CONTRATO

    $medicoOno == "Si" &&
    $inscripcionOno == FALSE &&
    !empty($ruta_CurriculumFINAL) &&
    !empty($ruta_CedulaFINAL) &&
    !empty($ruta_EstudiosFINAL) &&
    !empty($ruta_ExamenMFINAL) &&
    !empty($ruta_AntecedentesFINAL)
  )
  ||
  // HONORARIO HOMBRE O MUJER QUE NO ES MÉDICO PERO PRESENTA INSCRIPCIÓN *VERSIÓN CON ANTECEDENTES, PREGUNTAR POR CONTRATO
  (
    $medicoOno == "No" &&
    $inscripcionOno == TRUE &&
    !empty($ruta_CurriculumFINAL) &&
    !empty($ruta_CedulaFINAL) &&
    !empty($ruta_InscripcionFINAL) &&
    !empty($ruta_EstudiosFINAL) &&
    !empty($ruta_AntecedentesFINAL))
  ||
  // HONORARIO HOMBRE O MUJER QUE NO ES MÉDICO NI PRESENTA INSCRIPCIÓN *VERSIÓN CON ANTECEDENTES, PREGUNTAR POR CONTRATO
  (
    $medicoOno == "No" &&
    $inscripcionOno == FALSE &&
    !empty($ruta_CurriculumFINAL) &&
    !empty($ruta_CedulaFINAL) &&
    !empty($ruta_EstudiosFINAL) &&
    !empty($ruta_AntecedentesFINAL))
 
  
) {
  $cumple = TRUE;
} else {
  $cumple = FALSE;
}

$actualizaC = " UPDATE honorario SET 
    Cumple = '$cumple'
    WHERE IDTraH = '$idh'";

try {
  $resultado = mysqli_query($conn, $actualizaC);

  if (!$resultado) {
    throw new Exception(mysqli_error($conn));
  } else {
    echo "<script> Swal.fire({
        icon: 'success',
        title: 'Cumplimiento actualizado correctamente',
        showConfirmButton: false,
        timer: 3000
      });</script>";

   
  }
} catch (Exception $e) {

  echo "<script> 
    Swal.fire({
      icon: 'error',
      title: `Error al actualizar el cumplimiento: " . $e->getMessage() . "`,
      showConfirmButton: false,
      timer: 3600
    });
    </script>";
}
mysqli_close($conn);





