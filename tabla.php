
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

    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet" />

    <!-- ICONOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.16/jspdf.plugin.autotable.min.js"></script>

</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <?php require("./components/navbar.php"); ?>
        <?php require("./components/sidebar.html"); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-md">


                    <div class="">
                        <div class="card mb-4">
                            <div class="card-header" style="text-align: center; font-size:25px">
                                Lista completa de trabajadores
                            </div>
                            <div class="card-body">

                                <!-- <label for="a">APLICA</label>
                                <select name="" class="form-control filtro" id="a">
                                    <option value="0">SELECCIONE</option>
                                    <option>SI</option>
                                    <option>NO</option>
                                </select>

                                

                                <label for="a">APLICA</label>
                                <select name="" class="form-control filtro" id="a">
                                    <option value="0">SELECCIONE</option>
                                    <option>SI</option>
                                    <option>NO</option>
                                </select>

                                <label for="a">APLICA</label>
                                <select name="" class="form-control filtro" id="a">
                                    <option value="0">SELECCIONE</option>
                                    <option>SI</option>
                                    <option>NO</option>
                                </select>
                            <HR> -->



                                <label for="">Filtrar Búsqueda:</label>
                                <br>
                                <div class="row">
                                    <div class="col-md-4"> <!-- LUGAR -->
                                        <label for="idSelectLugar">Lugar</label>
                                        <select name="nameSelectLugar" id="idSelectLugar" class="form-select filtro" required onchange="cargarSectores()">
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
                                    <div class="col-md-4">
                                        <label for="idSelectSector">Sector</label>
                                        <select name="nameSelectSector" id="idSelectSector" class="form-select filtro" required>
                                            <option value="0" hidden> Selecciona</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="idSelectCumple">Estado</label>
                                        <select name="nameSelectCumple" class="form-control filtro" id="idSelectCumple">
                                            <option value="0"> Selecciona</option>
                                            <option value="Si Cumple">Si Cumple</option>
                                            <option value="No Cumple">No Cumple</option>
                                        </select>

                                    </div>

                                    <div class="col-md-2 mt-auto text-center">
                                        <button id="btn-filtro" class="btn btn-enviar">Buscar</button>
                                    </div>

                                </div>
                                <hr>
                                <br>



                                <table id="total" class="table table-striped table-bordered" style="width:100%" data-search="true">
                                    <thead>
                                        <tr>
                                            <th>Rut</th>
                                            <th>Decreto</th>
                                            <th>Nombre</th>
                                            <th>Profesión</th>
                                            <th>Lugar</th>
                                            <th>Sector</th>
                                            <th>Cumple</th>
                                        </tr>
                                    </thead>
                                    <tbody id="trabajadores_tbody">
                                        <?php
                                        $sqlTodos = "SELECT t.Rut, t.NombreTra, t.PaternoTra, t.MaternoTra, t.Decreto, t.Profesion, l.NombreLug, s.NombreSector, t.CelularTra, t.CorreoTra, t.Cumple
    FROM trabajador t 
    INNER JOIN lugar l ON (l.IDLugar = t.IDLugar)
    INNER JOIN sector s ON (s.IDSector = t.IDSector)";

                                        $resultadoTotal = mysqli_query($conn, $sqlTodos);
                                        while ($ptotal = mysqli_fetch_array($resultadoTotal)) { ?>
                                            <tr>
                                                <td><?php echo $ptotal['Rut'] ?></td>
                                                <td><?php echo $ptotal['Decreto'] ?></td>
                                                <td><?php echo $ptotal['NombreTra'] . ' ' . $ptotal['PaternoTra'] . ' ' . $ptotal['MaternoTra']; ?></td>
                                                <td><?php echo $ptotal['Profesion'] ?></td>
                                                <td><?php echo $ptotal['NombreLug'] ?></td>
                                                <td><?php echo $ptotal['NombreSector'] ?></td>
                                                <td style="text-align: center; <?php if ($ptotal['Cumple'] == 1) { ?>background-color: #00c4a0;<?php } else { ?>background-color: #c40055;<?php } ?> color: white; font-weight: bold;">
                                                    <?php echo $ptotal['Cumple'] == 1 ? 'Si cumple' : 'No cumple'; ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/tablas.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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