<?php
// CONEXION A LA BASE DE DATOS
include("./config/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idTrabajador = $_POST['idtracal'];

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'namefecha_') !== false) {
            $idCalificacion = substr($key, strlen('namefecha_'));
            $fechaCal = $_POST['namefecha_'.$idCalificacion];
            $apelo = $_POST['nameapelo_'.$idCalificacion];

            $fechaActual = new DateTime('now', new DateTimeZone('America/Santiago'));
            $fechaActual = $fechaActual->format('d-m-Y');
            $host = $_SERVER['HTTP_HOST'];
            $ruta = 'pdfs_personal/';

            $pdfcalificacion = (!empty($_FILES['nameCalif_'.$idCalificacion]['name'])) ? uniqid() . '.pdf' : '';
            $pdfapelo = (!empty($_FILES['nameApela_'.$idCalificacion]['name'])) ? uniqid() . '.pdf' : '';

            $consultaDoc = "SELECT * FROM calificaciones WHERE IDCalif = '$idCalificacion'";
            $resFile = mysqli_query($conn, $consultaDoc);

            if (mysqli_num_rows($resFile) == 1) {
                $EditC = mysqli_fetch_assoc($resFile);

                if (!file_exists($ruta . $idTrabajador)) {
                    mkdir($ruta . $idTrabajador, 0777, true);
                }
                $rutaCalificaciones = $ruta . $idTrabajador . '/CALIFICACIONES/';

                if (!file_exists($rutaCalificaciones)) {
                    mkdir($rutaCalificaciones, 0777, true);
                }

                $rutaTrabajador = $rutaCalificaciones;
                if (!file_exists($rutaTrabajador)) {
                    mkdir($rutaTrabajador, 0777, true);
                }
            }

            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM calificaciones WHERE IDCalif = '$idCalificacion'")) > 0) {

                if (!empty($pdfcalificacion)) {
                    $nombreCalificacion = 'CALIFICACION_PERIODO_' . $fechaCal . '_' . $fechaActual . '_' . $pdfcalificacion;
                    $ruta_CalifFINAL = $rutaTrabajador . $nombreCalificacion;
                    move_uploaded_file($_FILES['nameCalif_'.$idCalificacion]['tmp_name'], $ruta_CalifFINAL);
                    $ruta_CalifFINAL = 'http://' . $host . '/das/controller/' . $ruta_CalifFINAL;
                } else {
                    $ruta_CalifFINAL = $EditC['RutaCalificacion'];
                }

                if (!empty($pdfapelo)) {
                    $nombreApelacion = 'APELACION_PERIODO_' . $fechaCal . '_' . $fechaActual . '_' . $pdfapelo;
                    $ruta_ApelaFINAL = $rutaTrabajador . $nombreApelacion;
                    move_uploaded_file($_FILES['nameApela_'.$idCalificacion]['tmp_name'], $ruta_ApelaFINAL);
                    $ruta_ApelaFINAL = 'http://' . $host . '/das/controller/' . $ruta_ApelaFINAL;
                } else {
                    $ruta_ApelaFINAL = $EditC['RutaApelacion'];
                }

                // Actualizar la información en la base de datos
                $califEdit = "UPDATE calificaciones SET 
                    fecha = '$fechaCal',
                    RutaCalificacion = '$ruta_CalifFINAL',
                    apelo = '$apelo',
                    RutaApelacion = '$ruta_ApelaFINAL'
                    WHERE IDCalif = '$idCalificacion'";

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
                    if (file_exists($rutaTrabajador)) {
                        $files = glob($rutaTrabajador . '*');
                        foreach ($files as $file) {
                            if (is_file($file)) {
                                unlink($file);
                            }
                        }
                        rmdir($rutaTrabajador);
                    }

                    $response = [
                        'success' => false,
                        'message' => 'Error al guardar los archivos: ' . $e->getMessage()
                    ];

                    echo json_encode($response);
                    exit;
                }
            }
        }
    }
} else {
    // La solicitud no es de tipo POST, manejar el caso de error o redireccionar si es necesario
    echo "Error: se esperaba una solicitud POST";
}

mysqli_close($conn);
?>
