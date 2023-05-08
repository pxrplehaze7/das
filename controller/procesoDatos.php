<?php
//print_r($_FILES)
//imprime lo que recibe por FILE

//recbir datos de inputs
//rut
//rutPersona
//sexo


$rutPersona = $_POST['rut'];


// $SQL= "INSERT INTO PERSONAS ..."

$pdfAFP = $_FILES['nameAFPdoc']['name'];
$pdfNacimiento = $_FILES['nameNACdoc']['name'];

// Ruta donde se guardarán los archivos PDF
$ruta = 'pdfs/';

// Crear una carpeta con el valor del input de tipo texto
if (!file_exists($ruta . $rutPersona)) {
    mkdir($ruta . $rutPersona, 0777, true);

    // Crear subcarpetas para los archivos AFP y de nacimiento
    mkdir($ruta . $rutPersona . '/AFP/', 0777, true);
    mkdir($ruta . $rutPersona . '/NACIMIENTO/', 0777, true);

}
  
  // Mover los archivos PDF a la nueva ubicación
  move_uploaded_file($_FILES['nameAFPdoc']['tmp_name'], $ruta . $rutPersona . '/AFP/' . $pdfAFP);
  move_uploaded_file($_FILES['nameNACdoc']['tmp_name'], $ruta . $rutPersona . '/NACIMIENTO/' . $pdfNacimiento);
  
  echo "Archivos guardados correctamente en la ruta: " . $ruta . $rutPersona;






?>