<?php
include("./controller/config/conexion.php");
include("./controller/consulta_bar.php");
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

    <!-- Charts.js -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet" />

    <!-- ICONOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="sb-nav-fixed">
    <?php require("./components/navbar.php"); ?>
    <div id="layoutSidenav">

        <?php require("./components/sidebar.html"); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-md">
                    <h1 class="mt-4">Registros
                    </h1>
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
                        <div class="col-xl-5">
                            <div class=" card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Porcentaje de Cumplimiento Total
                                </div>
                                <div class="card-body"><canvas id="myChart" width="80%"></canvas></div>
                            </div>


                        </div>
                        <div class="col-xl-7">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Porcentaje de Cumplimiento según Lugar
                                </div>
                                <div class="card-body"><canvas id="myChartBar" width="80%"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>
    <script>
        var ctx1 = document.getElementById("myChartBar").getContext('2d');
        var myChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Das', 'CESFAM Pinares', 'CESFAM La Leonera', 'Valle La Piedra', 'CESFAM Chiguayante'],
                datasets: [{
            data: [<?php echo $redondeadodas ?>,
                <?php echo $redondeadopin ?>,
                <?php echo $redondeadoleo ?>,
                <?php echo $redondeadovalle ?>,
                <?php echo $redondeadochi ?>
            ],
                    backgroundColor: [
                        '#1abc9c',
                        '#e67e22',
                        'rgba(255, 206, 86, 02)',
                        'rgba(75, 192, 192, 02)',
                        'rgba(153, 102, 255, 2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 100,
                ticks: {
                    callback: function (value) {
                        return value + '%';
                    }
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    afterLabel: function (tooltipItem) {
                        return ' %';
                    }
                }
            },
            legend: {
                display: false
            }
        }
    }
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/chart_pieTotal.js"></script>
    <script src="./assets/js/chart_bar.js"></script>


</body>

</html>