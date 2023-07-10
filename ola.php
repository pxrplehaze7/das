<?php
include("./controller/config/conexion.php");
session_start();
if (!isset($_SESSION['rol'])) {
    header('Location: index.php');
    exit();
}
if ($_SESSION['rol'] !== '1') {
    header('Location: ./components/error.html');
    exit();
}
if (isset($_GET['id'])) {
    $idtra = $_GET['id'];
    $datosEditar = "SELECT cat.NombreCat, afp.NombreAFP, pre.NombrePrev, afp.IDAFP, cat.IDCat, pre.IDPrev, 
    tra.IDTra, tra.NombreTra, tra.PaternoTra, tra.MaternoTra, tra.Inscripcion, tra.Rut, tra.Genero, tra.Profesion, tra.Medico, tra.CelularTra, tra.CorreoTra, tra.RutaPrev, tra.RutaCV, tra.RutaAFP, tra.RutaNac, tra.RutaAntec, tra.RutaCedula, tra.RutaEstudio, tra.RutaDJur,
     tra.RutaSerM, tra.RutaSCom, tra.RutaExaM, tra.Observ, tra.RutaInscripcion
    FROM trabajador tra
    INNER JOIN categoria cat ON (cat.IDCat = tra.IDCat)
    INNER JOIN afp afp ON (afp.IDAFP = tra.IDAFP)

    INNER JOIN prevision pre ON (pre.IDPrev = tra.IDPrev)
    WHERE IDTra='$idtra' LIMIT 1";
    $resultDatosEditar = mysqli_query($conn, $datosEditar);
    if (mysqli_num_rows($resultDatosEditar) == 1) {
        $editContrata = mysqli_fetch_assoc($resultDatosEditar);
    }
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Editar Trabajador</title>
    <link rel="icon" type="image/png" href="./assets/img/favicon-32x32.png">
    <link href="./assets/styles/styles.css" rel="stylesheet" />
    <link href="./assets/styles/form.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.16/jspdf.plugin.autotable.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php require("./components/navbar.php") ?>
    <div id="layoutSidenav">
        <?php require("./components/sidebar.php") ?>
        <div id="layoutSidenav_content">
            <main>
                <?php if (isset($editContrata)) { ?>
                    <div class="container-md tablap">
                        





                        <div id="editcal">
                            <?php
                            $sqlDec = "SELECT d.IDdecreto,d.IDCon, d.IDLugar, d.IDSector, d.NDecreto, d.FechaDoc, d.RutaCon, d.FechaInicio, d.FechaTermino, c.NombreCon, l.NombreLug, s.NombreSector, d.Estado
                            FROM decretos d
                            INNER JOIN contrato c ON (c.IDCon = d.IDCon)
                            INNER JOIN lugar l ON (l.IDLugar = d.IDLugar)
                            INNER JOIN sector s ON (s.IDSector = d.IDSector)
                             WHERE IDTra = $idtra";
                            $resultadoDecreto = mysqli_query($conn, $sqlDec);
                            ?>

                            <div class="documentacion seccion seccion-cal">
                                <h6>Decretos</h6>

                                    <table id="decretoscontrataedit" class="table table-striped table-bordered" style="width:100%">

                                        <thead>
                                            <tr>
                                                <th class="text-center">N° Doc.</th>
                                                <th class="text-center">Fecha Doc.</th>
                                                <th class="text-center">Tipo Contrato</th>
                                                <th class="text-center">Fecha Inicio</th>
                                                <th class="text-center">Fecha Termino</th>
                                                <th class="text-center">Lugar</th>
                                                <th class="text-center">Sector</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Editar</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($decreto = mysqli_fetch_array($resultadoDecreto)) { ?>
                                                <form method="POST" enctype="multipart/form-data" id="edicion_calif_<?php echo $decreto['IDdecreto'] ?>" class="edicionCalif">
                                                    <input name="idtracal" value="<?php echo $idtra ?>" class="form-control" id="idtracal" hidden>
                                                    <tr>

                                                        <td class="align-middle text-center">
                                                            <?php echo $decreto['NDecreto'] ?>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <?php echo date('d-m-Y', strtotime($decreto['FechaDoc'])); ?>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <?php echo $decreto['NombreCon'] ?>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <?php echo date('d-m-Y', strtotime($decreto['FechaInicio'])); ?>
                                                        </td>

                                                        <td class="align-middle text-center">
                                                            <?php
                                                              if ($decreto['IDCon'] == 3) {
                                                                echo ' ';
                                                            } else {
                                                                echo date('d-m-Y', strtotime($decreto['FechaTermino']));
                                                            }
                                                            ?>
                                                        </td>


                                                        <td class="align-middle text-center">
                                                            <?php echo $decreto['NombreLug'] ?>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <?php echo $decreto['NombreSector'] ?>
                                                        </td>

                                                        <td class="align-middle" style="text-align: center; font-weight: 700;">
                                                            <?php
                                                            if ($decreto['Estado'] == 1) {
                                                                echo '<span style="color: #00886f;">Vigente</span>';
                                                            } elseif ($decreto['Estado'] == 2) {
                                                                echo '<span style="color: #ff9900;">Por finalizar</span>';
                                                            } elseif ($decreto['Estado'] == 0) {
                                                                echo '<span style="color: #ff0000;">Finalizado</span>';
                                                            }
                                                            ?>

                                                        </td>


                                                 

                                                        <td class="align-middle" style="vertical-align: middle; text-align: center;">
                                                        <a class="a-ir" href="editar_decreto.php?idd=<?php echo $decreto['IDdecreto']; ?>" style="text-decoration: none;">
                                                            <span><i class="fa-sharp fa-solid fa-square-pen fa-lg" style="color: #eaaf00; font-size:32px; width:30px"></i></span>
                                                        </a>
                                                    </td>
                                                </form>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                
                                <br>
                            </div>
                        </div>




             
                        <div id="editcal">
                            <?php
                            $sqlCalificacion = "SELECT * FROM calificaciones WHERE IDTra = $idtra";
                            $resultadoCalif = mysqli_query($conn, $sqlCalificacion);
                            ?>

                            <div class="documentacion seccion seccion-cal">
                                <h6>Calificaciones</h6>
                                <div class="alert alert-info">
                                    <strong>¡Importante!</strong> Las calificaciones se guardan individualmente.
                                </div>
                                <div class="" style="overflow-x: auto;">
                                    <table id="calEDIT" class="table table-striped table-bordered table-centered table-responsive " style="width:100%">

                                        <thead>
                                            <tr>
                                                <th class="text-center">Desde</th>
                                                <th class="text-center">Hasta</th>

                                                <th class="text-center">Calificación</th>
                                                <th class="text-center">Subir o Cambiar Calificación</th>
                                                <th class="text-center" style="width: 65px !important;">Apelo</th>
                                                <th class="text-center">Apelación</th>
                                                <th class="text-center">Subir o Cambiar Apelación</th>
                                                <th class="text-center">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    $sqlCalificacion = "SELECT * 
                            FROM calificaciones cal
                            INNER JOIN trabajador tra ON (tra.IDTra = cal.IDTra)
                            WHERE $idtra = cal.IDTra ";

                                    $resultadoCalif = mysqli_query($conn, $sqlCalificacion);

                                    while ($mostrar = mysqli_fetch_array($resultadoCalif)) {
                                    ?>
                                        <tr>
                                            <td class='align-middle text-center'><?php echo $mostrar['MesInicio'] . ' ' . $mostrar['AnnoInicio'] ?></td>

                                            <td class='align-middle text-center'><?php echo $mostrar['MesFin'] . ' ' . $mostrar['AnnoFin'] ?></td>

                                            <td class='centrado'>
                                                <?php if (!empty($mostrar['RutaCalificacion'])) { ?>
                                                    <center>
                                                        <div class="contenedor-botones">
                                                            <button class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $mostrar['RutaCalificacion'] ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $mostrar['RutaCalificacion'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                        </div>
                                                    </center>
                                                <?php } elseif (empty($mostrar['RutaCalificacion'])) { ?>
                                                    <div class="contenedor-botones">
                                                        <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                    </div>
                                                <?php } ?>
                                            </td>




                                            <td class='align-middle text-center'><?php echo $mostrar['apelo'] ?></td>
                                            <td class='centrado'>
                                                <?php if (!empty($mostrar['RutaApelacion']) && $mostrar['apelo'] == "Si") { ?>
                                                    <center>
                                                        <div class="contenedor-botones">
                                                            <button class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $mostrar['RutaApelacion'] ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $mostrar['RutaApelacion'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                        </div>
                                                    </center>
                                                <?php } elseif (empty($mostrar['RutaApelacion']) && $mostrar['apelo'] == "Si") { ?>
                                                    <div class="contenedor-botones">
                                                        <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                    </table>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </main>
        </div>
    </div>
    <script>
        function validarFechaCalif(input) {
            // Remueve todos los caracteres que no sean números ni guiones
            input.value = input.value.replace(/[^0-9-]/g, '');

            // Verifica si hay más de un guion y lo remueve
            if (input.value.indexOf('-') !== input.value.lastIndexOf('-')) {
                input.value = input.value.replace(/-/g, '');
            }
        }
    </script>
    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/elimina.js"></script>
    <script src="./assets/js/doc_exclusivos.js"></script>
    <script src="./assets/js/validaciones_input.js"></script>
    <script src="./assets/js/tablas.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
</body>

</html>