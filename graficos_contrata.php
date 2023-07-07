<?php
include("./controller/config/conexion.php");
session_start();
if (!isset($_SESSION['rol'])) {
    header('Location: index.php');
    exit();
}
include("./controller/consulta_bar.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Inicio</title>
    <link rel="icon" type="image/png" href="./assets/img/favicon-32x32.png">
    <link href="./assets/styles/styles.css" rel="stylesheet" />
    <link href="./assets/styles/form.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="sb-nav-fixed">
    <?php require("./components/navbar.php"); ?>
    <div id="layoutSidenav">
        <?php require("./components/sidebar.php"); ?>
        <div id="layoutSidenav_content">
            <main>
                <br>
                <div class="container-md">
                    <div class="row">
                        <br>
                        <h1>Personal a contrata</h1>
                        <br>
                        <ol class="breadcrumb mb-4"></ol>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12 tarjeta">
                                <div class="card text-white mb-4" style="background-color:#463bfa;">
                                    <div style="display:flex; justify-content:space-around;font-size: 23px; align-items:center;">
                                        <div class="card-body">Personal Registrado</div>
                                        <div class="card-body" style="font-size:40px;display:flex;align-items:center;justify-content:right"><i class="fas fa-address-card"></i></div>
                                    </div>
                                    <div class="card-body numero"><?php echo $pinaresC; ?></div>
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
                            <div class="col-lg-4 col-md-6 grafico">
                                <div class=" card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Porcentaje de Cumplimiento Total
                                    </div>
                                    <div class="card-body"><canvas id="myChart" width="80%"></canvas></div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 grafico">
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
                labels: ['DAS', 'CESFAM Pinares', 'CESFAM La Leonera', 'CESFAM Valle La Piedra', 'CESFAM Chiguayante'],
                datasets: [{
                    data: [<?php echo $redondeadodas ?>,
                        <?php echo $redondeadopin ?>,
                        <?php echo $redondeadoleo ?>,
                        <?php echo $redondeadovalle ?>,
                        <?php echo $redondeadochi ?>
                    ],
                    backgroundColor: [
                        '#463bfa',
                        '#006FFF',
                        '#00B283',
                        '#9558DC',
                        '#CB3B9D'
                    ],
                    borderColor: [
                        '#463bfa',
                        '#006FFF',
                        '#00B283',
                        '#9558DC',
                        '#CB3B9D'
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
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';

                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y + '%';
                                }

                                return label;
                            }
                        }
                    },
                    legend: {
                        display: false
                    },
                    annotation: {
                        annotations: [{
                            type: 'text',
                            fontColor: 'black',
                            fontSize: 12,
                            fontStyle: 'bold',
                            x: function(context) {
                                return context.chart.width - context.parsed.x - 20;
                            },
                            y: function(context) {
                                return context.chart.height - context.parsed.y - 10;
                            },
                            text: function(context) {
                                return context.parsed.y + '%';
                            }
                        }]
                    }
                }
            }
        });
    </script>
    <script>
        const data2 = {
            labels: [
                'Al Día',
                'Pendiente'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [<?php echo $total_c ?>, <?php echo $total_nc ?>],
                backgroundColor: [
                    '#00c4a0',
                    '#f3ab00',
                ],
                hoverOffset: 4
            }]
        };
        const config2 = {
            type: 'pie',
            data: data2,
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 30,
                            font: {
                                size: 14,
                                fontStyle: "bold"
                            }
                        },
                        onClick: () => {}
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => {
                                const label = context.label || '';
                                const value = context.raw || '';
                                const percentage = ((context.parsed / context.dataset.data.reduce((a, b) => a + b)) * 100).toFixed(0);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        };
        const ctx2 = document.getElementById('myChart').getContext('2d');
        const myPieChart = new Chart(ctx2, config2);
    </script>
    <script>
        document.getElementById("searchFormContrata").addEventListener("submit", function(e) {
            e.preventDefault();

            var input = document.getElementById("nameBuscaRutContrata").value.trim();
            if (input.length < 9) {
                e.preventDefault();
                alert("El campo debe tener al menos 9 caracteres.");
            } else {
                $.ajax({
                        url: "./controller/buscar_contrata.php",
                        method: "POST",
                        data: {
                            nameBuscaRutContrata: input
                        }
                    })
                    .done(function(respuesta) {
                        //alert('LA RESPUESTA ES:'+respuesta)
                        console.log('200 LA RESPUESTA ES id:', respuesta)
                        window.location.href = "info_contrata.php?id=" + respuesta

                    })
                    .fail(function(error) {
                        //alert('400??LA RESPUESTA ES:'+respuesta)
                        console.error(error)
                        $('body').append(error.responseText);
                    })
                    .always(function(respuesta) {
                        console.info("LA RESPUESTA: ", respuesta)
                    });
            }
        });

        document.getElementById("nameBuscaRutContrata").addEventListener("input", function() {
            var input = this.value.trim();
            var btnBuscar = document.getElementById("btnNavbarSearchContrata");

            if (input.length >= 9) {
                btnBuscar.removeAttribute("disabled");
            } else {
                btnBuscar.setAttribute("disabled", "disabled");
            }
        });
    </script>
    <script>
        document.getElementById("searchFormHonorario").addEventListener("submit", function(e) {
            e.preventDefault();

            var input = document.getElementById("nameBuscaRutHonorario").value.trim();
            if (input.length < 9) {
                e.preventDefault();
                alert("El campo debe tener al menos 9 caracteres.");
            } else {
                $.ajax({
                        url: "./controller/buscar_honorario.php",
                        method: "POST",
                        data: {
                            nameBuscaRutHonorario: input
                        }
                    })
                    .done(function(respuesta) {
                        //alert('LA RESPUESTA ES:'+respuesta)
                        console.log('200 LA RESPUESTA ES id:', respuesta)
                        window.location.href = "info_honorario.php?idh=" + respuesta

                    })
                    .fail(function(error) {
                        //alert('400??LA RESPUESTA ES:'+respuesta)
                        console.error(error)
                        $('body').append(error.responseText);
                    })
                    .always(function(respuesta) {
                        console.info("LA RESPUESTA: ", respuesta)
                    });
            }
        });

        document.getElementById("nameBuscaRutHonorario").addEventListener("input", function() {
            var input = this.value.trim();
            var btnBuscar = document.getElementById("btnNavbarSearchHonorario");

            if (input.length >= 9) {
                btnBuscar.removeAttribute("disabled");
            } else {
                btnBuscar.setAttribute("disabled", "disabled");
            }
        });
    </script>
    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>