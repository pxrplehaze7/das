<?php
include("../controller/config/conexion.php");
$idtrab = $_POST['laid'];
$rutInput = $_POST['RutInput'];
$nombreP    = trim($_POST['namePersona']);
$paternoP   = trim($_POST['namePaterno']);
$maternoP   = trim($_POST['nameMaterno']);
$generoP    = $_POST['nameGenero'];
$profesionP = trim($_POST['nameProfesion']);
$inscripcionOno = $_POST['nameInscrip'];
$afpP       = $_POST['nameSelectAFP'];
$prevP       = $_POST['nameSelectPrev'];
$observ = $_POST['nameObserv'];
$categoriaP = $_POST['nameSelectCat'];
if ($categoriaP == 1) {
  // SI ES IGUAL A 1 (CATEGORIA A) TOMA EL VALOR DEL INPUT RADIO Y LO ASIGNA A LA VARIABLE
  $medicoOno  = $_POST['nameMedico'];
} else {
  // SI ES DISTINTO DE 1, SE ASIGNA UN NO
  $medicoOno  = 'No';
}



$sqlRuta = "UPDATE trabajador SET 
        IDCat = $categoriaP,
        IDAFP = $afpP,
        IDPrev = $prevP,
        Rut = '$rutInput',
        NombreTra = '$nombreP',
        PaternoTra = '$paternoP',
        MaternoTra = '$maternoP',
        Genero = '$generoP',
        Medico = '$medicoOno',
        Inscripcion = $inscripcionOno,
        Profesion = '$profesionP',
        Observ = '$observ'
        WHERE IDTra = '$idtrab'";
$resultado1 = mysqli_query($conn, $sqlRuta);

$consultaFile = "SELECT * FROM trabajador WHERE IDTra = '$idtrab'";
$resFile = mysqli_query($conn, $consultaFile);
if (mysqli_num_rows($resFile) == 1) {
  $EditP = mysqli_fetch_assoc($resFile);
  $genero2    = $EditP['Genero'];
  $inscripcionOno2 = $EditP['Inscripcion'];
  $medicoOno2 = $EditP['Medico'];
}

if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM trabajador WHERE IDTra = '$idtrab'")) > 0) {
    $ruta_nacFINAL = $EditP['RutaNac'];
    $ruta_AntecedentesFINAL = $EditP['RutaAntec'];
    $ruta_afpFINAL = $EditP['RutaAFP'];
    $ruta_militarFINAL = $EditP['RutaSerM'];
    $ruta_CedulaFINAL = $EditP['RutaCedula'];
    $ruta_CurriculumFINAL = $EditP['RutaCV'];
    $ruta_ExamenMFINAL = $EditP['RutaExaM'];
    $ruta_PrevisionFINAL = $EditP['RutaPrev'];
    $ruta_EstudiosFINAL = $EditP['RutaEstudio'];
    $ruta_DJuradaFINAL = $EditP['RutaDJur'];
    $ruta_SaludCompatFINAL = $EditP['RutaSCom'];
    $ruta_InscripcionFINAL = $EditP['RutaInscripcion'];
  }
  if (
    // HOMBRE NO HONORARIO, NO ES MÉDICO NI PRESENTA INSCRIPCIÓN
    ($genero2 == "Masculino" &&
      $medicoOno2 == "No" &&
      $inscripcionOno2 == 0 &&
      !empty($ruta_DJuradaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_AntecedentesFINAL) &&
      !empty($ruta_nacFINAL) &&
      !empty($ruta_afpFINAL) &&
      !empty($ruta_PrevisionFINAL) &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_SaludCompatFINAL) &&
      !empty($ruta_militarFINAL)
    )
    ||
    // HOMBRE NO HONORARIO, ES MÉDICO Y PRESENTA INSCRIPCIÓN
    ($genero2 == "Masculino" &&
      $medicoOno2 == "Si" &&
      $inscripcionOno2 == 1 &&
      !empty($ruta_DJuradaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_AntecedentesFINAL) &&
      !empty($ruta_nacFINAL) &&
      !empty($ruta_afpFINAL) &&
      !empty($ruta_PrevisionFINAL) &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_SaludCompatFINAL) &&
      !empty($ruta_militarFINAL) &&
      !empty($ruta_InscripcionFINAL) &&
      !empty($ruta_ExamenMFINAL)
    )
    ||
    // HOMBRE NO HONORARIO, ES MÉDICO Y NO PRESENTA INSCRIPCIÓN
    ($genero2 == "Masculino" &&
      $medicoOno2 == "Si" &&
      $inscripcionOno2 == 0 &&
      !empty($ruta_DJuradaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_AntecedentesFINAL) &&
      !empty($ruta_nacFINAL) &&
      !empty($ruta_afpFINAL) &&
      !empty($ruta_PrevisionFINAL) &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_SaludCompatFINAL) &&
      !empty($ruta_militarFINAL) &&
      !empty($ruta_ExamenMFINAL)
    )
    ||
    // HOMBRE NO HONORARIO, NO ES MÉDICO Y PRESENTA INSCRIPCIÓN
    ($genero2 == "Masculino" &&
      $medicoOno2 == "No" &&
      $inscripcionOno2 == 1 &&
      !empty($ruta_DJuradaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_AntecedentesFINAL) &&
      !empty($ruta_nacFINAL) &&
      !empty($ruta_afpFINAL) &&
      !empty($ruta_PrevisionFINAL) &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_SaludCompatFINAL) &&
      !empty($ruta_militarFINAL) &&
      !empty($ruta_InscripcionFINAL)
    )
    ||
    // MUJER NO HONORARIO, ES MÉDICO Y PRESENTA INSCRIPCIÓN
    ($genero2 == "Femenino" &&
      $medicoOno2 == "Si" &&
      $inscripcionOno2 == 1 &&
      !empty($ruta_DJuradaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_AntecedentesFINAL) &&
      !empty($ruta_nacFINAL) &&
      !empty($ruta_afpFINAL) &&
      !empty($ruta_PrevisionFINAL) &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_SaludCompatFINAL) &&
      !empty($ruta_InscripcionFINAL) &&
      !empty($ruta_ExamenMFINAL)
    )
    ||
    // MUJER NO HONORARIO, ES MÉDICO Y NO PRESENTA INSCRIPCIÓN
    ($genero2 == "Femenino" &&
      $medicoOno2 == "Si" &&
      $inscripcionOno2 == 0 &&
      !empty($ruta_DJuradaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_AntecedentesFINAL) &&
      !empty($ruta_nacFINAL) &&
      !empty($ruta_afpFINAL) &&
      !empty($ruta_PrevisionFINAL) &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_SaludCompatFINAL) &&
      !empty($ruta_ExamenMFINAL)
    )
    ||
    // MUJER NO HONORARIO, NO ES MÉDICO Y PRESENTA INSCRIPCIÓN
    ($genero2 == "Femenino" &&
      $medicoOno2 == "No" &&
      $inscripcionOno2 == 1 &&
      !empty($ruta_DJuradaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_AntecedentesFINAL) &&
      !empty($ruta_nacFINAL) &&
      !empty($ruta_afpFINAL) &&
      !empty($ruta_PrevisionFINAL) &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_SaludCompatFINAL) &&
      !empty($ruta_InscripcionFINAL)
    )
    ||
    // MUJER NO HONORARIO, NO ES MÉDICO Y NO PRESENTA INSCRIPCIÓN
    ($genero2 == "Femenino" &&
      $medicoOno2 == "No" &&
      $inscripcionOno2 == 0 &&
      !empty($ruta_DJuradaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_AntecedentesFINAL) &&
      !empty($ruta_nacFINAL) &&
      !empty($ruta_afpFINAL) &&
      !empty($ruta_PrevisionFINAL) &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_SaludCompatFINAL)
    )
  ) {
    $cumple = 1;
  } else {
    $cumple = 0;
  }
$actualizaC = "UPDATE trabajador SET Cumple = '$cumple' WHERE IDTra = '$idtrab'";

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

