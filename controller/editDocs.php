<?php
// CONEXION A LA BASE DE DATOS
include("./config/conexion.php");


//SE RECIBEN LOS DATOS DE LOS INPUTS DESDE EL FORM
$rutPersona = $_POST['rut'];
$host = $_SERVER['HTTP_HOST'];
$fechaActual = date('d-m-Y');

// CARPETA DONDE SE GUARDARAN CARPETAS SEGUN RUT
$ruta = 'pdfs_personal/';
$pdfNacimiento   = str_replace(array(' ', '(', ')'), '_', $_FILES['nameNACdocEDIT']['name']);
$pdfAntecedentes = str_replace(array(' ', '(', ')'), '_', $_FILES['nameANTECEdocEDIT']['name']);
$consultaFile = "SELECT * FROM trabajador WHERE Rut = '$rutPersona'";
$resFile = mysqli_query($conn, $consultaFile);
if (mysqli_num_rows($resFile) == 1) {
    // Si se encuentra una persona, se asigna el resultado a $persona
    $EditP = mysqli_fetch_assoc($resFile);
    $generoP    = $EditP['Genero'];
    $inscripcionOno = $EditP['Inscripcion'];
    $medicoOno = $EditP['Medico'];
    $contratoP = $EditP['IDCon'];
}


// CARPETAS CON NOMBRE SEGUN EL RUT, SI NO EXISTE LA CREA
if (!file_exists($ruta . $rutPersona)) {
    mkdir($ruta . $rutPersona, 0777, true);
}

// REVISA SI EL RUT EXISTE EN LA BASE DE DATOS
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM trabajador WHERE Rut = '$rutPersona'")) > 0) {

    // SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
    if (!empty($pdfNacimiento)) {

        $nombreNacimiento = 'CNACIMIENTO_' . str_replace('-', '_', $fechaActual) . '_' . $pdfNacimiento;
        $ruta_nacFINAL = $ruta . $rutPersona . '/' . $nombreNacimiento;
        move_uploaded_file($_FILES['nameNACdocEDIT']['tmp_name'], $ruta_nacFINAL);
        $ruta_nacFINAL = 'http://' . $host . '/das/controller/' . $ruta_nacFINAL;
    } else {
        $ruta_nacFINAL = $EditP['RutaNac'];
    }


    if (!empty($pdfAntecedentes)) {

        $nombreAntecedentes = 'ANTECEDENTES_' . str_replace('-', '_', $fechaActual) . '_' . $pdfAntecedentes;
        $ruta_AntecedentesFINAL = $ruta . $rutPersona . '/' . $nombreAntecedentes;
        move_uploaded_file($_FILES['nameANTECEdocEDIT']['tmp_name'], $ruta_AntecedentesFINAL);
        $ruta_AntecedentesFINAL = 'http://' . $host . '/das/controller/' . $ruta_AntecedentesFINAL;
    } else {
        $ruta_AntecedentesFINAL = $EditP['RutaAntec'];
    }



    if (
        // SI ES HOMBRE O MUJER Y ES HONORARIO Y MEDICO
        (($generoP == "Masculino" || $generoP == "Femenino") && $medicoOno == "Si" && $inscripcionOno == 0 && $contratoP == 3 && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_ExamenMFINAL) && !empty($ruta_InscripcionFINAL))
        ||
        // SI ES HOMBRE O MUJER Y ES HONORARIO PERO NO MEDICO
        (($generoP == "Masculino" || $generoP == "Femenino") && $medicoOno == "No" && $inscripcionOno == 0 && $contratoP == 3 && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_ContratoFINAL))
        ||
        // SI ES HOMBRE Y NO ES HONORARIO NI MEDICO
        ($generoP == "Masculino" && $contratoP != 3 && $medicoOno == "No" && $inscripcionOno == 0 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_militarFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL))
        ||
        // SI ES HOMBRE, MEDICO Y NO ES HONORARIO
        ($generoP == "Masculino" && $medicoOno == "Si" && $contratoP != 3 && $inscripcionOno == 0 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_militarFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_ExamenMFINAL) && !empty($ruta_InscripcionFINAL))
        ||
        // SI ES MUJER, MEDICO Y NO ES HONORARIO
        ($generoP == "Femenino" && $medicoOno == "Si" && $contratoP != 3 && $inscripcionOno == 0 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_ExamenMFINAL) && !empty($ruta_InscripcionFINAL))
        ||
        // SI ES MUJER, NO ES MEDICO NI HONORARIO
        ($generoP == "Femenino" && $medicoOno == "No" && $contratoP != 3 && $inscripcionOno == 0 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL))
        ||
        // SI ES HOMBRE O MUJER Y ES HONORARIO Y MEDICO y SUBE INSCRIPCION
        (($generoP == "Masculino" || $generoP == "Femenino") && $medicoOno == "Si" && $inscripcionOno == 1 && $contratoP == 3 && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_ExamenMFINAL) && !empty($ruta_InscripcionFINAL))
        ||
        // SI ES HOMBRE O MUJER Y ES HONORARIO PERO NO MEDICO y SUBE INSCRIPCION
        (($generoP == "Masculino" || $generoP == "Femenino") && $medicoOno == "No" && $contratoP == 3 && $inscripcionOno == 1 && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_InscripcionFINAL))
        ||
        // SI ES HOMBRE Y NO ES HONORARIO NI MEDICO Y SUBE INSCRIPCION
        ($generoP == "Masculino" && $contratoP != 3 && $medicoOno == "No" && $inscripcionOno == 1 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_militarFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_InscripcionFINAL))
        ||
        // SI ES HOMBRE, MEDICO Y NO ES HONORARIO Y SUBEINSCRIPCION
        ($generoP == "Masculino" && $medicoOno == "Si" && $contratoP != 3 && $inscripcionOno == 1 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_militarFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_ExamenMFINAL) && !empty($ruta_InscripcionFINAL))
        ||
        // SI ES MUJER, MEDICO Y NO ES HONORARIO Y SUBE INSCRIPCION
        ($generoP == "Femenino" && $medicoOno == "Si" && $contratoP != 3 && $inscripcionOno == 1 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_ExamenMFINAL) && !empty($ruta_InscripcionFINAL))
        ||
        // SI ES MUJER, NO ES MEDICO NI HONORARIO Y SUBE INSCRIPCION
        ($generoP == "Femenino" && $medicoOno == "No" && $contratoP != 3 && $inscripcionOno == 1 && !empty($ruta_afpFINAL) && !empty($ruta_nacFINAL) && !empty($ruta_AntecedentesFINAL) && !empty($ruta_CedulaFINAL) && !empty($ruta_CurriculumFINAL) && !empty($ruta_PrevisionFINAL) && !empty($ruta_EstudiosFINAL) && !empty($ruta_DJuradaFINAL) && !empty($ruta_SaludCompatFINAL) && !empty($ruta_ContratoFINAL) && !empty($ruta_InscripcionFINAL))
    ) {
        $cumple = true;
    } else {
        $cumple = false;
    }


    // SE INSERTAN DATOS A LA BASE DE DATOS
    $sqlTraEdit = " UPDATE trabajador SET 
    RutaNac = '$ruta_nacFINAL',
    RutaAntec = '$ruta_AntecedentesFINAL',
    Cumple = '$cumple'
    WHERE Rut = '$rutPersona'";




    try {
        $resultado = mysqli_query($conn, $sqlTraEdit);

        if (!$resultado) {
            throw new Exception(mysqli_error($conn));
        } else {
            echo "<script> Swal.fire({
        icon: 'success',
        title: 'Guardado Correctamente',
        showConfirmButton: false,
        timer: 3000
      });</script>";
        }
    } catch (Exception $e) {
        echo "<script> Swal.fire({
      icon: 'error',
      title: 'Error al guardar los archivos: " . $e->getMessage() . "',
      showConfirmButton: false,
      timer: 3000
    });</script>";
        // Eliminar los archivos antes de eliminar la carpeta si hubo un error de inserción
        if (file_exists($ruta . $rutPersona)) {
            $files = glob($ruta . $rutPersona . '/*'); // Obtener todos los archivos dentro de la carpeta
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file); // Eliminar cada archivo
                }
            }
            rmdir($ruta . $rutPersona); // Eliminar la carpeta vacía

        }

        echo "<script> Swal.fire({
      icon: 'error',
      title: 'Error al guardar los archivos: " . $e->getMessage() . "',
      showConfirmButton: false,
      timer: 3000
    });</script>";
    }
} else {
    echo "El rut no existe, no se han subido archivos.";
}

// SE CIERRA LA CONEXION A LA BASE DE DATOS
mysqli_close($conn);
