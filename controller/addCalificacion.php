<?php
// CONEXION A LA BASE DE DATOS
include("./config/conexion.php");

// Verificar si se recibieron los datos del formulario
if (isset($_POST['nameTrabCa']) && isset($_POST['nameInicio']) && isset($_POST['nameFin']) && isset($_POST['nameApeloRes']) && isset($_POST['nameRutCa'])) {
    //SE RECIBEN LOS DATOS DE LOS INPUTS DESDE EL FORM
    $idTrabajador = $_POST['nameTrabCa'];
    $desde        = $_POST['nameInicio'];
    $hasta        = $_POST['nameFin'];
    $apelo        = $_POST['nameApeloRes'];
    $rut          = $_POST['nameRutCa'];
    $fechaActual = date('d-m-Y');

    // OBTIENE EL NOMBRE EL HOST
    $host = $_SERVER['HTTP_HOST'];

    // CARPETA DONDE SE GUARDARAN CARPETAS SEGUN RUT
    $ruta = 'pdfs_personal/';

    $desde = mysqli_real_escape_string($conn, $desde);
    $hasta = mysqli_real_escape_string($conn, $hasta);
    $apelo = mysqli_real_escape_string($conn, $apelo);

    $fecha = $desde . '-' . $hasta;
    $fecha = mysqli_real_escape_string($conn, $fecha);

    $pdfcalificacion = str_replace(array(' ', '(', ')'), '_', $_FILES['nameCalifdoc']['name']);
    $pdfapelo        = str_replace(array(' ', '(', ')'), '_', $_FILES['nameApelacionDoc']['name']);


    if (!file_exists($ruta . $rut)) {
        mkdir($ruta . $rut, 0777, true);
    }
    $rutaCalificaciones = $ruta . $rut . '/CALIFICACIONES/';
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

    // REVISA SI EL RUT EXISTE EN LA BASE DE DATOS
    $sql = "SELECT * FROM trabajador WHERE Rut = '$rut'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $ruta_CalifFINAL = NULL;
        $ruta_ApelaFINAL = NULL;

        if (!empty($_FILES['nameCalifdoc']['tmp_name'])) {
            $nombreCalificacion = 'CALIFICACION_' . $fecha . '_' . $fechaActual . '_' . $pdfcalificacion;
            $ruta_CalifFINAL = $rutasubCalificaciones . $nombreCalificacion;
            move_uploaded_file($_FILES['nameCalifdoc']['tmp_name'], $ruta_CalifFINAL);
            $ruta_CalifFINAL = 'http://' . $host . '/das/controller/' . $ruta_CalifFINAL;
        }

        if (!empty($_FILES['nameApelacionDoc']['tmp_name'])) {
            $nombreApelacion = 'APELACION_' . $fecha . '_' . $fechaActual . '_' . $pdfapelo;
            $ruta_ApelaFINAL = $rutaApelaciones . $nombreApelacion;
            move_uploaded_file($_FILES['nameApelacionDoc']['tmp_name'], $ruta_ApelaFINAL);
            $ruta_ApelaFINAL = 'http://' . $host . '/das/controller/' . $ruta_ApelaFINAL;
        }

        // SE INSERTAN DATOS A LA BASE DE DATOS
        $sqlCalificacion = "INSERT INTO calificaciones (IDTra, fecha, apelo, RutaApelacion, RutaCalificacion) 
        VALUES ('$idTrabajador','$fecha','$apelo','$ruta_ApelaFINAL', '$ruta_CalifFINAL')";

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
?>
