<?php
include("../controller/config/conexion.php");

// SE RECIBEN LOS DATOS DE LOS INPUTS DESDE EL FORM
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
// $obser = $POST['nameObserv'];
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

// Consulta SQL para actualizar los datos
$sql = "UPDATE trabajador SET 
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
        -- Observ = '$obser'
        WHERE IDTra = '$idtrab'";
// Ejecutar consulta SQL
if (mysqli_query($conn, $sql)) {
  // La actualización fue exitosa
  $response = array(
      'success' => true,
      'message' => 'Información actualizada correctamente.'
  );
  echo json_encode($response);
} else {
  // Error al actualizar
  $response = array(
      'success' => false,
      'message' => 'Error al actualizar la información: ' . mysqli_error($conn)
  );
  echo json_encode($response);
}


// Cerrar conexión
mysqli_close($conn);
?>
