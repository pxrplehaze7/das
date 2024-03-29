<?php
include("./config/conexion.php");
if (isset($_POST['nameTrabCa']) && isset($_POST['nameInicio']) && isset($_POST['nameFin']) && isset($_POST['nameApeloRes']) && isset($_POST['nameRutCa'])) {
    //SE RECIBEN LOS DATOS DE LOS INPUTS DESDE EL FORM
    $idTrabajador = $_POST['nameTrabCa'];
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

    if (!file_exists($ruta . $idTrabajador)) {
        mkdir($ruta . $idTrabajador, 0777, true);
    }
    $rutaCalificaciones = $ruta . $idTrabajador . '/CALIFICACIONES/';
    if (!file_exists($rutaCalificaciones)) {
        mkdir($rutaCalificaciones, 0777, true);
    }
    $rutaApelaciones = $ruta . $idTrabajador . '/CALIFICACIONES/';
    if (!file_exists($rutaApelaciones)) {
        mkdir($rutaApelaciones, 0777, true);
    }
    $ruta_CalifFINAL = $rutaCalificaciones . $pdfcalificacion;
    $ruta_ApelaFINAL = $rutaApelaciones . $pdfapelo;

    $sql = "SELECT * FROM trabajador WHERE Rut = '$rut'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        if (!empty($_FILES['nameCalifdoc']['tmp_name'])) {
            move_uploaded_file($_FILES['nameCalifdoc']['tmp_name'], $ruta_CalifFINAL);
            $ruta_CalifFINAL = 'http://' . $host . '/das/controller/' . $ruta_CalifFINAL;
        }

        if (!empty($_FILES['nameApelacionDoc']['tmp_name'])) {
            move_uploaded_file($_FILES['nameApelacionDoc']['tmp_name'], $ruta_ApelaFINAL);
            $ruta_ApelaFINAL = 'http://' . $host . '/das/controller/' . $ruta_ApelaFINAL;
        }else{
            $ruta_ApelaFINAL = '';
        }

        $sqlCalificacion = "INSERT INTO calificaciones (IDTra, MesInicio, AnnoInicio, MesFin, AnnoFin, apelo, RutaApelacion, RutaCalificacion) 
        VALUES ('$idTrabajador','$mesInicio','$annoInicio','$mesFin','$annoFin','$apelo','$ruta_ApelaFINAL', '$ruta_CalifFINAL')";



        if (mysqli_query($conn, $sqlCalificacion)) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Calificación guardada exitosamente'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error al guardar los archivos: ' . mysqli_error($conn)
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'El rut ingresado no existe'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Faltan datos del formulario'
    ]);
}
