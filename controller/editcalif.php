<?php
// CONEXION A LA BASE DE DATOS
include("./config/conexion.php");

//SE RECIBEN LOS DATOS DE LOS INPUTS DESDE EL FORM
$idcalif = $_POST['idcalif'];
$rutPersona = $_POST['nameRUT'];
$fecha_input = $_POST['namefecha_cal'];
$sionoapelo = $_POST['nameapeloEDIT'];
echo $idcalif;
echo $sionoapelo;

$fechaActual = new DateTime('now', new DateTimeZone('America/Santiago'));

// Formatea la fecha actual en el formato deseado (d-m-Y)
$fechaActual = $fechaActual->format('d-m-Y');
// OBTIENE EL NOMBRE EL HOST
$host = $_SERVER['HTTP_HOST'];

// CARPETA DONDE SE GUARDARAN LOS ARCHIVOS
$ruta = 'pdfs_personal/';

$pdfcalificacion = (!empty($_FILES['nameCalifEDIT']['name'])) ? uniqid() . '.pdf' : '';

$pdfapelo = (!empty($_FILES['nameApelaEDIT']['name'])) ? uniqid() . '.pdf' : '';

$consultaDoc = "SELECT * FROM calificaciones WHERE IDCalif = '$idcalif'";
$resFile = mysqli_query($conn, $consultaDoc);

echo $pdfcalificacion;
echo $pdfapelo;

if (mysqli_num_rows($resFile) == 1) {
    $EditC = mysqli_fetch_assoc($resFile);

    if (!file_exists($ruta . $rutPersona)) {
        mkdir($ruta . $rutPersona, 0777, true);
    }
    $rutaCalificaciones = $ruta . $rutPersona . '/CALIFICACIONES/';

    if (!file_exists($rutaCalificaciones)) {
        mkdir($rutaCalificaciones, 0777, true);
    }

    $rutaApelaciones = $ruta . $rutPersona . '/CALIFICACIONES/';
    if (!file_exists($rutaApelaciones)) {
        mkdir($rutaApelaciones, 0777, true);
    }
}

if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM calificaciones WHERE IDCalif = '$idcalif'")) > 0) {

    if (!empty($pdfcalificacion)) {
        $nombreCalificacion = 'CALIFICACION_' . $fechaActual . '_' . $pdfcalificacion;
        $ruta_CalifFINAL = $rutaCalificaciones . $nombreCalificacion;
        move_uploaded_file($_FILES['nameCalifEDIT']['tmp_name'], $ruta_CalifFINAL);
        $ruta_CalifFINAL = 'http://' . $host . '/das/controller/' . $ruta_CalifFINAL;
    } else {
        $ruta_CalifFINAL = $EditC['RutaCalificacion'];
    }
    echo $ruta_CalifFINAL;

    if (!empty($pdfapelo)) {
        $nombreApelacion = 'APELACION_' . $fechaActual . '_' . $pdfapelo;
        $ruta_ApelaFINAL = $rutaApelaciones . $nombreApelacion;
        move_uploaded_file($_FILES['nameApelaEDIT']['tmp_name'], $ruta_ApelaFINAL);
        $ruta_ApelaFINAL = 'http://' . $host . '/das/controller/' . $ruta_ApelaFINAL;
    } else {
        $ruta_ApelaFINAL = $EditC['RutaApelacion'];
    }

    echo $ruta_ApelaFINAL;

    // Actualizar la información en la base de datos
    $califEdit = "UPDATE calificaciones SET 
      fecha = '$fecha_input',
      apelo = '$sionoapelo',
      RutaCalificacion = '$ruta_CalifFINAL',
      RutaApelacion = '$ruta_ApelaFINAL'
     
      WHERE IDCalif = '$idcalif'";

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
        if (file_exists($rutaCalificaciones)) {
            $files = glob($rutaCalificaciones . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($rutaCalificaciones);
        }

        if (file_exists($rutaApelaciones)) {
            $files = glob($rutaApelaciones . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($rutaApelaciones);
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
?>
