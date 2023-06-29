<?php
include("./config/conexion.php");
$sqlids = "SELECT MAX(IDTra) AS ultimoID FROM trabajador";
$resides = mysqli_query($conn, $sqlids);
$ids = mysqli_fetch_assoc($resides);
$ultimoID = $ids['ultimoID'];

if ($ultimoID === null) {
    $ultimoID = 0;
}
$idtraH = $ultimoID + 1;

$rutPersona = $_POST['rut'];
$nombreP    = $_POST['namePersona'];
$paternoP   = $_POST['namePaterno'];
$maternoP   = $_POST['nameMaterno'];
$generoP    = $_POST['nameGenero'];
$CelularP   = $_POST['nameCelular'];
$correoP    = $_POST['nameCorreo'];
$correoP    = strtolower($correoP);
$profesionP = $_POST['nameProfesion'];
$obsP       = $_POST['nameObserv'];
$inscripcionOno = $_POST['nameInscrip'];

$cumple = FALSE;
$host = $_SERVER['HTTP_HOST'];
$fechaActual = new DateTime('now', new DateTimeZone('America/Santiago'));
$fechaActual = $fechaActual->format('d-m-Y');
$fechaSubidaDoc = $fechaActual;
$ruta = 'pdfs_personal/';
$fechaActual = strtotime($fechaActual);


$categoriaP = $_POST['nameSelectCat'];
if ($categoriaP == 1) {
    // SI ES IGUAL A 1 (CATEGORIA A) TOMA EL VALOR DEL INPUT RADIO Y LO ASIGNA A LA VARIABLE
    $medicoOno  = $_POST['nameMedico'];
} else {
    //SI ES DISTINTO DE 1, SE ASIGNA UN NO
    $medicoOno  = 'No';
}


$nombreP    = mysqli_real_escape_string($conn, $nombreP);
$paternoP   = mysqli_real_escape_string($conn, $paternoP);
$maternoP   = mysqli_real_escape_string($conn, $maternoP);
$categoriaP = mysqli_real_escape_string($conn, $categoriaP);
$profesionP = mysqli_real_escape_string($conn, $profesionP);
$obsP       = mysqli_real_escape_string($conn, $obsP);
$CelularP   = str_replace(" ", "", $CelularP);
$correoP    = str_replace(" ", "", $correoP);

$pdfAntecedentes = (!empty($_FILES['nameANTECEdoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfCedula = (!empty($_FILES['nameCeduladoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfCurriculum = (!empty($_FILES['nameCVdoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfExamenM = (!empty($_FILES['nameExaMdoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfEstudios = (!empty($_FILES['nameEstudiodoc']['name'])) ? uniqid() . '.pdf' : '';
$pdfInscripcion = (!empty($_FILES['nameInscripdoc']['name'])) ? uniqid() . '.pdf' : '';



// CARPETAS CON NOMBRE LA ID, SI NO EXISTE LA CREA
if (!file_exists($ruta . $idtraH)) {
    mkdir($ruta . $idtraH, 0777, true);
}

// REVISA SI EL RUT EXISTE EN LA BASE DE DATOS
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM trabajador WHERE Rut = '$rutPersona'")) > 0) {
    echo "<script> Swal.fire({
    icon: 'error',
    title: 'El rut ya existe, no se han subido archivos.',
    showConfirmButton: false,
    timer: 3000
  });</script>";
    exit();
} else {
    //SI EL RUT NO EXISTE, SE ASIGNA NULL A LA RUTA FINAL
    $ruta_AntecedentesFINAL = NULL;
    $ruta_CedulaFINAL       = NULL;
    $ruta_CurriculumFINAL   = NULL;
    $ruta_ExamenMFINAL      = NULL;
    $ruta_EstudiosFINAL     = NULL;
    $ruta_InscripcionFINAL  = NULL;


    if (!empty($pdfAntecedentes)) {
        $nombreAntecedentes = 'ANTECEDENTES_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfAntecedentes;
        $ruta_AntecedentesFINAL = $ruta . $idtraH . '/' . $nombreAntecedentes;
        move_uploaded_file($_FILES['nameANTECEdoc']['tmp_name'], $ruta_AntecedentesFINAL);
        $ruta_AntecedentesFINAL = 'http://' . $host . '/das/controller/' . $ruta_AntecedentesFINAL;
    }
    if (!empty($pdfCedula)) {
        $nombreCedula = 'CEDULA_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfCedula;
        $ruta_CedulaFINAL = $ruta . $idtraH . '/' . $nombreCedula;
        move_uploaded_file($_FILES['nameCeduladoc']['tmp_name'], $ruta_CedulaFINAL);
        $ruta_CedulaFINAL = 'http://' . $host . '/das/controller/' . $ruta_CedulaFINAL;
    }
    if (!empty($pdfCurriculum)) {
        $nombreCurriculum = 'CURRICULUM_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfCurriculum;
        $ruta_CurriculumFINAL = $ruta . $idtraH . '/' . $nombreCurriculum;
        move_uploaded_file($_FILES['nameCVdoc']['tmp_name'], $ruta_CurriculumFINAL);
        $ruta_CurriculumFINAL = 'http://' . $host . '/das/controller/' . $ruta_CurriculumFINAL;
    }
    if (!empty($pdfExamenM)) {
        $nombreExamenM = 'EUNACOM_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfExamenM;
        $ruta_ExamenMFINAL = $ruta . $idtraH . '/' . $nombreExamenM;
        move_uploaded_file($_FILES['nameExaMdoc']['tmp_name'], $ruta_ExamenMFINAL);
        $ruta_ExamenMFINAL = 'http://' . $host . '/das/controller/' . $ruta_ExamenMFINAL;
    }

    if (!empty($pdfEstudios)) {
        $nombreEstudios = 'ESTUDIOS_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfEstudios;
        $ruta_EstudiosFINAL = $ruta . $idtraH . '/' . $nombreEstudios;
        move_uploaded_file($_FILES['nameEstudiodoc']['tmp_name'], $ruta_EstudiosFINAL);
        $ruta_EstudiosFINAL = 'http://' . $host . '/das/controller/' . $ruta_EstudiosFINAL;
    }

    if (!empty($pdfInscripcion)) {
        $nombreInscripcion = 'INSCRIPCION_' . str_replace('-', '_', $fechaSubidaDoc) . '_' . $pdfInscripcion;
        $ruta_InscripcionFINAL = $ruta . $idtraH . '/' . $nombreInscripcion;
        move_uploaded_file($_FILES['nameInscripdoc']['tmp_name'], $ruta_InscripcionFINAL);
        $ruta_InscripcionFINAL = 'http://' . $host . '/das/controller/' . $ruta_InscripcionFINAL;
    }

    if (
        // HONORARIO HOMBRE O MUJER ES MÉDICO Y PRESENTA INSCRIPCIÓN -- probado
        (($generoP == "Masculino" || $generoP == "Femenino") &&
            $medicoOno == "Si" &&
            $inscripcionOno == TRUE &&
            !empty($ruta_CurriculumFINAL) &&
            !empty($ruta_CedulaFINAL) &&
            !empty($ruta_InscripcionFINAL) &&
            !empty($ruta_EstudiosFINAL) &&
            !empty($ruta_ExamenMFINAL) &&
            !empty($ruta_AntecedentesFINAL))
        ||
        // HONORARIO HOMBRE O MUJER ES MÉDICO Y NO PRESENTA INSCRIPCIÓN --probado
        (($generoP == "Masculino" || $generoP == "Femenino") &&
            $medicoOno == "Si" &&
            $inscripcionOno == FALSE &&
            !empty($ruta_CurriculumFINAL) &&
            !empty($ruta_CedulaFINAL) &&
            !empty($ruta_EstudiosFINAL) &&
            !empty($ruta_ExamenMFINAL) &&
            !empty($ruta_AntecedentesFINAL))
        ||
        // HONORARIO HOMBRE O MUJER QUE NO ES MÉDICO PERO PRESENTA INSCRIPCIÓN --probado
        (($generoP == "Masculino" || $generoP == "Femenino") &&
            $medicoOno == "No" &&
            $inscripcionOno == TRUE &&
            !empty($ruta_CurriculumFINAL) &&
            !empty($ruta_CedulaFINAL) &&
            !empty($ruta_InscripcionFINAL) &&
            !empty($ruta_EstudiosFINAL) &&
            !empty($ruta_AntecedentesFINAL))
        ||
        // HONORARIO HOMBRE O MUJER QUE NO ES MÉDICO NI PRESENTA INSCRIPCIÓN --probado
        (($generoP == "Masculino" || $generoP == "Femenino") &&
            $medicoOno == "No" &&
            $inscripcionOno == FALSE &&
            !empty($ruta_CurriculumFINAL) &&
            !empty($ruta_CedulaFINAL) &&
            !empty($ruta_EstudiosFINAL) &&
            !empty($ruta_AntecedentesFINAL))

    ) {
        $cumple = TRUE;
    } else {
        $cumple = FALSE;
    }



    $sqlTrabajador = "INSERT INTO honorario(IDTraH,IDCat,NombreH,PaternoH,MaternoH,Rut,Genero,Medico,Inscripcion,Profesion,CelularH,CorreoH,RutaCV,RutaAntec,RutaCedula,RutaEstudio,RutaExaM,RutaInscripcion,Observ,Cumple)
VALUES ($idtraH,$categoriaP,'$nombreP','$paternoP','$maternoP','$rutPersona','$generoP','$medicoOno','$inscripcionOno','$profesionP','$CelularP','$correoP','$ruta_CurriculumFINAL','$ruta_AntecedentesFINAL','$ruta_CedulaFINAL','$ruta_EstudiosFINAL','$ruta_ExamenMFINAL','$ruta_InscripcionFINAL','$obsP','$cumple')";


    try {
        $resultadoTrabajador = mysqli_query($conn, $sqlTrabajador);

        if (!$resultadoTrabajador) {
            throw new Exception(mysqli_error($conn));
        } else {

            echo $idtraH;

            echo "<script>
      Swal.fire({
        icon: 'success',
        title: 'Guardado Correctamente',
        showConfirmButton: false,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#009CFD'
      }).then(() => {
        window.location.href = 'registroDECRETOS.php?id=' + $idtraH;
      });
    </script>";
        }
    } catch (Exception $e) {
        // SE ELIMINARAN LOS ARCHIVOS ANTES DE ELIMINAR LA CARPETA; SI HUBO ERROR EN LA INSERCION
        if (file_exists($ruta . $idtraH)) {
            $files = glob($ruta . $idtraH . '/*'); //SE OBTIENEN TODOS LOS ARCHIVOS DENTRO DE LA CARPETA
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file); //SE ELIMINA CADA ARCHIVO
                }
            }
            rmdir($ruta . $idtraH); //SE ELIMINA LA CARPETA VACIA
        }
        echo "<script>
    Swal.fire({
      icon: 'error',
      title: 'Error al guardar los archivos: " . $e->getMessage() . "',
      showConfirmButton: true,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#009CFD'
    });
  </script>";
    }
}
mysqli_close($conn);
