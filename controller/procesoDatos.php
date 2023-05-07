<?php
//print_r($_FILES)
//imprime lo que recibe por FILE

//recbir datos de inputs
//rut
//nombre
//sexo
//


$nombre = $_POST['nombre'];


// $SQL= "INSERT INTO PERSONAS ..."

$pdf1 = $_FILES['pdf-files']['name'];
$pdf2 = $_FILES['pdf2-files']['name'];

// Ruta donde se guardarán los archivos PDF
$ruta = 'pdfs/';

// Crear una carpeta con el valor del input de tipo texto
if (!file_exists($ruta . $nombre)) {
    mkdir($ruta . $nombre, 0777, true);
}
  
  // Mover los archivos PDF a la nueva ubicación
  move_uploaded_file($_FILES['pdf-files']['tmp_name'], $ruta . $nombre . '/' . $pdf1);
  move_uploaded_file($_FILES['pdf2-files']['tmp_name'], $ruta . $nombre . '/' . $pdf2);
  
  echo "Archivos guardados correctamente en la ruta: " . $ruta . $nombre;







?>