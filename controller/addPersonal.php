<?php
//print_r($_FILES)
//imprime lo que recibe por FILE


// Conectar a la base de datos
include("./config/conexion.php");

//recbir datos de inputs
$rutPersona = $_POST['rut'];
$generoPersona = $_POST['genero'];
$idAFP = $_POST['nameSelectAFP'];
//afp
//fonasa

// $SQL= "INSERT INTO PERSONAS ..."


//Elimina los espacios y los reemplazapor _
$pdfAFP = str_replace(array(' ', '(', ')'), '_', $_FILES['nameAFPdoc']['name']);
$pdfNacimiento = str_replace(array(' ', '(', ')'), '_', $_FILES['nameNACdoc']['name']);
$pdfMilitar = str_replace(array(' ', '(', ')'), '_', $_FILES['nameMilitarDoc']['name']);




// Obtener el nombre del host (localhost)
$host = $_SERVER['HTTP_HOST'];

// Ruta donde se guardarán los archivos PDF
$ruta = 'pdfs_personal/';

// Crear una carpeta con el valor del input de tipo texto
if (!file_exists($ruta . $rutPersona)) {
    mkdir($ruta . $rutPersona, 0777, true);

    // Crear subcarpetas para los archivos AFP y de nacimiento
    mkdir($ruta . $rutPersona . '/AFP/', 0777, true);
    mkdir($ruta . $rutPersona . '/C_NACIMIENTO/', 0777, true);
    mkdir($ruta . $rutPersona . '/S_MILITAR/', 0777, true);
}

// Crear la ruta final del archivo
$ruta_afpFINAL = $ruta . $rutPersona . '/AFP/' . $pdfAFP;
$ruta_nacFINAL = $ruta . $rutPersona . '/C_NACIMIENTO/' . $pdfNacimiento;
$ruta_militarFINAL = $ruta . $rutPersona . '/S_MILITAR/' . $pdfMilitar;

// Mover los archivos PDF a la nueva ubicación
move_uploaded_file($_FILES['nameAFPdoc']['tmp_name'], $ruta_afpFINAL);
move_uploaded_file($_FILES['nameNACdoc']['tmp_name'], $ruta_nacFINAL);
move_uploaded_file($_FILES['nameMilitarDoc']['tmp_name'], $ruta_militarFINAL);

// Construir la URL completa a la ubicación del archivo
$url_afpFINAL = 'http://' . $host . '/personal/controller/' . $ruta_afpFINAL;
$url_nacFINAL = 'http://' . $host . '/personal/controller/' . $ruta_nacFINAL;
$url_militarFINAL = 'http://' . $host . '/personal/controller/' . $ruta_militarFINAL;

// Insertar la ruta final del archivo en la base de datos
$sql = "INSERT INTO trabajador (Rut, Genero, RutaAFP, RutaNac, RutaSerM, IDAFP) VALUES 
('$rutPersona', '$generoPersona','$url_afpFINAL' , '$url_nacFINAL', '$url_militarFINAL', '$idAFP')";

if (mysqli_query($conn, $sql)) {
    echo "Archivos guardados correctamente en la ruta";
} else {
    echo "Error al guardar los archivos: " . mysqli_error($conn);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);