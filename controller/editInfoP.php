<?php
include("../controller/config/conexion.php");
$idtrab = $_POST['laid'];
$rutInput = $_POST['RutInput'];
$nombreP    = $_POST['namePersona'];
$paternoP   = $_POST['namePaterno'];
$maternoP   = $_POST['nameMaterno'];
$generoP    = $_POST['nameGenero'];
$sector     = $_POST['nameSelectSector'];
$profesionP = $_POST['nameProfesion'];
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
if ($_POST['nameSelectCon'] != "") {
  // SI NO ESTA VACIO, SE ASIGNA EL VALOR
  $contratoP = $_POST['nameSelectCon'];
  // SI ESTA VACIO SE ASIGNA UN NULL
} else {
  $contratoP = "NULL"; // Agregamos comillas al NULL para que sea reconocido como una cadena
}
if ($_POST['nameSelectLugar'] != "") {
  // SI NO ESTA VACIO, SE ASIGNA EL VALOR
  $lugarP = $_POST['nameSelectLugar'];
  // SI ESTA VACIO SE ASIGNA UN NULL
} else {
  $lugarP = "NULL"; // Agregamos comillas al NULL para que sea reconocido como una cadena
}

$sqlRuta = "UPDATE trabajador SET 
        IDCat = $categoriaP,
        IDCon = $contratoP,
        IDLugar = $lugarP,
        IDSector = $sector,
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
  $contratoP2 = $EditP['IDCon'];
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
    $ruta_ContratoFINAL = $EditP['RutaContrato'];
    $ruta_InscripcionFINAL = $EditP['RutaInscripcion'];
  }
  if (
    (
      // HONORARIO HOMBRE O MUJER ES MÉDICO Y PRESENTA INSCRIPCIÓN *VERSIÓN CON ANTECEDENTES, PREGUNTAR POR CONTRATO
      ($genero2 == "Masculino" || $genero2 == "Femenino") &&
      $contratoP2 == 3 &&
      $medicoOno2 == "Si" &&
      $inscripcionOno2 == TRUE &&
      !empty($ruta_ContratoFINAL) &&
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
      ($genero2 == "Masculino" || $genero2 == "Femenino") &&
      $contratoP2 == 3 &&
      $medicoOno2 == "Si" &&
      $inscripcionOno2 == FALSE &&
      !empty($ruta_ContratoFINAL) &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_ExamenMFINAL) &&
      !empty($ruta_AntecedentesFINAL)
    )
    ||
    // HONORARIO HOMBRE O MUJER QUE NO ES MÉDICO PERO PRESENTA INSCRIPCIÓN *VERSIÓN CON ANTECEDENTES, PREGUNTAR POR CONTRATO
    (($genero2 == "Masculino" || $genero2 == "Femenino") &&
      $contratoP2 == 3 &&
      $medicoOno2 == "No" &&
      $inscripcionOno2 == TRUE &&
      !empty($ruta_ContratoFINAL) &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_InscripcionFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_AntecedentesFINAL))
    ||
    // HONORARIO HOMBRE O MUJER QUE NO ES MÉDICO NI PRESENTA INSCRIPCIÓN *VERSIÓN CON ANTECEDENTES, PREGUNTAR POR CONTRATO
    (($genero2 == "Masculino" || $genero2 == "Femenino") &&
      $contratoP2 == 3 &&
      $medicoOno2 == "No" &&
      $inscripcionOno2 == FALSE &&
      !empty($ruta_ContratoFINAL) &&
      !empty($ruta_CurriculumFINAL) &&
      !empty($ruta_CedulaFINAL) &&
      !empty($ruta_EstudiosFINAL) &&
      !empty($ruta_AntecedentesFINAL))
    ||
    // HOMBRE NO HONORARIO, NO ES MÉDICO NI PRESENTA INSCRIPCIÓN
    ($genero2 == "Masculino" &&
      $contratoP2 != 3 &&
      $medicoOno2 == "No" &&
      $inscripcionOno2 == FALSE &&
      !empty($ruta_ContratoFINAL) &&
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
      $contratoP2 != 3 &&
      $medicoOno2 == "Si" &&
      $inscripcionOno2 == TRUE &&
      !empty($ruta_ContratoFINAL) &&
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
      $contratoP2 != 3 &&
      $medicoOno2 == "Si" &&
      $inscripcionOno2 == FALSE &&
      !empty($ruta_ContratoFINAL) &&
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
      $contratoP2 != 3 &&
      $medicoOno2 == "No" &&
      $inscripcionOno2 == TRUE &&
      !empty($ruta_ContratoFINAL) &&
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
      $contratoP2 != 3 &&
      $medicoOno2 == "Si" &&
      $inscripcionOno2 == TRUE &&
      !empty($ruta_ContratoFINAL) &&
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
      $contratoP2 != 3 &&
      $medicoOno2 == "Si" &&
      $inscripcionOno2 == FALSE &&
      !empty($ruta_ContratoFINAL) &&
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
      $contratoP2 != 3 &&
      $medicoOno2 == "No" &&
      $inscripcionOno2 == TRUE &&
      !empty($ruta_ContratoFINAL) &&
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
      $contratoP2 != 3 &&
      $medicoOno2 == "No" &&
      $inscripcionOno2 == FALSE &&
      !empty($ruta_ContratoFINAL) &&
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
    $cumple = TRUE;
  } else {
    $cumple = FALSE;
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

