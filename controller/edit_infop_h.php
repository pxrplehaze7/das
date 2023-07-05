<?php
include("../controller/config/conexion.php");
$idh = $_POST['idh'];
$rutInput = $_POST['RutInput'];
$nombreP    = $_POST['namePersona'];
$paternoP   = $_POST['namePaterno'];
$maternoP   = $_POST['nameMaterno'];
$generoP    = $_POST['nameGenero'];
$profesionP = $_POST['nameProfesion'];
$inscripcionOno = $_POST['nameInscrip'];
$observ = $_POST['nameObserv'];
$categoriaP = $_POST['nameSelectCat'];
if ($categoriaP == 1) {
  // SI ES IGUAL A 1 (CATEGORIA A) TOMA EL VALOR DEL INPUT RADIO Y LO ASIGNA A LA VARIABLE
  $medicoOno  = $_POST['nameMedico'];
} else {
  // SI ES DISTINTO DE 1, SE ASIGNA UN NO
  $medicoOno  = 'No';
}

$sqlRuta = "UPDATE honorario SET 
        IDCat = $categoriaP,
        Rut = '$rutInput',
        NombreH = '$nombreP',
        PaternoH = '$paternoP',
        MaternoH = '$maternoP',
        Genero = '$generoP',
        Medico = '$medicoOno',
        Inscripcion = $inscripcionOno,
        Profesion = '$profesionP',
        Observ = '$observ'
        WHERE IDTraH = '$idh'";

$resultado1 = mysqli_query($conn, $sqlRuta);

$consultaFile = "SELECT * FROM honorario WHERE IDTraH = '$idh'";
$resFile = mysqli_query($conn, $consultaFile);
if (mysqli_num_rows($resFile) == 1) {
  $EditP = mysqli_fetch_assoc($resFile);
  $genero2    = $EditP['Genero'];
  $inscripcionOno2 = $EditP['Inscripcion'];
  $medicoOno2 = $EditP['Medico'];
}

if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM honorario WHERE IDTraH = '$idh'")) > 0) {
    $ruta_AntecedentesFINAL = $EditP['RutaAntec'];
    $ruta_CedulaFINAL = $EditP['RutaCedula'];
    $ruta_CurriculumFINAL = $EditP['RutaCV'];
    $ruta_ExamenMFINAL = $EditP['RutaExaM'];
    $ruta_EstudiosFINAL = $EditP['RutaEstudio'];
    $ruta_InscripcionFINAL = $EditP['RutaInscripcion'];
  }
  if (
    
      // HONORARIO HOMBRE O MUJER ES MÉDICO Y PRESENTA INSCRIPCIÓN *VERSIÓN CON ANTECEDENTES, PREGUNTAR POR CONTRATO
      (
      $medicoOno2 == "Si" &&
      $inscripcionOno2 == 1 &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_InscripcionFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_ExamenMFINAL) &&
      !empty($ruta_AntecedentesFINAL)
    )
    ||
    
      // HONORARIO HOMBRE O MUJER ES MÉDICO Y NO PRESENTA INSCRIPCIÓN *VERSIÓN CON ANTECEDENTES, PREGUNTAR POR CONTRATO
      (
      $medicoOno2 == "Si" &&
      $inscripcionOno2 == 0 &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_ExamenMFINAL) &&
      !empty($ruta_AntecedentesFINAL)
    )
    ||
    // HONORARIO HOMBRE O MUJER QUE NO ES MÉDICO PERO PRESENTA INSCRIPCIÓN *VERSIÓN CON ANTECEDENTES, PREGUNTAR POR CONTRATO
    (
      $medicoOno2 == "No" &&
      $inscripcionOno2 == 1 &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_InscripcionFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_AntecedentesFINAL))
    ||
    // HONORARIO HOMBRE O MUJER QUE NO ES MÉDICO NI PRESENTA INSCRIPCIÓN *VERSIÓN CON ANTECEDENTES, PREGUNTAR POR CONTRATO
    (
      $medicoOno2 == "No" &&
      $inscripcionOno2 == 0 &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_AntecedentesFINAL)))
  {
    $cumple = 1;
  } else {
    $cumple = 0;
  };
$actualizaC = "UPDATE honorario SET Cumple = '$cumple' WHERE IDTraH = '$idh'";

$resultado2 = mysqli_query($conn, $actualizaC);

if ($resultado1 && $resultado2) {
 $response = array(
  'success' => true,
  'message' => 'Información actualizada correctamente.'
);
echo json_encode($response);
} else {
$response = array(
  'success' => false,
  'message' => 'Error al actualizar la información: ' . mysqli_error($conn)
);
echo json_encode($response);
}
mysqli_close($conn);
?>

