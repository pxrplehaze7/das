<?php include("./controller/config/conexion.php");
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
    <title>Información</title>
    <link href="./assets/styles/styles.css" rel="stylesheet" />
    <link href="./assets/styles/form.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="./assets/img/favicon-32x32.png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
</head>

<body class="sb-nav-fixed">
    <?php require("./components/navbar.php") ?>
    <div id="layoutSidenav">
        <?php require("./components/sidebar.php") ?>
        <div id="layoutSidenav_content">
            <main>
                <?php if (isset($persona)) { ?>
                    <div class="container-md">
                        <div class="title">
                            <div class="ti">
                                <h1 class="mt-4">Información</h1>
                            </div>
                        </div>
                        <br>
                        <div class="seccion">
                            <div class="title">
                                <div class="ti">
                                    <h6 class="mt-4">Datos Personales</h6>
                                </div>
                                <?php if ($_SESSION['rol'] === '1') { ?>
                                    <form action="editar_registro.php" method="GET">
                                        <div class="container-volver">
                                            <div class="title">
                                                <button class="btn btn-editar" style="width: 90px;" type="submit">Editar <i class="fa-solid fa-pen-to-square"></i></button>
                                                <input type="hidden" name="id" id="idtraid" value="<?php echo $persona['IDTra'] ?>">
                                            </div>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
                            <div class="row ">
                                <div class="col-md-3">
                                    <label>Rut</label>
                                    <input value="<?php echo $persona['Rut'] ?>" class="form-control" readonly>
                                    <br>
                                </div>
                                <div class="col-md-9">
                                    <label> Nombre Completo</label>
                                    <input value="<?php echo $persona['NombreTra'] . ' ' . $persona['PaternoTra'] . ' ' . $persona['MaternoTra'] ?>" class="form-control" readonly>
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
                                    <label>Profesion</label>
                                    <input value="<?php echo $persona['Profesion'] ?>" class="form-control" readonly>
                                    <br>
                                </div>
                                <div class="col-md">
                                    <label>Género</label>
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
                            <h6>Observaciones</h6>
                            <?php if (empty($persona['Observ'])) : ?>
                                <textarea class="form-control" rows="5" cols="50" readonly>Sin observaciones</textarea>
                            <?php else : ?>
                                <textarea class="form-control" rows="5" cols="50" readonly><?php echo $persona['Observ'] ?></textarea>
                            <?php endif; ?>
                        </div>

                        <br>
                        <div class="documentacion seccion">
                            <div class="title">
                                <div class="ti">
                                    <h6 class="mt-4">Contratos</h6>
                                </div>
                                <form action="registroDECRETOS.php" method="GET">
                                    <div class="container-volver">
                                        <div class="title">
                                            <button class="btn btn-editar" type="submit" style="width: 120px;">Añadir <i class="fa-solid fa-circle-plus"></i></button>
                                            <input type="hidden" name="id" id="idtraid" value="<?php echo $persona['IDTra'] ?>">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <table id="decretosp" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>N° Doc.</th>
                                        <th>Fecha Documento</th>
                                        <th>Tipo Contrato</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Termino</th>
                                        <th>Lugar</th>
                                        <th>Sector</th>
                                        <th>Estado</th>
                                        <th>Archivo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $decretosp = "SELECT d.IDdecreto, d.IDTra, t.Rut, d.NDecreto, d.FechaDoc, d.RutaCon, d.FechaInicio, d.FechaTermino, d.Estado, d.Confirmacion, l.NombreLug, s.NombreSector, con.NombreCon, d.RutaCon
                                        FROM decretos d
                                        INNER JOIN lugar l ON (l.IDLugar = d.IDLugar)
                                        INNER JOIN sector s ON (s.IDSector = d.IDSector)
                                        INNER JOIN contrato con ON (con.IDCon = d.IDCon)
                                        INNER JOIN trabajador t ON (t.IDTra = d.IDTra)
                                        WHERE d.IDTra = $idtra";

                                    $resultadodecs = mysqli_query($conn, $decretosp);
                                    while ($decsper = mysqli_fetch_array($resultadodecs)) { ?>
                                        <tr>
                                            <td class="align-middle"><?php echo $decsper['NDecreto'] ?></td>
                                            <td class="align-middle"><?php echo date('d-m-Y', strtotime($decsper['FechaDoc'])) ?></td>
                                            <td class="align-middle"><?php echo  $decsper['NombreCon'] ?></td>
                                            <td class="align-middle"><?php echo date('d-m-Y', strtotime($decsper['FechaInicio'])) ?></td>
                                            <td class="align-middle"><?php echo date('d-m-Y', strtotime($decsper['FechaTermino'])) ?></td>
                                            <td class="align-middle"><?php echo  $decsper['NombreLug'] ?></td>
                                            <td class="align-middle"><?php echo  $decsper['NombreSector'] ?></td>



                                            <td class="align-middle" style="text-align: center; font-weight: 700;">
                                                <?php
                                                if ($decsper['Estado'] == 1) {
                                                    echo '<span style="color: #00886f;">Vigente</span>';
                                                } elseif ($decsper['Estado'] == 2) {
                                                    echo '<span style="color: #ff9900;">Por finalizar</span>';
                                                } elseif ($decsper['Estado'] == 0) {
                                                    echo '<span style="color: #ff0000;">Finalizado</span>';
                                                }
                                                ?>

                                            </td>



                                            <td class="align-middle">

                                                <?php if (!empty($decsper['RutaCon'])) { ?>
                                                    <div class="contenedor-botones">
                                                        <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $decsper['RutaCon']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                        <a href="<?php echo $decsper['RutaCon'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="contenedor-botones">
                                                        <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                    </div>
                                                <?php } ?>

                                            </td>



                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>
                        <br>
                        <div class="documentacion seccion">
                            <div class="title">
                                <br>
                                <div class="ti">
                                    <h6 class="mt-4">Documentos</h6>
                                </div>
                                <form action="pdfs_anteriores.php" method="GET">
                                    <div class="container-volver">
                                        <div class="title">
                                            <button class="btn btn-editar" type="submit" style="width: 120px;">Anteriores <i class="fas fa-history"></i></button>
                                            <input type="hidden" name="id" id="idtraid" value="<?php echo $persona['IDTra'] ?>">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <table id="docs" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Documento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle custom-height">Declaración Jurada</td>
                                        <td class="align-middle custom-height">
                                            <?php
                                            if (!empty($persona['RutaDJur'])) {
                                            ?>
                                                <div class="contenedor-botones">
                                                    <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaDJur']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="<?php echo $persona['RutaDJur'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle custom-height">Certificado de Nacimiento</td>
                                        <td class="align-middle custom-height">
                                            <?php
                                            if (!empty($persona['RutaNac'])) { ?>
                                                <div class="contenedor-botones">
                                                    <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaNac']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="<?php echo $persona['RutaNac'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>
                                            <?php
                                            } else { ?>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle custom-height">Certificado de Antecedentes</td>
                                        <td class="align-middle custom-height">
                                            <?php
                                            if (!empty($persona['RutaAntec'])) { ?>
                                                <div class="contenedor-botones">
                                                    <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaAntec']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="<?php echo $persona['RutaAntec'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle custom-height">Fotocopia de Cédula de Identidad</td>
                                        <td class="align-middle custom-height">
                                            <?php
                                            if (!empty($persona['RutaCedula'])) { ?>
                                                <div class="contenedor-botones">
                                                    <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaCedula']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="<?php echo $persona['RutaCedula'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>
                                            <?php   } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle custom-height">Curriculum Vitae</td>
                                        <td class="align-middle custom-height">
                                            <?php
                                            if (!empty($persona['RutaCV'])) { ?>
                                                <div class="contenedor-botones">
                                                    <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaCV']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="<?php echo $persona['RutaCV'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle custom-height">Certificado de Estudios o Título Profesional</td>
                                        <td class="align-middle custom-height">
                                            <?php
                                            if (!empty($persona['RutaEstudio'])) { ?>
                                                <div class="contenedor-botones">
                                                    <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaEstudio']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="<?php echo $persona['RutaEstudio'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle custom-height">Certificado de Salud Compatible</td>
                                        <td class="align-middle custom-height">
                                            <?php
                                            if (!empty($persona['RutaSCom'])) { ?>
                                                <div class="contenedor-botones">
                                                    <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaSCom']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="<?php echo $persona['RutaSCom'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                <?php } ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle custom-height">Certificado de Afiliación AFP (<strong><?php echo $persona['NombreAFP'] ?></strong>)</td>
                                        <td class="align-middle custom-height"><?php

                                                                                if (!empty($persona['RutaAFP'])) { ?>
                                                <div class="contenedor-botones">
                                                    <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaAFP']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="<?php echo $persona['RutaAFP'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>
                                            <?php }  ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle custom-height">Certificado de Afiliación Previsional (<strong><?php echo $persona['NombrePrev'] ?></strong>)</td>
                                        <td class="align-middle custom-height"><?php

                                                                                if (!empty($persona['RutaPrev'])) { ?>
                                                <div class="contenedor-botones">
                                                    <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaPrev']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="<?php echo $persona['RutaPrev'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>

                                            <?php }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php if ($persona['Inscripcion'] == 1) { ?>
                                        <tr>
                                            <td class="align-middle custom-height">Certificado de inscripción en el Registro Nacional de Prestadores Individuales</td>
                                            <td class="align-middle custom-height">
                                                <?php
                                                if (!empty($persona['RutaInscripcion'])) { ?>
                                                    <div class="contenedor-botones">
                                                        <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaInscripcion']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                        <a href="<?php echo $persona['RutaInscripcion'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="contenedor-botones">
                                                        <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                        </tr> <?php } ?>
                                    <?php if ($persona['Medico'] == 'Si') { ?>
                                        <tr>
                                            <td class="align-middle custom-height">Examen Único Nacional de Conocimientos de Medicina</td>
                                            <td class="align-middle custom-height">
                                                <?php
                                                if (!empty($persona['RutaExaM'])) { ?>
                                                    <div class="contenedor-botones">
                                                        <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaExaM']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                        <a href="<?php echo $persona['RutaExaM'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="contenedor-botones">
                                                        <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                        </tr> <?php } ?>
                                    <?php if ($persona['Genero'] == 'Masculino') { ?>
                                        <tr>
                                            <td class="align-middle custom-height">Certificado de Servicio Militar al Día</td>
                                            <td class="align-middle custom-height">
                                                <?php
                                                if (!empty($persona['RutaSerM'])) { ?>
                                                    <div class="contenedor-botones">
                                                        <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaSerM']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                        <a href="<?php echo $persona['RutaSerM'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="contenedor-botones">
                                                        <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                        </tr> <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                        <br>





                        <div class="seccion">
                            <div class="title">
                                <div class="ti">
                                    <h6 class="mt-4">Calificaciones</h6>
                                </div>
                                <?php if ($_SESSION['rol'] === '1') { ?>
                                    <form action="calificaciones.php" method="GET">
                                        <div class="container-volver">
                                            <div class="title">
                                                <button class="btn btn-calificacion" style="width: 100px;" type="submit">Añadir <i class="fa-solid fa-circle-plus"></i></button>
                                                <input type="hidden" name="id" id="idtraid" value="<?php echo $persona['IDTra'] ?>">
                                            </div>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
                            <table id="calif" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
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
                                    ?>
                                        <tr>
                                            <td class='align-middle text-center'><?php echo $mostrar['fecha'] ?></td>

                                            <td class='align-middle text-center'>
                                                <?php if (!empty($mostrar['RutaCalificacion'])) { ?>
                                                    <center>
                                                        <div class="contenedor-botones">
                                                            <button class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $mostrar['RutaCalificacion'] ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $mostrar['RutaCalificacion'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                        </div>
                                                    </center>
                                                <?php } ?>
                                            </td>
                                            <td class='align-middle text-center'><?php echo $mostrar['apelo'] ?></td>
                                            <td class='centrado'>
                                                <?php if (!empty($mostrar['RutaApelacion']) && $mostrar['apelo'] == "Si") { ?>
                                                    <center>
                                                        <div class="contenedor-botones">
                                                            <button class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $mostrar['RutaApelacion'] ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $mostrar['RutaApelacion'] ?>" download class="btn btn-primary boton-descargar2 w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                        </div>
                                                    </center>
                                                <?php } elseif (empty($mostrar['RutaApelacion']) && $mostrar['apelo'] == "Si") { ?>
                                                    <div class="contenedor-botones">
                                                        <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>