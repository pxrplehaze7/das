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

if (isset($_GET['rut'])) {
    $rut = $_GET['rut'];

    $queryTrabajador = "SELECT IDTra, Rut, NombreTra, PaternoTra, MaternoTra FROM trabajador WHERE Rut = '$rut'";
    $resultTrabajador = mysqli_query($conn, $queryTrabajador);

    $queryHonorario = "SELECT IDTraH, Rut, NombreH, PaternoH, MaternoH FROM honorario WHERE Rut = '$rut'";
    $resultHonorario = mysqli_query($conn, $queryHonorario);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <title>Resultados</title>
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
    <style>
        .table-centered td {
            vertical-align: middle;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <?php require("./components/navbar.php"); ?>
    <div id="layoutSidenav">
        <?php require("./components/sidebar.php"); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-md">
                    <div class="title">
                        <h1 class="mt-4">Resultados de búsqueda</h1>
                    </div>
                    <br>
                    <div class="">
                        <div class="card mb-4">
                            <div class="card-body">
                                <?php if ((isset($resultTrabajador) && mysqli_num_rows($resultTrabajador) > 0) || (isset($resultHonorario) && mysqli_num_rows($resultHonorario) > 0)) : ?>
                                    <?php if (isset($resultTrabajador) && mysqli_num_rows($resultTrabajador) > 0) : ?>
                                        
                                        <h2 style="font-size: 25px;">A contrata o Indefinido</h2>
                                        <table id="trabajadorTable" class="table table-striped table-bordered table-centered" style="width:100%" data-search="true">
                                            <thead>
                                                <tr>
                                                    <th>RUT</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido Paterno</th>
                                                    <th>Apellido Materno</th>
                                                    <th>Ir</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($resultTrabajador)) : ?>
                                                    <tr>
                                                        <td><?php echo $row['Rut']; ?></td>
                                                        <td><?php echo $row['NombreTra']; ?></td>
                                                        <td><?php echo $row['PaternoTra']; ?></td>
                                                        <td><?php echo $row['MaternoTra']; ?></td>
                                                        <td class="contenedor-ir" style="vertical-align: middle; text-align: center;">
                                                            <a class="a-ir" href="info_contrata.php?id=<?php echo $row['IDTra']; ?> " style="text-decoration: none;">
                                                                <span>Ir <i class="fa-solid fa-circle-arrow-right"></i></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>

                                    <?php if (isset($resultHonorario) && mysqli_num_rows($resultHonorario) > 0) : ?>
                                        <h2 style="font-size: 25px;">Honorario</h2>
                                        <table id="honorarioTable" class="table table-striped table-bordered table-centered" style="width:100%" data-search="true">
                                            <thead>
                                                <tr>
                                                    <th>RUT</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido Paterno</th>
                                                    <th>Apellido Materno</th>
                                                    <th>Ir</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($resultHonorario)) : ?>
                                                    <tr>
                                                        <td><?php echo $row['Rut']; ?></td>
                                                        <td><?php echo $row['NombreH']; ?></td>
                                                        <td><?php echo $row['PaternoH']; ?></td>
                                                        <td><?php echo $row['MaternoH']; ?></td>
                                                        <td style="vertical-align: middle; text-align: center;">
                                                            <a class="a-ir" href="info_honorario.php?idh=<?php echo $row['IDTraH']; ?>" style="text-decoration: none;">
                                                                <span>Ir <i class="fa-solid fa-circle-arrow-right"></i></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <h2 style="font-size: 25px;">Sin resultados</h2>

                                    <p>RUT no registrado.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/elimina.js"></script>
    <script src="./assets/js/tablas.js"></script>
    <script src="./assets/js/tablaExport.js"></script>
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