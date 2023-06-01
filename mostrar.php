<?php include("./controller/config/conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Información</title>
    <!-- ESTILOS -->
    <link href="./assets/styles/styles.css" rel="stylesheet" />
    <link href="./assets/styles/form.css" rel="stylesheet" />
    <!-- cdn jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- cdn css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ICONOS -->

    <!-- datatable -->
    <link href="cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">

</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <?php require("./components/navbar.php") ?>
        <?php require("./components/sidebar.html") ?>


        <div id="layoutSidenav_content">
            <main>
                <?php if (isset($persona)) { ?>
                    <div class="container-md">
                        <form action="editar_registro.php" method="POST">
                            <div class="row d-flex justify-content-center align-items-center principal">
                                <div class="title">
                                    <h1 class="mt-4">Información</h1>
                                    <input type="hidden" name="nameRutEditar" value="<?php echo $persona['Rut'] ?>">
                                    <button class="btn btn-editar" type="submit">
                                        <h1 class="edit-icon mt-4"><i class="fa-solid fa-pen-to-square"></i></h1>
                                    </button>
                                </div>
                            </div>
                        </form>


                        <br>
                        <div class="seccion">
                            <div class="row ">
                                <h6>Datos Personales</h6>
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
                                    <textarea class="form-control" rows="2" readonly style="resize: none;"><?php echo $persona['NombreCat'] ?></textarea>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md">
                                    <label>Lugar de Trabajo</label>
                                    <input value="<?php echo $persona['NombreLug'] ?>" class="form-control" readonly>
                                    <br>
                                </div>
                                <div class="sector-ver col-md">
                                    <label>Sector</label>
                                    <input value="<?php echo $persona['NombreSector'] ?>" class="form-control" readonly>
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

                            <table id="docs" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Documento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle custom-height">N° de Decreto (<strong><?php echo $persona['Decreto'] ?></strong>)</td>
                                        <td class="align-middle custom-height"><?php include('./controller/consulta_archivo/contrato.php') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle custom-height">Declaración Jurada</td>
                                        <td class="align-middle custom-height"><?php include('./controller/consulta_archivo/declaracionJ.php') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle custom-height">Certificado de Nacimiento</td>
                                        <td class="align-middle custom-height"><?php include('./controller/consulta_archivo/certificadoNac.php') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle custom-height">Certificado de Antecedentes</td>
                                        <td class="align-middle custom-height"><?php include('./controller/consulta_archivo/antecedentes.php') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle custom-height">Fotocopia de Cédula de Identidad</td>
                                        <td class="align-middle custom-height"><?php include('./controller/consulta_archivo/fotocopiaCedula.php') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle custom-height">Curriculum Vitae</td>
                                        <td class="align-middle custom-height"><?php include('./controller/consulta_archivo/curriculum.php') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle custom-height">Certificado de Estudios o Título Profesional</td>
                                        <td class="align-middle custom-height"><?php include('./controller/consulta_archivo/estudios.php') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle custom-height">Certificado de Salud Compatible</td>
                                        <td class="align-middle custom-height"><?php include('./controller/consulta_archivo/saludCompatible.php') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle custom-height">Certificado de Afiliación AFP (<strong><?php echo $persona['NombreAFP'] ?></strong>)</td>
                                        <td class="align-middle custom-height"><?php if ($persona['IDAFP'] != 1) {
                                                                                    include('./controller/consulta_archivo/afp.php');
                                                                                } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle custom-height">Certificado de Afiliación Previsional (<strong><?php echo $persona['NombrePrev'] ?></strong>)</td>
                                        <td class="align-middle custom-height"><?php if ($persona['IDPrev'] != 1) {
                                                                                    include('./controller/consulta_archivo/prevision.php');
                                                                                } ?></td>
                                    </tr>


                                    <?php if ($persona['Inscripcion'] == 1) { ?>
                                        <tr>
                                            <td class="align-middle custom-height">Certificado de inscripción en el Registro Nacional de Prestadores Individuales</td>
                                            <td class="align-middle custom-height"><?php include('./controller/consulta_archivo/inscripcion.php') ?></td>
                                        </tr> <?php }
                                                ?>


                                    <?php if ($persona['Medico'] == 'Si') { ?>
                                        <tr>
                                            <td class="align-middle custom-height">Examen Único Nacional de Conocimientos de Medicina</td>
                                            <td class="align-middle custom-height"><?php include('./controller/consulta_archivo/examenMedico.php') ?></td>
                                        </tr> <?php }
                                                ?>

                                    <?php if ($persona['Genero'] == 'Masculino') { ?>
                                        <tr>
                                            <td class="align-middle custom-height">Certificado de Servicio Militar al Día</td>
                                            <td class="align-middle custom-height"><?php include('./controller/consulta_archivo/servicioMilitar.php') ?></td>
                                        </tr> <?php }
                                                ?>

                                </tbody>
                            </table>

                        </div>


                        <br>
                        <div class="observaciones seccion">
                            <h6>Observaciones</h6>
                            <?php if (empty($persona['Observ'])) : ?>
                                <textarea class="form-control" rows="5" cols="50" readonly>Sin observaciones</textarea>
                            <?php else : ?>
                                <textarea class="form-control" rows="5" cols="50" readonly><?php echo $persona['Observ'] ?></textarea>
                            <?php endif; ?>
                        </div>

                        <br>


                        <div class="seccion">

                            <h6>Calificaciones</h6>
                            <div class="addCalificacion">
                                <form action="calificaciones.php" method="POST">
                                    <input type="hidden" name="nameRutCalifica" value="<?php echo $persona['Rut'] ?>">
                                    <button class="btn btn-calificacion" type="submit">Añadir <i class="fa-solid fa-circle-plus"></i></button>
                                </form>
                            </div>


                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Calificación</th>
                                        <th class="text-center">Apelo</th>
                                        <th class="text-center">Apelación</th>
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
                                        echo "<td class='align-middle text-center'>" . $mostrar['IDCalif'] . "</td>";
                                        echo "<td class='align-middle text-center'>" . $mostrar['fecha'] . "</td>";

                                        echo "<td class='align-middle text-center'>";
                                        if (!empty($mostrar['RutaCalificacion'])) {
                                            echo '
                     
                                <center>
                                    <div class="contenedor-botones">
                                    <button class="btn btn-primary boton-ver w-100" onclick="window.open(\'' . $mostrar['RutaCalificacion'] . '\', \'_blank\')"><i class="fa-solid fa-expand"></i></button>
                                    <a href="' . $mostrar['RutaCalificacion'] . '" download class="btn btn-primary boton-descargar w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                </div>
                                </center>';
                                        }
                                        echo '</td>';
                                        echo "<td class='align-middle text-center'>" . $mostrar['apelo'] . "</td>";

                                        echo "<td class='centrado'>";
                                        if (!empty($mostrar['RutaApelacion'])) {
                                            echo '
                                <center>
                                 <div class="contenedor-botones">
                                    <button class="btn btn-primary boton-ver w-100" onclick="window.open(\'' . $mostrar['RutaApelacion'] . '\', \'_blank\')"><i class="fa-solid fa-expand"></i></button>
                                    <a href="' . $mostrar['RutaApelacion'] . '" download class="btn btn-primary boton-descargar w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                </div>
                                </center>';
                                        }
                                        echo '</td>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>


                    </div>
                <?php } ?>
            </main>
        </div>
    </div>


    <script src="./assets/js/sidebar.js"></script> <!-- HACE QUE SE ENCOJA EL MENU LATERAL -->
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/doc_exclusivos.js"></script>
    <script src="./assets/js/validaciones_input.js"></script>
    <script src="./assets/js/tablas.js"></script>
    <!-- cdn js de boostrap -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

</body>

</html>