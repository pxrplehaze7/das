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
                                <label for="filtrobuscar">Filtrar Búsqueda:</label>
                                <br>
                                <div class="row align-items-end" id="filtrobuscar">
                                    <div class="col-md-3 col-sm-6"> <!-- LUGAR -->
                                        <label for="idSelectLugar">Lugar</label>
                                        <select name="nameSelectLugar" id="idSelectLugar" class="form-select filtro" required onchange="cargarSectoresTABLA()">
                                            <option value="0" hidden> Selecciona</option>
                                            <?php
                                            $sqlLugar = "SELECT IDLugar, NombreLug FROM lugar";
                                            $resultadoLugar = mysqli_query($conn, $sqlLugar);
                                            while ($fila = mysqli_fetch_assoc($resultadoLugar)) {
                                                echo "<option value='" . $fila['IDLugar'] . "'>" . $fila['NombreLug'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label for="idSelectSector">Sector</label>
                                        <select name="nameSelectSector" id="idSelectSector" class="form-select filtro" required>
                                            <option value="0"> Selecciona</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label for="idSelectCumple">Estado</label>
                                        <select name="nameSelectCumple" class="form-control filtro" id="idSelectCumple">
                                            <option value=""> Selecciona</option>
                                            <option value="1">Si Cumple</option>
                                            <option value="0">No Cumple</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="d-flex justify-content-end gap-2">
                                            <button id="btn-filtro" class="btn btn-filtro">Buscar <i class="fa-solid fa-magnifying-glass"></i></button>
                                            <button id="limpia-filtro" class="btn btn-filtro">Limpiar <i class="fas fa-eraser"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <br>
                                <table id="total_contrata" class="table table-striped table-bordered" style="width:100%" data-search="true">
                                    <thead>
                                        <tr>
                                            <th style="width: 75px;">Rut</th>

                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Profesión</th>
                                            <th>Celular</th>
                                            <th>Correo Electrónico</th>
                                            <th style="width: 75px;">Cumple</th>
                                            <th>Ver</th>
                                        </tr>
                                    </thead>
                                    <tbody id="trabajadores_tbody">
                                        <?php
                                        $sqlTodos = "SELECT Rut, IDTraH, NombreH, PaternoH, MaternoH, Profesion, 
                                        CelularH, CorreoH, Cumple
                                        FROM honorario";

                                        $resultadoTotal = mysqli_query($conn, $sqlTodos);
                                        while ($ptotalHono = mysqli_fetch_array($resultadoTotal)) { ?>
                                            <tr>
                                                <td class="align-middle"><?php echo $ptotalHono['Rut'] ?></td>
                                                <td class="align-middle"><?php echo $ptotalHono['NombreH']; ?></td>
                                                <td class="align-middle"><?php echo $ptotalHono['PaternoH'] . ' ' . $ptotalHono['MaternoH']; ?></td>
                                                <td class="align-middle"><?php echo $ptotalHono['Profesion'] ?></td>
                                                <td class="align-middle"><?php echo $ptotalHono['CelularH'] ?></td>
                                                <td class="align-middle"><?php echo $ptotalHono['CorreoH'] ?></td>

                                                <td class="align-middle" style="text-align: center; font-weight: 700;">
                                                    <?php
                                                    if ($ptotalHono['Cumple'] == 1) {
                                                        echo '<span style="color: #00886f;">Si cumple</span>';
                                                    } else {
                                                        echo '<span style="color: #c40055;">No cumple</span>';
                                                    }
                                                    ?>
                                                </td>

                                     
                                                <td  style="vertical-align: middle; text-align: center;">
                                                    <a class="a-ir" href="info_honorario.php?idh=<?php echo $ptotalHono['IDTraH']; ?>" style="text-decoration: none;">
                                                        <span>Ir <i class="fa-solid fa-circle-arrow-right"></i></span>
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