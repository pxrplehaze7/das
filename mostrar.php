<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Trabajador</title>



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- cdn iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- estilo de registro -->
    <link href="./assets/css/styles.css" rel="stylesheet">
    <!-- estilo menu -->
    <link href="./assets/css/menu.css" rel="stylesheet">
    <!-- sweet alert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">


</head>

<body>
    <header>
        <?php include("./controller/navbar.php") ?>
    </header>
    <?php if (isset($persona)) { ?>
        <div class="container-md">
            <h1>Información Personal</h1>
            <br>
            <div class="seccion">
                <div class="row ">
                    <h6>Datos Personales</h6>
                    <form action="calificaciones.php" method="POST">
                        <input type="hidden" name="nameRutCalifica" value="<?php echo $persona['Rut'] ?>">
                        <button class="btn btn-calificacion" type="submit">Calificaciones <i class="fa-solid fa-arrow-up-right-from-square"></i></button>
                    </form>
                    <div class="col-md">
                        <label>Rut</label>
                        <input value="<?php echo $persona['Rut'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="col-md">
                        <label> Nombres</label>
                        <input value="<?php echo $persona['NombreTra'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md">
                        <label> Apellido Paterno</label>
                        <input value="<?php echo $persona['PaternoTra'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="col-md">
                        <label>Apellido Materno</label>
                        <input value="<?php echo $persona['MaternoTra'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md">
                        <label>Género</label>
                        <input value="<?php echo $persona['Genero'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="col-md">
                        <label>Tipo de Contrato </label>
                        <input value="<?php echo $persona['NombreCon'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label>Categoria </label>
                        <input value="<?php echo $persona['NombreCat'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label>Lugar de Trabajo</label>
                        <input value="<?php echo $persona['NombreLug'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="sector-ver col-md">
                        <label>Sector</label>
                        <input value="<?php echo $persona['Sector'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label>Profesion</label>
                        <input value="<?php echo $persona['Profesion'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="col-md">
                        <label>Genero</label>
                        <input value="<?php echo $persona['Genero'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label>AFP</label>
                        <input value="<?php echo $persona['NombreAFP'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="col-md">
                        <label>Previsión de Salud</label>
                        <input value="<?php echo $persona['NombrePrev'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-md">
                        <label>Celular </label>
                        <input value="<?php echo $persona['CelularTra'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <br>
                    <div class="col-md">
                        <label>Correo</label>
                        <input value="<?php echo $persona['CorreoTra'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
            </div>
            <br>
            <div class="documentacion seccion">
                <h6>Documentación</h6>
                <br>
                <?php include('./controller/consulta_archivo/contrato.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/declaracionJ.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/certificadoNac.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/antecedentes.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/fotocopiaCedula.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/curriculum.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/estudios.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/saludCompatible.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/afp.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/consultaPrev.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/examenMedico.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/servicioMilitar.php') ?>
            </div>


            <div class="seccion">
    <table id="myTable" class="display table table-striped table-primary table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Calificación</th>
                <th>Apelo</th>
                <th>Apelación</th>
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
                echo "<tr>";
                echo "<td>" . $mostrar['IDCalif'] . "</td>";
                echo "<td>" . $mostrar['fecha'] . "</td>";
                echo "<td>" . $mostrar['apelo'] . "</td>";
                echo "<td>" . $mostrar['RutaCalificacion'] . "</td>";
                echo "<td>" . $mostrar['RutaApelacion'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>




        <?php } ?>


        <!-- cdn js de boostrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            language: {
                "sEmptyTable":     "No se encontraron datos disponibles en la tabla",
                "sInfo":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando 0 a 0 de 0 registros",
                "sInfoFiltered":   "(filtrado de _MAX_ registros en total)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ",",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sLoadingRecords": "Cargando...",
                "sProcessing":     "Procesando...",
                "sSearch":         "Buscar:",
                "sZeroRecords":    "No se encontraron registros coincidentes",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": activar para ordenar la columna de manera descendente"
                }
            }
        });
    });
</script>

</body>

</html>