<?php
include("./controller/config/conexion.php"); 
session_start();
if (!isset($_SESSION['rol'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Lista de Registros</title>
    <!-- ESTILOS -->
    <link href="./assets/styles/styles.css" rel="stylesheet" />
    <link href="./assets/styles/form.css" rel="stylesheet" />
    <!-- CDN jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- CDN CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <!-- Datatable -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <!-- ICONOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.16/jspdf.plugin.autotable.min.js"></script>


</head>

<body class="sb-nav-fixed">
    <?php require("./components/navbar.php"); ?>
    <div id="layoutSidenav">
        <?php require("./components/sidebar.php"); ?>
        <div id="layoutSidenav_content">
        <main>
    <div class="container-md">
        <div class="title">
            <h1 class="mt-4">Registros anteriores</h1>
        </div>
        <br>
        <div class="">
            <div class="card mb-4">
                <div class="card-body">
                    <?php
                    function listarArchivos($ruta)
                    {
                        $archivos = scandir($ruta);
                        $archivos = array_diff($archivos, array('.', '..')); // Eliminar las entradas "." y ".."
                        sort($archivos); // Ordenar los archivos alfabéticamente
                    ?>
                        <table id="anteriores" class="table table-striped table-bordered" style="width:100%" data-search="true">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Fecha de carga</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($archivos as $archivo) {
                                    $rutaCompleta = $ruta . '/' . $archivo;
                                    if (is_file($rutaCompleta)) { // Verificar si es un archivo
                                        $extension = pathinfo($rutaCompleta, PATHINFO_EXTENSION);
                                        if (strtolower($extension) == 'pdf') {
                                            $rutaArchivo = str_replace($_SERVER['DOCUMENT_ROOT'], '', $rutaCompleta);
                                            $descripcion = obtenerDescripcionArchivo($archivo); // Obtener la descripción del archivo
                                            $fechaCarga = obtenerFechaCarga($archivo); // Obtener la fecha de carga del archivo
                                ?>
                                            <tr>
                                                <td><?php echo $descripcion ?></td>
                                                <td><?php echo $fechaCarga ?></td>
                                                <td>
                                                    <div class="contenedor-botones">
                                                        <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $rutaArchivo; ?>', '_blank')">
                                                            <i class="fa-solid fa-expand"></i>
                                                        </button>
                                                        <a href="<?php echo $rutaArchivo; ?>" download class="btn btn-primary boton-descargar w-100">
                                                            <i class="fa-sharp fa-solid fa-download"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php
                    }

                    function obtenerDescripcionArchivo($nombreArchivo)
                    {
                        $descripcion = '';

                        // Verificar el nombre del archivo y asignar una descripción personalizada
                        if (strpos($nombreArchivo, 'ANTECEDENTES') === 0) {
                            $descripcion = 'Certificado de Antecedentes';
                        } elseif (strpos($nombreArchivo, 'CEDULA') === 0) {
                            $descripcion = 'Fotocopia de Cédula de Identidad';
                        } elseif (strpos($nombreArchivo, 'CONTRATO') === 0) {
                            $descripcion = 'Contrato';
                        } elseif (strpos($nombreArchivo, 'CURRICULUM') === 0) {
                            $descripcion = 'Currículum Vitae';
                        } elseif (strpos($nombreArchivo, 'ESTUDIOS') === 0) {
                            $descripcion = 'Certificado de Estudios o Título Profesional';
                        } elseif (strpos($nombreArchivo, 'AFP') === 0) {
                            $descripcion = 'Certificado de Afiliacion AFP';
                        } elseif (strpos($nombreArchivo, 'CNACIMIENTO') === 0) {
                            $descripcion = 'Certificado de Nacimiento';
                        } elseif (strpos($nombreArchivo, 'DJURADA') === 0) {
                            $descripcion = 'Declaración Jurada';
                        } elseif (strpos($nombreArchivo, 'EUNACOM') === 0) {
                            $descripcion = 'Examen Único Nacional de Conocimientos de Medicina';
                        } elseif (strpos($nombreArchivo, 'INSCRIPCION') === 0) {
                            $descripcion = 'Certificado de inscripción en el Registro Nacional de Prestadores Individuales';
                        } elseif (strpos($nombreArchivo, 'PREVISION') === 0) {
                            $descripcion = 'Certificado de Afiliación Previsional';
                        } elseif (strpos($nombreArchivo, 'SCOMPATIBLE') === 0) {
                            $descripcion = 'Certificado de Salud Compatible';
                        } elseif (strpos($nombreArchivo, 'SMILITAR') === 0) {
                            $descripcion = 'Certificado de Servicio Militar al Día';
                        }

                        return $descripcion;
                    }

                    function obtenerFechaCarga($nombreArchivo)
                    {
                        $patron = '/\d{2}_\d{2}_\d{4}/'; // Expresión regular para buscar la fecha en el nombre del archivo
                        preg_match($patron, $nombreArchivo, $coincidencias);
                        $fechaCarga = '';

                        if (count($coincidencias) > 0) {
                            $fechaCarga = str_replace('_', '/', $coincidencias[0]);
                        }

                        return $fechaCarga;
                    }

                    $id = $_GET['idantes']; // Obtener el rut ingresado por el usuario

                    $folder = "das/controller/pdfs_personal"; // Ruta de la carpeta principal relativa al directorio raíz del servidor web
                    $targetFolder = $_SERVER['DOCUMENT_ROOT'] . "/" . $folder . "/" . $id; // Ruta completa de la carpeta específica del rut

                    if (is_dir($targetFolder)) { // Verificar si la carpeta existe
                        listarArchivos($targetFolder);
                    } else {
                        echo "La carpeta para el rut $id no existe.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>


    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.js"></script>
    <script src="./assets/js/tablas.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
</body>

</html>