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
    <title>Personas Registradas</title>
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
                        <h1 class="mt-4">Lista de Trabajadores Registrados</h1>
                    </div>
                    <br>
                    <div class="">
                        <div class="card mb-4">
                            <div class="card-body">
                                
                                <table id="total_contrata" class="table table-striped table-bordered" style="width:100%" data-search="true">
                                    <thead>
                                        <tr>
                                            <th class="align-middle" style="width: 75px;">Rut</th>

                                            <th class="align-middle">Nombres</th>
                                            <th class="align-middle">Apellidos</th>
                                            <th class="align-middle">Profesión</th>
                                            <th class="align-middle">Celular</th>
                                            <th class="align-middle">Correo Electrónico</th>
                                            <th class="align-middle" style="width: 90px;">Documentacion Básica</th>

                                            <th class="align-middle">Ver</th>
                                        </tr>
                                    </thead>
                                    <tbody id="trabajadores_tbody">
                                        <?php
                                        $sqlTodos = "SELECT Rut, IDTra, NombreTra, PaternoTra, MaternoTra, Profesion, 
                                        CelularTra, CorreoTra, Cumple
                                        FROM trabajador";

                                        $resultadoTotal = mysqli_query($conn, $sqlTodos);
                                        while ($ptotal = mysqli_fetch_array($resultadoTotal)) { ?>
                                            <tr>
                                                <td class="align-middle"><?php echo $ptotal['Rut'] ?></td>
                                                <td class="align-middle"><?php echo $ptotal['NombreTra']; ?></td>
                                                <td class="align-middle"><?php echo $ptotal['PaternoTra'] . ' ' . $ptotal['MaternoTra']; ?></td>
                                                <td class="align-middle"><?php echo $ptotal['Profesion'] ?></td>
                                                <td class="align-middle"><?php echo $ptotal['CelularTra'] ?></td>
                                                <td class="align-middle"><?php echo $ptotal['CorreoTra'] ?></td>

                                                <td class="align-middle" style="text-align: center; font-weight: 700;">
                                                    <?php
                                                    if ($ptotal['Cumple'] == 1) {
                                                        echo '<span style="color: #00886f;">Si cumple</span>';
                                                    } else {
                                                        echo '<span style="color: #c40055;">No cumple</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div class="container-ver" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                                        <a class="button-ir" href="info_contrata.php?id=<?php echo $ptotal['IDTra']; ?>">
                                                            <span style="display: flex; align-items: center;">
                                                                <i class="fas fa-share"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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