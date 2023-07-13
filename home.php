<?php
include("./controller/config/conexion.php");
session_start();
if (!isset($_SESSION['rol'])) {
    header('Location: index.php');
    exit();
}
include("./controller/consulta_estado_contrata.php");
include("./controller/consulta_estado_honorario.php");

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
                <div class="title">
                    <h1 class="mt-4">Información General</h1>
                </div>
                <br>
                <div class="container-md d-flex justify-content-center" style="width: 90%;">

                    <br>

                    <div class="row d-flex d-flex justify-content-center">



                        <br>
                        <ol class="breadcrumb mb-4"></ol>
                        <div class="row d-flex justify-content-center" style="padding-left: 0 !important;padding-right: 0 !important;">

                            <div class="col-lg-4 col-md-6 col-sm-12 tarjeta">
                                <div class="card text-white mb-4" style="background-color:#463bfa;">
                                    <div style="display:flex; justify-content:space-around;font-size: 20px; align-items:center;">
                                        <div class="info-icon" style="padding-left: 10px;">
                                            <span class="tooltip">Cantidad total de trabajadores registrados</span>
                                            <i class="fas fa-info-circle"></i>
                                        </div>

                                        <div class="card-body">Personal Registrado</div>
                                        <div class="card-body" style="font-size:30px;display:flex;align-items:center;justify-content:right"><i class="fas fa-address-card"></i></div>

                                    </div>

                                    <div class="card-body" style="font-size: 18px;width:100%">
                                        <table style="font-size: 18px;width:100%">
                                            <tbody>
                                                <tr>
                                                    <td>A Contrata e Indefinidos: </td>
                                                    <td style="text-align: end;"><?php echo $total_t ?></td>
                                                </tr>
                                                <tr>
                                                    <td>A Honorarios: </td>
                                                    <td style="text-align: end;"><?php echo $total_h ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 tarjeta">
                                <div class="card text-white mb-4" style="background-color:#00c4a0;">
                                    <div style="display:flex; justify-content:space-around;font-size: 20px; align-items:center;">
                                        <div class="info-icon" style="padding-left: 10px;">
                                            <span class="tooltip" style="bottom: -240px !important;width: 285px;">
                                                Documentacion básica corresponde a:
                                                <br>Certificado de Nacimiento.
                                                <br>Certificado de Antecedentes.
                                                <br>Fotocopia de Cédula de identidad.
                                                <br>Declaración Jurada.
                                                <br>Certificado de S.M al día.
                                                <br>EUNACOM.
                                                <br>Certificado de Inscripción.
                                                <br>Certificado de Salud Compatible.
                                                <br>Certificado de afiliación AFP.
                                                <br>Certificado de afiliación Previsión.
                                                <br>Currículum Vitae.
                                                <br>Certificado de Estudios o Título Profesional.

                                            </span>
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <div class="card-body">Documentación al Día</div>
                                        <div class="card-body" style="font-size:30px;display:flex;align-items:center;justify-content:right"><i class="fas fa-check-circle"></i></div>
                                    </div>

                                    <div class="card-body" style="font-size: 18px;width:100%">
                                        <table style="font-size: 18px;width:100%">
                                            <tbody>
                                                <tr>
                                                    <td>A Contrata e Indefinidos: </td>
                                                    <td style="text-align: end;"><?php echo $total_ct ?></td>
                                                </tr>
                                                <tr>
                                                    <td>A Honorarios: </td>
                                                    <td style="text-align: end;"><?php echo $total_ch ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 tarjeta">
                                <div class="card text-white mb-4" style="background-color:#f3ab00;">
                                    <div style="display:flex; justify-content:space-around;font-size: 20px; align-items:center;">
                                        <div class="info-icon" style="padding-left: 10px;">
                                            <span class="tooltip" style="bottom: -240px !important;width: 285px;">
                                                Documentacion básica corresponde a:
                                                <br>Certificado de Nacimiento.
                                                <br>Certificado de Antecedentes.
                                                <br>Fotocopia de Cédula de identidad.
                                                <br>Declaración Jurada.
                                                <br>Certificado de S.M al día.
                                                <br>EUNACOM.
                                                <br>Certificado de Inscripción.
                                                <br>Certificado de Salud Compatible.
                                                <br>Certificado de afiliación AFP.
                                                <br>Certificado de afiliación Previsión.
                                                <br>Currículum Vitae.
                                                <br>Certificado de Estudios o Título Profesional.

                                            </span>
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <div class="card-body">Documentación Pendiente</div>
                                        <div class="card-body" style="font-size:30px;display:flex;align-items:center;justify-content:right; width:auto"><i class="fas fa-clock"></i></div>
                                    </div>
                                    <div class="card-body" style="font-size: 18px;width:100%">
                                        <table style="font-size: 18px;width:100%">
                                            <tbody>
                                                <tr>
                                                    <td>A Contrata e Indefinidos: </td>
                                                    <td style="text-align: end;"><?php echo $total_nct ?></td>
                                                </tr>
                                                <tr>
                                                    <td>A Honorarios: </td>
                                                    <td style="text-align: end;"><?php echo $total_nch ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="graficos_pie">
                            <div class="title">
                                <h6 class="mt-4">Porcentaje de cumplimiento de documentación básica: A contrata e Indefinidos.</h6>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                                    <div class=" card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-area me-1"></i>
                                            Cumplimiento Total
                                        </div>
                                        <div class="card-body" style="display: flex;justify-content: center;height: 350px;"><canvas id="myChart"></canvas></div>
                                    </div>
                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-bar me-1"></i>
                                            Cumplimiento según lugar
                                        </div>
                                        <div class="card-body" style="min-height: 350px;"><canvas id="myChartBar"></canvas></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="graficos_barra">
                            <div class="title">
                                <h6 class="mt-4">Porcentaje de cumplimiento de documentación básica: Honorarios.</h6>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                                    <div class=" card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-area me-1"></i>
                                            Cumplimiento Total
                                        </div>
                                        <div class="card-body" style="display: flex;justify-content: center;height: 350px;"><canvas id="myChartHonorario"></canvas></div>
                                    </div>
                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-bar me-1"></i>
                                            Cumplimiento según lugar
                                        </div>
                                        <div class="card-body" style="min-height: 350px;"><canvas id="myChartBarHonorario"></canvas></div>
                                    </div>
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
                responsive: true,
                maintainAspectRatio: false,
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
        var ctx1 = document.getElementById("myChartBarHonorario").getContext('2d');
        var myChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['DAS', 'CESFAM Pinares', 'CESFAM La Leonera', 'CESFAM Valle La Piedra', 'CESFAM Chiguayante'],
                datasets: [{
                    data: [<?php echo $redondeadodash ?>,
                        <?php echo $redondeadopinh ?>,
                        <?php echo $redondeadoleoh ?>,
                        <?php echo $redondeadovalleh ?>,
                        <?php echo $redondeadochih ?>
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
                responsive: true,
                maintainAspectRatio: false,
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
        const data3 = {
            labels: [
                'Al Día',
                'Pendiente'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [<?php echo $total_ch ?>, <?php echo $total_nch ?>],
                backgroundColor: [
                    '#00c4a0',
                    '#f3ab00',
                ],
                hoverOffset: 4
            }]
        };
        const config3 = {
            type: 'pie',
            data: data3,
            options: {
                responsive: true,
                maintainAspectRatio: false,
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
        const ctx3 = document.getElementById('myChartHonorario').getContext('2d');
        const myPieChart2 = new Chart(ctx3, config3);
    </script>


    <script>
        const data2 = {
            labels: [
                'Al Día',
                'Pendiente'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [<?php echo $total_ct ?>, <?php echo $total_nct ?>],
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
                responsive: true,
                maintainAspectRatio: false,
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

    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>