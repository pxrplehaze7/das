<?php
// CONEXION A LA BASE DE DATOS
include("./config/conexion.php");

//SE RECIBEN LOS DATOS DE LOS INPUTS DESDE EL FORM
$idcalif = $_POST['idcal'];
$rutPersona = $_POST['nameRUT'];
$fecha_input = $_POST['namefecha_cal'];
$sionoapelo = $_POST['nameapeloEDIT'];

$fechaActual = date('d-m-Y');

// OBTIENE EL NOMBRE EL HOST
$host = $_SERVER['HTTP_HOST'];

// CARPETA DONDE SE GUARDARAN CARPETAS SEGUN RUT
$ruta = 'pdfs_personal/';

// print_r($_FILES);
// exit();
$pdfcalificacion = (!empty($_FILES['nameCalifEDIT']['name'])) ? str_replace(array(' ', '(', ')'), '_', $_FILES['nameCalifEDIT']['name']) : '';

$pdfapelo = (!empty($_FILES['nameApelaEDIT']['name'])) ? str_replace(array(' ', '(', ')'), '_', $_FILES['nameApelaEDIT']['name']) : '';

$consultaDoc = "SELECT * FROM calificaciones WHERE IDCalif = '$idcalif'";
$resFile = mysqli_query($conn, $consultaDoc);
if (mysqli_num_rows($resFile) == 1) {
    $EditC = mysqli_fetch_assoc($resFile);
} {
    if (!file_exists($ruta . $rutPersona)) {
        mkdir($ruta . $rutPersona, 0777, true);
    }
    $rutaCalificaciones = $ruta . $rutPersona . '/CALIFICACIONES/';
    if (!file_exists($rutaCalificaciones)) {
        mkdir($rutaCalificaciones, 0777, true);
    }
    $rutasubCalificaciones = $rutaCalificaciones . 'CALIFICACIONES/';
    $rutaApelaciones = $rutaCalificaciones . 'APELACIONES/';

    if (!file_exists($rutasubCalificaciones)) {
        mkdir($rutasubCalificaciones, 0777, true);
    }
    if (!file_exists($rutaApelaciones)) {
        mkdir($rutaApelaciones, 0777, true);
    }
}
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM calificaciones WHERE IDCalif = '$idcalif'")) > 0) {

    if (!empty($pdfcalificacion)) {
        $nombreCalificacion = 'CALIFICACION_' . $fechaActual . '_' . $pdfcalificacion;
        $ruta_CalifFINAL = $rutasubCalificaciones . $nombreCalificacion;
        move_uploaded_file($_FILES['nameCalifEDIT']['tmp_name'], $ruta_CalifFINAL);
        $ruta_CalifFINAL = 'http://' . $host . '/das/controller/' . $ruta_CalifFINAL;
    } else {
        $ruta_CalifFINAL = $EditC['RutaCalificacion'];
    }

    if (!empty($pdfapelo)) {
        $nombreApelacion = 'APELACION_' . $fechaActual . '_' . $pdfapelo;
        $ruta_ApelaFINAL = $rutaApelaciones . $nombreApelacion;
        move_uploaded_file($_FILES['nameApelaEDIT']['tmp_name'], $ruta_ApelaFINAL);
        $ruta_ApelaFINAL = 'http://' . $host . '/das/controller/' . $ruta_ApelaFINAL;
    } else {
        $ruta_ApelaFINAL = $EditC['RutaApelacion'];
    }

    $califEdit = "UPDATE calificaciones SET 
      fecha = '$fecha_input',
      apelo = '$sionoapelo',
      RutaCalificacion = '$ruta_CalifFINAL',
RutaApelacion = '$ruta_ApelaFINAL'
     
      WHERE IDCalif = '$idcalif'";
    // echo $califEdit;
    // exit();


    try {
        $resultado = mysqli_query($conn, $califEdit);

        if (!$resultado) {
            throw new Exception(mysqli_error($conn));
        } else {
            $response = [
                'success' => true,
                'message' => 'Guardado correctamente'
            ];

            echo json_encode($response);
            exit;
        }
    } catch (Exception $e) {
        if (file_exists($ruta . $rutPersona)) {
            $files = glob($ruta . $rutPersona . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($ruta . $rutPersona);
        }

        $response = [
            'success' => false,
            'message' => 'Error al guardar los archivos: ' . $e->getMessage()
        ];

        echo json_encode($response);
        exit;
    }
}

mysqli_close($conn);
