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

if (isset($_GET['id'])) {
    $idtra = $_GET['id'];

    $datosEditar = "SELECT cat.NombreCat, con.NombreCon, afp.NombreAFP, pre.NombrePrev, lug.NombreLug, sec.NombreSector, con.IDCon, afp.IDAFP, cat.IDCat, pre.IDPrev, lug.IDLugar, sec.IDSector, tra.IDTra, tra.NombreTra, tra.PaternoTra, tra.MaternoTra, tra.Inscripcion, tra.Decreto, tra.Rut, tra.Genero, tra.Profesion, tra.Medico, tra.CelularTra, tra.CorreoTra, tra.RutaPrev, tra.RutaCV, tra.RutaAFP, tra.RutaNac, tra.RutaAntec, tra.RutaCedula, tra.RutaEstudio, tra.RutaContrato, tra.RutaDJur, tra.RutaSerM, tra.RutaSCom, tra.RutaExaM, tra.Observ, tra.RutaInscripcion
    FROM trabajador tra
    INNER JOIN categoria cat ON (cat.IDCat = tra.IDCat)
    INNER JOIN contrato con ON (con.IDCon = tra.IDCon)
    INNER JOIN afp afp ON (afp.IDAFP = tra.IDAFP)
    INNER JOIN lugar lug ON (lug.IDLugar = tra.IDLugar)
    INNER JOIN sector sec ON (sec.IDSector = tra.IDSector)
    INNER JOIN prevision pre ON (pre.IDPrev = tra.IDPrev)
    WHERE tra.IDTra='$idtra' LIMIT 1";

    $resultDatosEditar = mysqli_query($conn, $datosEditar);

    if (mysqli_num_rows($resultDatosEditar) == 1) {
        $persona = mysqli_fetch_assoc($resultDatosEditar);
    }
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Editar</title>
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
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">


</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <?php require("./components/navbar.php") ?>
        <?php require("./components/sidebar.php") ?>


        <div id="layoutSidenav_content">
            <main>
                <?php if (isset($persona)) { ?>
                    <div class="container-md">


                    </div>
                    <br>
                    <div id="editcal">
                        <?php
                        $sqlCalificacion = "SELECT * FROM calificaciones WHERE IDTra = $idtra";
                        $resultadoCalif = mysqli_query($conn, $sqlCalificacion);
                        ?>

                        <div class="documentacion seccion seccion-cal">
                            <h6>Calificaciones</h6>


                            <table id="calEDIT" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 13%;">Fecha</th>
                                        <th class="text-center">Calificación</th>
                                        <th class="text-center">Subir o Cambiar Calificación</th>
                                        <th class="text-center" style="width: 7%;">Apelo</th>
                                        <th class="text-center">Apelación</th>
                                        <th class="text-center">Subir o Cambiar Apelación</th>
                                        <th class="text-center">Actualizar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($mostrar = mysqli_fetch_array($resultadoCalif)) { ?>
                                        <form method="POST" enctype="multipart/form-data" id="edicion_calif_<?php echo $mostrar['IDCalif'] ?>" class="edicionCalif">
                                            <input name="idtracal" value="<?php echo $idtra ?>" class="form-control" id="idtracal" hidden>
                                            <tr>

                                                <td class="align-middle text-center">
                                                    <input type="text" class="form-control" value="<?php echo $mostrar['fecha'] ?>" name="namefecha_<?php echo $mostrar['IDCalif'] ?>" id="fechacalif">
                                                </td>
                                                <td class="align-middle text-center">
                                                    <?php if (!empty($mostrar['RutaCalificacion'])) { ?>
                                                        <center>
                                                            <div class="contenedor-botones">
                                                                <button class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $mostrar['RutaCalificacion'] ?>', '_blank')">
                                                                    <i class="fa-solid fa-expand"></i>
                                                                </button>
                                                                <a href="<?php echo $mostrar['RutaCalificacion'] ?>" download class="btn btn-primary boton-descargar w-100">
                                                                    <i class="fa-sharp fa-solid fa-download"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-danger w-100 boton-eliminar" onclick="event.preventDefault(); deleteFileCal('<?php echo $mostrar['RutaCalificacion'] ?>', '<?php echo $mostrar['IDCalif'] ?>')">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </center>
                                                    <?php } else { ?>
                                                        <div class="contenedor-botones">
                                                            <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="input-group custom-input">
                                                        <input type="file" id="idcalifEDIT" name="nameCalif_<?php echo $mostrar['IDCalif'] ?>" class="form-control" accept=".pdf">
                                                        <button class="button" type="button" onclick="clearFileInput('idcalifEDIT')" style="width: 40px !important;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <select class="form-control" name="nameapelo_<?php echo $mostrar['IDCalif'] ?>" id="selectapelo">
                                                        <option value="Si" <?php if ($mostrar['apelo'] == 'Si') echo 'selected'; ?>>Si</option>
                                                        <option value="No" <?php if ($mostrar['apelo'] == 'No') echo 'selected'; ?>>No</option>
                                                    </select>
                                                </td>
                                                <td class="centrado">
                                                    <?php if (!empty($mostrar['RutaApelacion'])) { ?>
                                                        <center>
                                                            <div class="contenedor-botones">
                                                                <button class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $mostrar['RutaApelacion'] ?>', '_blank')">
                                                                    <i class="fa-solid fa-expand"></i>
                                                                </button>
                                                                <a href="<?php echo $mostrar['RutaApelacion'] ?>" download class="btn btn-primary boton-descargar w-100">
                                                                    <i class="fa-sharp fa-solid fa-download"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-danger w-100 boton-eliminar" onclick="event.preventDefault(); deleteFileApela('<?php echo $mostrar['RutaApelacion'] ?>', '<?php echo $mostrar['IDCalif'] ?>')">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </center>
                                                    <?php } else { ?>
                                                        <div class="contenedor-botones">
                                                            <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="input-group file-cal">
                                                        <input type="file" id="idapelaEDIT" name="nameApela_<?php echo $mostrar['IDCalif'] ?>" class="form-control" accept=".pdf">
                                                        <button class="button" type="button" onclick="clearFileInput('idapelaEDIT')" style="width: 40px !important;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <button class="Btncalif" type="submit">Actualizar</button>


                                                </td>
                                        </form>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <br>
                        </div>


                    </div>


        </div>



    <?php } ?>
    </main>
    </div>
    </div>


    <script src="./assets/js/sidebar.js"></script> <!-- HACE QUE SE ENCOJA EL MENU LATERAL -->
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/elimina.js"></script>
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