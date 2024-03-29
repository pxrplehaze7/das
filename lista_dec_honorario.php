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
    <title>Lista Decretos a Honorario</title>
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
    <?php require("./components/navbar.php"); ?>
    <div id="layoutSidenav">
        <?php require("./components/sidebar.php"); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-md tablap">
                    <div class="title">
                        <h1 class="mt-4">Lista de Decretos de Honorario</h1>
                    </div>
                    <br>
                    <div class="">
                        <div class="card mb-4"> <!-- POR FINALIZAR -->
                            <div class="card-body">
                                <div class="porFinalizar">
                                    <div class="title">
                                        <div class="ti">
                                            <h6 class="mt-4">Decretos Por Finalizar</h6>
                                        </div>
                                    </div>
                                    <div class="alert alert-warning" role="alert">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <strong>¡Importante!</strong> Una vez confirmado, no se mostrará nuevamente la advertencia
                                    </div>

                                    <table id="pterminarH" class="table table-striped table-bordered" style="width:100%" data-search="true">
                                        <thead>
                                            <tr class="pterminar">
                                                <th style="min-width: 70px;">RUT</th>
                                                <th>N° Doc.</th>
                                                <th>Fecha Documento</th>
                                                <th>Tipo</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Termino</th>
                                                <th>Lugar</th>
                                                <th>Sector</th>
                                                <th>Estado</th>
                                                <th>Confirmar</th>
                                                <th>Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody id="trabajadores_tbody">
                                            <?php
                                            $sqlPorFin = "SELECT dh.IDdecretoH, dh.IDTraH, h.Rut, dh.NDecreto, dh.FechaDoc, dh.RutaCon, dh.FechaInicio, dh.FechaTermino, dh.Estado, dh.Confirmacion, l.NombreLug, s.NombreSector, dh.TipodeHono
                                            FROM decretosh dh
                                        INNER JOIN lugar l ON (l.IDLugar = dh.IDLugar)
                                        INNER JOIN sector s ON (s.IDSector = dh.IDSector)
                                        INNER JOIN honorario h ON (h.IDTraH = dh.IDTraH)
                                        WHERE Estado =2 AND Confirmacion=0";
                                            $rporFin = mysqli_query($conn, $sqlPorFin);
                                            while ($rowpFin = mysqli_fetch_array($rporFin)) { ?>
                                                <tr>
                                                    <td class="align-middle"><?php echo $rowpFin['Rut'] ?></td>
                                                    <td class="align-middle"><?php echo $rowpFin['NDecreto'] ?></td>
                                                    <td class="align-middle"><?php echo date('d-m-Y', strtotime($rowpFin['FechaDoc'])) ?></td>
                                                    <td class="align-middle"><?php echo  $rowpFin['TipodeHono'] ?></td>
                                                    <td class="align-middle"><?php echo date('d-m-Y', strtotime($rowpFin['FechaInicio'])) ?></td>
                                                    <td class="align-middle"> <?php echo date('d-m-Y', strtotime($rowpFin['FechaTermino'])); ?> </td>
                                                    <td class="align-middle"><?php echo  $rowpFin['NombreLug'] ?></td>
                                                    <td class="align-middle"><?php echo  $rowpFin['NombreSector'] ?></td>
                                                    <td class="align-middle" style="text-align: center; font-weight: 700;">
                                                        <span style="color: #E76500;">Por Finalizar</span>
                                                    </td>
                                                  
                                                    <td style="vertical-align: middle; text-align: center;">
                                                        <button class="btn btn-confirma btn-confirm" data-iddecreto="<?php echo $rowpFin['IDdecretoH'] ?>">
                                                            <i class="fa-solid fa-square-check" style="color: #e76550; font-size: 32px;"></i>
                                                        </button>
                                                    </td>

                                                    <td style="vertical-align: middle; text-align: center;">
                                                        <a class="a-ir" href="editar_decreto_h.php?iddh=<?php echo $rowpFin['IDdecretoH']; ?>" style="text-decoration: none;">
                                                            <span><i class="fa-sharp fa-solid fa-square-pen fa-lg" style="color: #eaaf00; font-size:32px; width:30px"></i></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="card mb-4"> <!-- FINALIZADOS -->
                            <div class="card-body">
                                <div class="porFinalizar">
                                    <div class="title">
                                        <div class="ti">
                                            <h6 class="mt-4">Decretos Finalizados</h6>
                                        </div>
                                    </div>

                                    <table id="expiradosH" class="table table-striped table-bordered" style="width:100%" data-search="true">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 70px;">RUT</th>
                                                <th>N° Doc.</th>
                                                <th>Fecha Documento</th>
                                                <th>Tipo</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Termino</th>
                                                <th>Lugar</th>
                                                <th>Sector</th>
                                                <th>Estado</th>
                                                <th>Editar</th>

                                            </tr>
                                        </thead>
                                        <tbody id="trabajadores_tbody">
                                            <?php
                                            $sqlFin = "SELECT dh.IDdecretoH, dh.IDTraH, h.Rut, dh.NDecreto, dh.FechaDoc, dh.RutaCon, dh.FechaInicio, dh.FechaTermino, dh.Estado, dh.Confirmacion, l.NombreLug, s.NombreSector, dh.TipodeHono
                                            FROM decretosh dh
                                        INNER JOIN lugar l ON (l.IDLugar = dh.IDLugar)
                                        INNER JOIN sector s ON (s.IDSector = dh.IDSector)
                                        INNER JOIN honorario h ON (h.IDTraH = dh.IDTraH)
                                        WHERE Estado =0";
                                            $rFin = mysqli_query($conn, $sqlFin);
                                            while ($rowFin = mysqli_fetch_array($rFin)) { ?>
                                                <tr>
                                                    <td class="align-middle"><?php echo $rowFin['Rut'] ?></td>
                                                    <td class="align-middle"><?php echo $rowFin['NDecreto'] ?></td>
                                                    <td class="align-middle"><?php echo date('d-m-Y', strtotime($rowFin['FechaDoc'])) ?></td>
                                                    <td class="align-middle"><?php echo  $rowFin['TipodeHono'] ?></td>
                                                    <td class="align-middle"><?php echo date('d-m-Y', strtotime($rowFin['FechaInicio'])) ?></td>
                                                    <td class="align-middle"> <?php echo date('d-m-Y', strtotime($rowFin['FechaTermino'])); ?> </td>
                                                    <td class="align-middle"><?php echo  $rowFin['NombreLug'] ?></td>
                                                    <td class="align-middle"><?php echo  $rowFin['NombreSector'] ?></td>

                                                    <td class="align-middle" style="text-align: center; font-weight: 700;">
                                                        <span style="color: #e91818;">Finalizado</span>
                                                    </td>
                                                    <td style="vertical-align: middle; text-align: center;">
                                                        <a class="a-ir" href="editar_decreto_h.php?iddh=<?php echo $rowFin['IDdecretoH']; ?>" style="text-decoration: none;">
                                                            <span><i class="fa-sharp fa-solid fa-square-pen fa-lg" style="color: #eaaf00; font-size:32px; width:30px"></i></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card mb-4"> <!-- VIGENTES -->
                            <div class="card-body">
                                <div class="vigentes">
                                    <div class="title">
                                        <div class="ti">
                                            <h6 class="mt-4">Decretos Vigentes</h6>
                                        </div>
                                    </div>
                                    <table id="vigentesH" class="table table-striped table-bordered" style="width:100%" data-search="true">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 70px;">RUT</th>
                                                <th>N° Doc.</th>
                                                <th>Fecha Documento</th>
                                                <th>Tipo</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Termino</th>
                                                <th>Lugar</th>
                                                <th>Sector</th>
                                                <th>Estado</th>
                                                <th>Editar</th>

                                            </tr>
                                        </thead>
                                        <tbody id="trabajadores_tbody">
                                            <?php
                                            $sqlvig = "SELECT dh.IDdecretoH, dh.IDTraH, h.Rut, dh.NDecreto, dh.FechaDoc, dh.RutaCon, dh.FechaInicio, dh.FechaTermino, dh.Estado, dh.Confirmacion, l.NombreLug, s.NombreSector, dh.TipodeHono
                                        FROM decretosh dh
                                        INNER JOIN lugar l ON (l.IDLugar = dh.IDLugar)
                                        INNER JOIN sector s ON (s.IDSector = dh.IDSector)
                                        INNER JOIN honorario h ON (h.IDTraH = dh.IDTraH)
                                        WHERE Estado = 1";

                                            $resvig = mysqli_query($conn, $sqlvig);
                                            while ($rowvig = mysqli_fetch_array($resvig)) { ?>
                                                <tr>
                                                    <td class="align-middle"><?php echo $rowvig['Rut'] ?></td>
                                                    <td class="align-middle"><?php echo $rowvig['NDecreto'] ?></td>
                                                    <td class="align-middle"><?php echo date('d-m-Y', strtotime($rowvig['FechaDoc'])) ?></td>
                                                    <td class="align-middle"><?php echo  $rowvig['TipodeHono'] ?></td>
                                                    <td class="align-middle"><?php echo date('d-m-Y', strtotime($rowvig['FechaInicio'])) ?></td>
                                                    <td class="align-middle"> <?php echo date('d-m-Y', strtotime($rowvig['FechaTermino'])); ?> </td>
                                                    <td class="align-middle"><?php echo  $rowvig['NombreLug'] ?></td>
                                                    <td class="align-middle"><?php echo  $rowvig['NombreSector'] ?></td>
                                                    <td class="align-middle" style="text-align: center; font-weight: 700;">
                                                        <span style="color: #119f00;">Vigente</span>
                                                    </td>
                                                    <td style="vertical-align: middle; text-align: center;">
                                                        <a class="a-ir" href="editar_decreto_h.php?iddh=<?php echo $rowvig['IDdecretoH']; ?>" style="text-decoration: none;">
                                                            <span><i class="fa-sharp fa-solid fa-square-pen fa-lg" style="color: #eaaf00; font-size:32px; width:30px"></i></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/tablaExport.js"></script>
    <script src="./assets/js/elimina.js"></script>

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