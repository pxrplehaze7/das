<?php
include("./config/conexion.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idTrabajador = $_POST['nameTrabCa'];
    $idCalificacion= $_POST['nameCa'];
    $annoInicio        = $_POST['nameInicio'];
    $annoFin        = $_POST['nameFin'];
    $mesInicio       = $_POST['mesinicio'];
    $mesFin        = $_POST['mesfin'];
    $apelo        = $_POST['nameApeloRes'];
    $rut          = $_POST['nameRutCa'];
    $host = $_SERVER['HTTP_HOST'];
    $ruta = 'PDFS/CONTRATA_E_INDEFINIDOS/';
    $annoInicio = mysqli_real_escape_string($conn, $annoInicio);
    $annoFin = mysqli_real_escape_string($conn, $annoFin);
    $mesInicio = mysqli_real_escape_string($conn, $mesInicio);
    $mesFin = mysqli_real_escape_string($conn, $mesFin);

    $apelo = mysqli_real_escape_string($conn, $apelo);
    $fecha = $mesInicio. '_' .$annoInicio . '-' . $mesFin. '_' .$annoFin;


    $fecha = mysqli_real_escape_string($conn, $fecha);
    $fechaActual = new DateTime('now', new DateTimeZone('America/Santiago'));
    $fechaActual = $fechaActual->format('d-m-Y');
    $pdfcalificacion = 'CALIFICACION_PERIODO_' . $fecha . '_' . $fechaActual . '_' . uniqid() . '.pdf';
    $pdfapelo = 'APELACION_PERIODO_' . $fecha . '_' . $fechaActual . '_' . uniqid() . '.pdf';



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
                    $nombreCalificacion = 'CALIFICACION_PERIODO_' . $fecha . '_' . $fechaActual . '_' . $pdfcalificacion;
                    $ruta_CalifFINAL = $rutaTrabajador . $nombreCalificacion;
                    move_uploaded_file($_FILES['nameCalif_'.$idCalificacion]['tmp_name'], $ruta_CalifFINAL);
                    $ruta_CalifFINAL = 'http://' . $host . '/das/controller/' . $ruta_CalifFINAL;
                } else {
                    $ruta_CalifFINAL = $EditC['RutaCalificacion'];
                }
                if (!empty($pdfapelo)) {
                    $nombreApelacion = 'APELACION_PERIODO_' . $fecha . '_' . $fechaActual . '_' . $pdfapelo;
                    $ruta_ApelaFINAL = $rutaTrabajador . $nombreApelacion;
                    move_uploaded_file($_FILES['nameApela_'.$idCalificacion]['tmp_name'], $ruta_ApelaFINAL);
                    $ruta_ApelaFINAL = 'http://' . $host . '/das/controller/' . $ruta_ApelaFINAL;
                } else {
                    $ruta_ApelaFINAL = $EditC['RutaApelacion'];
                }

                $califEdit = "UPDATE calificaciones SET 
                    MesInicio = '$mesInicio',
                    MesFin = '$mesInicio',
                    AnnoInicio = '$annoInicio',
                    AnnoFin = '$annoFin',
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
        
    }else {

    echo "Error";
}

mysqli_close($conn);
