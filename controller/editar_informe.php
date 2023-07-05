<?php
include("./config/conexion.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idHonorario = $_POST['idtrah'];
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'nameAnno_') !== false) {
            $idInforme = substr($key, strlen('nameAnno_'));
            $anno = $_POST['nameAnno_'.$idInforme];
            $mes = $_POST['namemes_'.$idInforme];
            $funcion = $_POST['nameFuncion_'.$idInforme];

            $host = $_SERVER['HTTP_HOST'];
            $ruta = 'PDFS/HONORARIO/';
            $pdfinforme = (!empty($_FILES['nameINFORME_'.$idInforme]['name'])) ? uniqid() . '.pdf' : '';
            $consultaDoc = "SELECT * FROM informes WHERE IDinf = '$idInforme'";
            $resFile = mysqli_query($conn, $consultaDoc);
            if (mysqli_num_rows($resFile) == 1) {
                $EditC = mysqli_fetch_assoc($resFile);
                if (!file_exists($ruta . $idHonorario)) {
                    mkdir($ruta . $idHonorario, 0777, true);
                }
                $rutaInformes = $ruta . $idHonorario . '/INFORMES/';

                if (!file_exists($rutaInformes)) {
                    mkdir($rutaInformes, 0777, true);
                }
                $rutaHonorario = $rutaInformes;
                if (!file_exists($rutaHonorario)) {
                    mkdir($rutaHonorario, 0777, true);
                }
            }
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM informes WHERE IDinf = '$idInforme'")) > 0) {

                if (!empty($pdfinforme)) {
                    $nombreinforme = 'INFORME_PERIODO_' . $mes . '_' . $anno . '_' . $pdfinforme;
                    $ruta_informeFINAL = $rutaHonorario . $nombreinforme;
                    move_uploaded_file($_FILES['nameINFORME_'.$idInforme]['tmp_name'], $ruta_informeFINAL);
                    $ruta_informeFINAL = 'http://' . $host . '/das/controller/' . $ruta_informeFINAL;
                } else {
                    $ruta_informeFINAL = $EditC['RutaInforme'];
                }
              


                $informeedit = "UPDATE informes SET 
                    mes = '$mes',
                    RutaInforme = '$ruta_informeFINAL',
                    anno = '$anno',
                    funcion ='$funcion'
                    WHERE IDinf = '$idInforme'";

                try {
                    $resultado = mysqli_query($conn, $informeedit);

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

    echo "Error";
}

mysqli_close($conn);
?>
