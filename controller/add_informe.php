<?php
include("./config/conexion.php");
if (isset($_POST['nameIDH']) && isset($_POST['nameAnno'])  && isset($_POST['nameRut'])) {
    $idHonorario = $_POST['nameIDH'];
    $anno      = $_POST['nameAnno'];
    $mes       = $_POST['namemes'];
    $rut          = $_POST['nameRut'];
    $funcion         = $_POST['nameFuncion'];

    $host = $_SERVER['HTTP_HOST'];
    $ruta = 'PDFS/HONORARIO/';

    $anno = mysqli_real_escape_string($conn, $anno);
    $mes = mysqli_real_escape_string($conn, $mes);


    $pdfInforme = 'INFORME_PERIODO_' . $mes . '_' . $anno . '_' . uniqid() . '.pdf';

    if (!file_exists($ruta . $idHonorario)) {
        mkdir($ruta . $idHonorario, 0777, true);
    }
    $rutaInforme = $ruta . $idHonorario . '/INFORMES/';
    if (!file_exists($rutaInforme)) {
        mkdir($rutaInforme, 0777, true);
    }

    $ruta_informeFinal = $rutaInforme . $pdfInforme;

    $sql = "SELECT * FROM honorario WHERE Rut = '$rut'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        if (!empty($_FILES['nameCalifdoc']['tmp_name'])) {
            move_uploaded_file($_FILES['nameCalifdoc']['tmp_name'], $ruta_informeFinal);
            $ruta_informeFinal = 'http://' . $host . '/das/controller/' . $ruta_informeFinal;
        }


        $sqlInformes = "INSERT INTO informes (IDTraH, mes, anno, RutaInforme,funcion) 
        VALUES ('$idHonorario','$mes','$anno','$ruta_informeFinal','$funcion')";

        if (mysqli_query($conn, $sqlInformes)) {
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
