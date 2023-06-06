<?php
include("./controller/config/conexion.php");

$cumplen = "SELECT COUNT(*) FROM `trabajador` WHERE Cumple = TRUE;";
$sqlCumplen = mysqli_query($conn, $cumplen);
$row = mysqli_fetch_row($sqlCumplen);
$total_c = $row[0];

$NOcumplen = "SELECT COUNT(*) FROM `trabajador` WHERE Cumple = FALSE;";
$sqlNOCumplen = mysqli_query($conn, $NOcumplen);
$row = mysqli_fetch_row($sqlNOCumplen);
$total_nc = $row[0];

$totalTRA = "SELECT COUNT(*) FROM `trabajador`;";
$sqlT = mysqli_query($conn, $totalTRA);
$row = mysqli_fetch_row($sqlT);
$total_t = $row[0];





?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Inicio</title>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <!-- <link href="cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet" />

    <!-- ICONOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.16/jspdf.plugin.autotable.min.js"></script>

</head>

<body class="sb-nav-fixed">
    <?php require("./components/navbar.php"); ?>
    <div id="layoutSidenav">

        <?php require("./components/sidebar.html"); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-md">
                    <h1 class="mt-4">Registros</h1>
                    <ol class="breadcrumb mb-4"></ol>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12 tarjeta">
                            <div class="card text-white mb-4" style="background-color:#463bfa;">
                                <div style="display:flex; justify-content:space-around;font-size: 23px; align-items:center;">
                                    <div class="card-body">Personal Registrado</div>
                                    <div class="card-body" style="font-size:40px;display:flex;align-items:center;justify-content:right"><i class="fas fa-address-card"></i></div>
                                </div>
                                <div class="card-body numero"><?php echo $total_t; ?></div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 col-12 tarjeta">
                            <div class="card text-white mb-4" style="background-color:#00c4a0;">
                                <div style="display:flex; justify-content:space-around;font-size: 23px; align-items:center;">
                                    <div class="card-body">Documentación al Día</div>
                                    <div class="card-body" style="font-size:40px;display:flex;align-items:center;justify-content:right"><i class="fas fa-check-circle"></i></div>
                                </div>
                                <div class="card-body numero"><?php echo $total_c; ?></div>
                            </div>

                        </div>


                        <div class="col-lg-4 col-md-6 col-sm-12 col-12 tarjeta">
                            <div class="card text-white mb-4" style="background-color:#f3ab00">
                                <div style="display:flex; justify-content:space-around;font-size: 23px; align-items:center;">
                                    <div class="card-body">Documentación Pendiente</div>
                                    <div class="card-body" style="font-size:40px;display:flex;align-items:center;justify-content:right"><i class="fas fa-clock"></i></div>
                                </div>
                                <div class="card-body numero" style="max-height: 150px; overflow-y: auto;"><?php echo $total_nc; ?></div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <!-- <div class="col-xl-5">
                            <div class=" card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Area Chart Example
                                </div>
                                <div class="card-body"><canvas id="myChart" width="100%"></canvas></div>
                            </div>
                        </div> -->
                        <div class="col-xl-7">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart Example
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%"></canvas></div>
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
    <script src="./assets/js/chart_pieTotal.js"></script>
    <script src="./assets/js/chart_bar.js"></script>


</body>

</html>