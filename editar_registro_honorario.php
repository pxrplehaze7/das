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
if (isset($_GET['idh'])) {
    $idh = $_GET['idh'];
    $datosEditar = "SELECT h.IDTraH, h.IDCat, h.NombreH, h.PaternoH, h.MaternoH, h.Rut, h.Genero, h.Medico, h.Inscripcion, h.Profesion, h.CelularH, h.CorreoH, h.RutaCV, h.RutaAntec, h.RutaCedula, h.RutaEstudio, h.RutaExaM, h.RutaInscripcion, h.Observ, c.NombreCat
    FROM honorario h
    INNER JOIN categoria c ON (c.IDCat = h.IDCat)
    WHERE IDTraH='$idh' LIMIT 1";
    $resultDatosEditar = mysqli_query($conn, $datosEditar);
    if (mysqli_num_rows($resultDatosEditar) == 1) {
        $editHonorario = mysqli_fetch_assoc($resultDatosEditar);
    }
 ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Editar Honorario</title>
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
    <?php require("./components/navbar.php") ?>
    <div id="layoutSidenav">
        <?php require("./components/sidebar.php") ?>
        <div id="layoutSidenav_content">
            <main>
                <?php if (isset($editHonorario)) { ?>
                    <div class="container-md tablap">
                        <form id="editInfoPersonalH" action="./controller/edit_infop_h.php" method="POST">
                            <div class="title">
                                <div class="ti">
                                    <h1 class="mt-4">Editar Información</h1>
                                </div>
                                <div class="container-volver">
                                    <a class="button-volver" href="info_honorario.php?idh=<?php echo $idh ?>">
                                        Volver <i class="fas fa-reply" style="display: flex; align-items: center; margin-left:6px;"></i>
                                    </a>
                                </div>
                            </div>
                            <br>
                            <div class="seccion">
                                <h6 style="padding-top: 20px !important;">Datos Personales</h6>
                                <div class="row ">
                                    <div class="col-md">
                                        <input name="editcontra" value="<?php echo $idh ?>" class="form-control" id="idtrabid" hidden>
                                        <label for="idRutInputp"><span style="color: #c40055;">*</span> Rut</label>
                                        <input type="text" name="RutInput" id="idRutInputp" value="<?php echo $editHonorario['Rut'] ?>" class="form-control" pattern="^\d{7,8}-[kK\d]$" maxlength="10" required>
                                        <br>
                                    </div>
                                    <div class="col-md">
                                        <label for="idPersona"><span style="color: #c40055;">*</span> Nombres</label>
                                        <input type="text" name="namePersona" id="idPersona" value="<?php echo $editHonorario['NombreH'] ?>" class="form-control" oninput="validarTexto(this)" required>
                                        <br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <label for="idAppat"><span style="color: #c40055;">*</span> Apellido Paterno</label>
                                        <input type="text" name="namePaterno" id="idAppat" value="<?php echo $editHonorario['PaternoH'] ?>" class="form-control" oninput="validarTexto(this)" required>
                                        <br>
                                    </div>
                                    <div class="col-md">
                                        <label for="idApmat">Apellido Materno</label>
                                        <input type="text" name="nameMaterno" id="idApmat" value="<?php echo $editHonorario['MaternoH'] ?>" class="form-control" oninput="validarTexto(this)">
                                        <br>
                                    </div>
                                </div>
                                <div class="art">
                                    <div class="row">

                                        <div class="col-md-6"> <!-- CATEGORIA -->
                                            <?php
                                            $sqlCategoria = "SELECT IDCat, NombreCat FROM categoria";
                                            $resultadoCategoria = mysqli_query($conn, $sqlCategoria);
                                            echo "<label for='idSelectCat'><span style='color: #c40055;'>*</span> Categoría </label>"; //Label 
                                            echo "<select name='nameSelectCat' id='idSelectCat' class='form-select' required> ";
                                            echo '<option hidden value=""> Selecciona una Categoría</option>'; // Opción por defecto en blan
                                            while ($fila = mysqli_fetch_assoc($resultadoCategoria)) {
                                                $selected = ($fila['IDCat'] == $editHonorario['IDCat']) ? 'selected' : '';
                                                echo "<option value='" . $fila['IDCat'] . "' " . $selected . ">" . $fila['NombreCat'] . "</option>";
                                            }
                                            echo "</select>";
                                            ?>
                                            <br>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="idProfesion"><span style="color: #c40055;">*</span> Profesión</label>
                                            <input type="text" name="nameProfesion" id="idProfesion" value="<?php echo $editHonorario['Profesion'] ?>" class="form-control" require>
                                            <br>
                                        </div>
                                    </div>
                                    <div id="idInscripcion" class="radioCentro row">
                                        <center>
                                            <label><span style="color: #c40055;">*</span> ¿Debe presentar Certificado de Inscripción?</label>
                                            <div class="radio-inputs">
                                                <label>
                                                    <input type="radio" name="nameInscrip" id="idSiInscrip" value=1 class="radio-input" <?php if ($editHonorario['Inscripcion'] == 1) echo "checked"; ?>>
                                                    <span class=" radio-tile">
                                                        <span class="radio-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                                                            </svg>
                                                        </span>
                                                        <span class="radio-label">Sí</span>
                                                    </span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="nameInscrip" id="idNoInscrip" value=0 class="radio-input" <?php if ($editHonorario['Inscripcion'] == 0) echo "checked"; ?>>
                                                    <span class="radio-tile">
                                                        <span class="radio-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                                                            </svg>
                                                        </span>
                                                        <span class="radio-label">No</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </center>
                                    </div>
                                    <div id="idPreguntaCat1" class="radioCentro" style="display:<?php echo $editHonorario['IDCat'] == 1 ? 'block' : 'none' ?>;">
                                        <center>
                                            <label><span style="color: #c40055;">*</span> ¿Es médico?</label>
                                            <div class="radio-inputs">
                                                <label>
                                                    <input type="radio" name="nameMedico" id="idSiMedico" value="Si" class="radio-input" <?php if ($editHonorario['Medico'] == 'Si') echo "checked"; ?>>
                                                    <span class="radio-tile">
                                                        <span class="radio-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                                                            </svg>
                                                        </span>
                                                        <span class="radio-label">Sí</span>
                                                    </span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="nameMedico" id="idNoMedico" value="No" class="radio-input" <?php if ($editHonorario['Medico'] == 'No') echo "checked"; ?>>
                                                    <span class="radio-tile">
                                                        <span class="radio-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                                                            </svg>
                                                        </span>
                                                        <span class="radio-label">No</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </center>
                                    </div>
                                    <br>

                                </div>
                                <br>
                                <div class="radioCentro row">
                                    <center>
                                        <label><span style="color: #c40055;">*</span> Seleccione Género</label>

                                        <div class="radio-inputs">
                                            <label>
                                                <input class="radio-input" type="radio" name="nameGenero" id="idFemenino" value="Femenino" <?php if ($editHonorario['Genero'] == 'Femenino') echo "checked"; ?> required">
                                                <span class="radio-tile">
                                                    <span class="radio-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                                            <path d="M80 176a112 112 0 1 1 224 0A112 112 0 1 1 80 176zM224 349.1c81.9-15 144-86.8 144-173.1C368 78.8 289.2 0 192 0S16 78.8 16 176c0 86.3 62.1 158.1 144 173.1V384H128c-17.7 0-32 14.3-32 32s14.3 32 32 32h32v32c0 17.7 14.3 32 32 32s32-14.3 32-32V448h32c17.7 0 32-14.3 32-32s-14.3-32-32-32H224V349.1z" />
                                                        </svg>
                                                    </span>
                                                    <span class="radio-label">Femenino</span>
                                                </span>
                                            </label>
                                            <label>
                                                <input class="radio-input" type="radio" name="nameGenero" id="idMasculino" value="Masculino" <?php if ($editHonorario['Genero'] == 'Masculino') echo "checked"; ?> required>
                                                <span class="radio-tile">
                                                    <span class="radio-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                            <path d="M289.8 46.8c3.7-9 12.5-14.8 22.2-14.8H424c13.3 0 24 10.7 24 24V168c0 9.7-5.8 18.5-14.8 22.2s-19.3 1.7-26.2-5.2l-33.4-33.4L321 204.2c19.5 28.4 31 62.7 31 99.8c0 97.2-78.8 176-176 176S0 401.2 0 304s78.8-176 176-176c37 0 71.4 11.4 99.8 31l52.6-52.6L295 73c-6.9-6.9-8.9-17.2-5.2-26.2zM400 80l0 0h0v0zM176 416a112 112 0 1 0 0-224 112 112 0 1 0 0 224z" />
                                                        </svg>
                                                    </span>
                                                    <span class="radio-label">Masculino</span>
                                                </span>
                                            </label>
                                        </div>
                                    </center>
                                </div>
                                <br>
                                <div class="observaciones ">
                                    <label>Observaciones</label>
                                    <textarea id="idObserv" name="nameObserv" class="form-control" rows="5" cols="50"><?php echo $editHonorario['Observ'] ?></textarea>
                                </div>
                                <br>
                                <div class="boton">
                                    <button class="Btn2" id="btn-editP" type="submit">Actualizar
                                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <form id="editInfoContactoH" action="./controller/editar_contacto_h.php" method="POST">
                            <input name="editcontra" value="<?php echo $idh ?>" class="form-control" id="idtrabid" hidden>
                            <div class="seccion">
                                <h6 style=" padding-top: 20px !important;">Datos de Contacto</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="idCelular">Celular</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">+56</span>
                                            <input type="text" name="nameCelular" id="idCelular" value="<?php echo $editHonorario['CelularH'] ?>" class="form-control" maxlength="9" oninput="validarCelular(this)">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="idCorreo">Correo Electrónico</label>
                                        <input type="text" name="nameCorreo" id="idCorreo" value="<?php echo $editHonorario['CorreoH'] ?>" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="boton">
                                    <button class="Btn2" id="btn-editC" type="submit">Actualizar
                                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>

                        <div id="editcal">
                            <?php
                            $sqlDec = "SELECT d.IDdecretoH, d.IDLugar, d.IDSector, d.NDecreto, d.FechaDoc, d.RutaCon, d.FechaInicio, d.FechaTermino, l.NombreLug, s.NombreSector, d.Estado, d.TipodeHono
                            FROM decretosh d
                            INNER JOIN lugar l ON (l.IDLugar = d.IDLugar)
                            INNER JOIN sector s ON (s.IDSector = d.IDSector)
                             WHERE IDTraH = $idh";
                            $resultadoDecreto = mysqli_query($conn, $sqlDec);
                            ?>

                            <div class="documentacion seccion seccion-cal">
                                <h6>Decretos</h6>

                                    <table id="decretoshonorarioedit" class="table table-striped table-bordered table-centered table-responsive " style="width:100%">

                                        <thead>
                                            <tr>
                                                <th class="text-center">N° Doc.</th>
                                                <th class="text-center">Fecha Doc.</th>
                                                <th class="text-center">Tipo Honorario</th>
                                                <th class="text-center">Fecha Inicio</th>
                                                <th class="text-center">Fecha Termino</th>
                                                <th class="text-center">Lugar</th>
                                                <th class="text-center">Sector</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Editar</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($decreto = mysqli_fetch_array($resultadoDecreto)) { ?>
                                                <form method="POST" enctype="multipart/form-data" id="edicion_calif_<?php echo $decreto['IDdecretoH'] ?>" class="edicionCalif">
                                                    <input name="idtracal" value="<?php echo $idh ?>" class="form-control" id="idtracal" hidden>
                                                    <tr>

                                                        <td class="align-middle text-center">
                                                            <?php echo $decreto['NDecreto'] ?>
                                                        </td>
                                            
                                                        <td class="align-middle text-center">
                                                            <?php echo date('d-m-Y', strtotime($decreto['FechaDoc'])); ?>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <?php echo $decreto['TipodeHono'] ?>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <?php echo date('d-m-Y', strtotime($decreto['FechaInicio'])); ?>
                                                        </td>

                                                        <td class="align-middle text-center">
                                                            <?php echo date('d-m-Y', strtotime($decreto['FechaTermino'])); ?>
                                                        </td>

                                                       

                                                        <td class="align-middle text-center">
                                                            <?php echo $decreto['NombreLug'] ?>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <?php echo $decreto['NombreSector'] ?>
                                                        </td>

                                                        <td class="align-middle" style="text-align: center; font-weight: 700;">
                                                            <?php
                                                            if ($decreto['Estado'] == 1) {
                                                                echo '<span style="color: #00886f;">Vigente</span>';
                                                            } elseif ($decreto['Estado'] == 2) {
                                                                echo '<span style="color: #ff9900;">Por finalizar</span>';
                                                            } elseif ($decreto['Estado'] == 0) {
                                                                echo '<span style="color: #ff0000;">Finalizado</span>';
                                                            }
                                                            ?>

                                                        </td>


                                                        <td class="text-center">
                                                            <div class="d-flex align-items-center justify-content-around">
                                                                <a href="editar_decreto_h.php?iddh=<?php echo $decreto['IDdecretoH']; ?>" class="btn btn-warning text-black"><i class="fas fa-pen"></i></a>
                                                            </div>
                                                        </td>
                                                </form>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <br>
                            </div>
                        </div>

                        <br>
                        <div id="editcal">
                            <form method="POST" enctype="multipart/form-data" id="edicion_pdfs_h">
                                <input type="hidden" name="nameRutEditar" value="<?php echo $editHonorario['Rut'] ?>">
                                <div class="documentacion seccion seccion-cal">
                                    <h6>Documentación</h6>
                                    <table id="docsEDIT" class="table table-striped table-bordered table-centered" style="width:100%" data-search="true">
                                        <thead>
                                            <tr>
                                                <th class="col-md-5">Nombre</th>
                                                <th class="col-md-2">Documento</th>
                                                <th class="col-md-5">Cambiar o Subir</th>
                                            </tr>
                                        </thead>
                                        <tbody>



                                            <tr>
                                                <td class="align-middle">Certificado de Antecedentes</td>
                                                <td class="align-middle"><?php
                                                                            if (!empty($editHonorario['RutaAntec'])) { ?>
                                                        <div class="contenedor-botones">
                                                            <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $editHonorario['RutaAntec']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $editHonorario['RutaAntec'] ?>" download class="btn btn-primary boton-descargar w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                            <button type="button" class="btn btn-danger w-100 boton-eliminar" onclick="event.preventDefault();elimina_doc_h('RutaAntec', '<?php echo $editHonorario['IDTraH']; ?>')"><i class="fa-solid fa-trash"></i></button>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="contenedor-botones">
                                                            <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="input-group ">
                                                        <input type="file" id="idANTECEinput" name="nameANTECEdocEDIT" class="form-control" accept=".pdf">
                                                        <button class="button" type="button" onclick="clearFileInput('idANTECEinput')" style="width: 40px !important;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle">Fotocopia Cédula de Identidad</td>
                                                <td class="align-middle"><?php
                                                                            if (!empty($editHonorario['RutaCedula'])) { ?>
                                                        <div class="contenedor-botones">
                                                            <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $editHonorario['RutaCedula']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $editHonorario['RutaCedula'] ?>" download class="btn btn-primary boton-descargar w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                            <button type="button" class="btn btn-danger w-100 boton-eliminar" onclick="event.preventDefault(); elimina_doc_h('RutaCedula', '<?php echo $editHonorario['IDTraH']; ?>')"><i class="fa-solid fa-trash"></i></button>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="contenedor-botones">
                                                            <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                        </div>
                                                    <?php   } ?>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="input-group ">
                                                        <input type="file" id="idCedulainput" name="nameCeduladocEDIT" class="form-control" accept=".pdf">
                                                        <button class="button" type="button" onclick="clearFileInput('idCedulainput')" style="width: 40px !important;" style="width: 40px !important;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td class="align-middle">Curriculum Vitae</td>
                                                <td class="align-middle"> <?php
                                                                            if (!empty($editHonorario['RutaCV'])) { ?>
                                                        <div class="contenedor-botones">
                                                            <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $editHonorario['RutaCV']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $editHonorario['RutaCV'] ?>" download class="btn btn-primary boton-descargar w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                            <button type="button" class="btn btn-danger w-100 boton-eliminar" onclick="event.preventDefault(); elimina_doc_h('RutaCV', '<?php echo $editHonorario['IDTraH']; ?>')"><i class="fa-solid fa-trash"></i></button>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="contenedor-botones">
                                                            <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="input-group ">
                                                        <input type="file" id="idCVinput" name="nameCVdocEDIT" class="form-control" accept=".pdf">
                                                        <button class="button" type="button" onclick="clearFileInput('idCVinput')" style="width: 40px !important;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle">Certificado de Estudios o Título Profesional</td>
                                                <td class="align-middle"><?php
                                                                            if (!empty($editHonorario['RutaEstudio'])) { ?>
                                                        <div class="contenedor-botones">
                                                            <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $editHonorario['RutaEstudio']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $editHonorario['RutaEstudio'] ?>" download class="btn btn-primary boton-descargar w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                            <button type="button" class="btn btn-danger w-100 boton-eliminar" onclick="event.preventDefault(); elimina_doc_h('RutaEstudio', '<?php echo $editHonorario['IDTraH']; ?>')"><i class="fa-solid fa-trash"></i></button>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="contenedor-botones">
                                                            <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="input-group ">
                                                        <input type="file" id="idEstudioinput" name="nameEstudiodocEDIT" class="form-control" accept=".pdf">
                                                        <button class="button" type="button" onclick="clearFileInput('idEstudioinput')" style="width: 40px !important;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php if ($editHonorario['Medico'] == 'Si') { ?>
                                                <tr>
                                                    <td class="align-middle">Examen Único Nacional de Conocimientos de Medicina</td>
                                                    <td class="align-middle"><?php
                                                                                if (!empty($editHonorario['RutaExaM'])) { ?>
                                                            <div class="contenedor-botones">
                                                                <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $editHonorario['RutaExaM']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                                <a href="<?php echo $editHonorario['RutaExaM'] ?>" download class="btn btn-primary boton-descargar w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                                <button type="button" class="btn btn-danger w-100 boton-eliminar" onclick="event.preventDefault(); elimina_doc_h('RutaExaM', '<?php echo $editHonorario['IDTraH']; ?>')"><i class="fa-solid fa-trash"></i></button>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="contenedor-botones">
                                                                <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                            </div>

                                                        <?php } ?>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="input-group ">
                                                            <input type="file" id="idExamenMinput" name="nameExaMdocEDIT" class="form-control" accept=".pdf">
                                                            <button class="button" type="button" onclick="clearFileInput('idExamenMinput')" style="width: 40px !important;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr><?php } ?>


                                            <?php if ($editHonorario['Inscripcion'] == 1) { ?>
                                                <tr>
                                                    <td class="align-middle">Certificado de inscripción en el Registro Nacional de Prestadores Individuales</td>
                                                    <td class="align-middle"><?php
                                                                                if (!empty($editHonorario['RutaInscripcion'])) { ?>
                                                            <div class="contenedor-botones">
                                                                <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $editHonorario['RutaInscripcion']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                                <a href="<?php echo $editHonorario['RutaInscripcion'] ?>" download class="btn btn-primary boton-descargar w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                                <button type="button" class="btn btn-danger w-100 boton-eliminar" onclick="event.preventDefault(); elimina_doc_h('RutaInscripcion', '<?php echo $editHonorario['IDTraH']; ?>')"><i class="fa-solid fa-trash"></i></button>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="contenedor-botones">
                                                                <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="input-group ">
                                                            <input type="file" id="idInscripinput" name="nameInscripdocEDIT" class="form-control" accept=".pdf">
                                                            <button class="button" type="button" onclick="clearFileInput('idInscripinput')" style="width: 40px !important;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php } ?>


                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="boton">
                                        <button class="Btn2" id="btnEditaDoc" type="submit">Actualizar
                                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div id="editcal">
                            <?php
                            $sqlinf = "SELECT * FROM informes WHERE IDTraH = $idh";
                            $resultadoInf = mysqli_query($conn, $sqlinf);
                            ?>

                            <div class="documentacion seccion seccion-cal">
                                <h6>Informes de Labores </h6>
                                <div class="alert alert-info">
                                    <strong>¡Importante!</strong> Los informes se guardan individualmente.
                                </div>
                                <div class="" style="overflow-x: auto;">
                                    <table id="calEDIT" class="table table-striped table-bordered table-centered table-responsive " style="width:100%">

                                        <thead>
                                            <tr>
                                                <th class="text-center">Mes</th>
                                                <th class="text-center">Año</th>
                                                <th class="text-center">Función</th>
                                                <th class="text-center">Informe</th>
                                                <th class="text-center">Subir o Cambiar Informe</th>
                                                <th class="text-center">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($mostrar = mysqli_fetch_array($resultadoInf)) { ?>

                                                <form method="POST" enctype="multipart/form-data" id="edicion_informe_<?php echo $mostrar['IDinf'] ?>" class="edicionInforme">
                                                    <input name="idtrah" value="<?php echo $idh ?>" class="form-control" id="idtrah" hidden>
                                                    <tr>
                                                        <!-- MES -->
                                                        <td class="align-middle text-center">
                                                            <select class="form-control" name="namemes_<?php echo $mostrar['IDinf'] ?>" id="selectapelo">
                                                                <option value="Enero" <?php if ($mostrar['mes'] == 'Enero') echo 'selected'; ?>>Enero</option>
                                                                <option value="Febrero" <?php if ($mostrar['mes'] == 'Febrero') echo 'selected'; ?>>Febrero</option>
                                                                <option value="Marzo" <?php if ($mostrar['mes'] == 'Marzo') echo 'selected'; ?>>Marzo</option>
                                                                <option value="Abril" <?php if ($mostrar['mes'] == 'Abril') echo 'selected'; ?>>Abril</option>
                                                                <option value="Mayo" <?php if ($mostrar['mes'] == 'Mayo') echo 'selected'; ?>>Mayo</option>
                                                                <option value="Junio" <?php if ($mostrar['mes'] == 'Junio') echo 'selected'; ?>>Junio</option>
                                                                <option value="Julio" <?php if ($mostrar['mes'] == 'Julio') echo 'selected'; ?>>Julio</option>
                                                                <option value="Agosto" <?php if ($mostrar['mes'] == 'Agosto') echo 'selected'; ?>>Agosto</option>
                                                                <option value="Septiembre" <?php if ($mostrar['mes'] == 'Septiembre') echo 'selected'; ?>>Septiembre</option>
                                                                <option value="Octubre" <?php if ($mostrar['mes'] == 'Octubre') echo 'selected'; ?>>Octubre</option>
                                                                <option value="Noviembre" <?php if ($mostrar['mes'] == 'Noviembre') echo 'selected'; ?>>Noviembre</option>
                                                                <option value="Diciembre" <?php if ($mostrar['mes'] == 'Diciembre') echo 'selected'; ?>>Diciembre</option>

                                                            </select>
                                                        </td>

                                                        <!-- AÑO -->
                                                        <td class="align-middle text-center">
                                                            <input maxlength="4" type="text" class="form-control" value="<?php echo $mostrar['anno'] ?>" name="nameAnno_<?php echo $mostrar['IDinf'] ?>" id="idanno">
                                                        </td>

                                                        <!-- FUNCION -->
                                                        <td class="align-middle text-center">
                                                            <input type="text" class="form-control" value="<?php echo $mostrar['funcion'] ?>" name="nameFuncion_<?php echo $mostrar['IDinf'] ?>" id="idfuncion">
                                                        </td>


                                                        <!-- ARCHIVO -->
                                                        <td class="align-middle text-center">
                                                            <?php if (!empty($mostrar['RutaInforme'])) { ?>
                                                                <center>
                                                                    <div class="contenedor-botones">
                                                                        <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $mostrar['RutaInforme'] ?>', '_blank')">
                                                                            <i class="fa-solid fa-expand"></i>
                                                                        </button>

                                                                        <button type="button" class="btn btn-danger w-100 d-calif " onclick="event.preventDefault(); deleteFileInforme('<?php echo $mostrar['RutaInforme'] ?>', '<?php echo $mostrar['IDinf'] ?>')">
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



                                                        <!-- SUBIR ARCHIVO -->
                                                        <td>
                                                            <div class="input-group custom-input">
                                                                <input type="file" id="IDinfEDIT_<?php echo $mostrar['IDinf'] ?>" name="nameINFORME_<?php echo $mostrar['IDinf'] ?>" class="form-control" accept=".pdf">
                                                                <button class="button" type="button" onclick="clearFileInput('IDinfEDIT_<?php echo $mostrar['IDinf'] ?>')" style="width: 40px !important;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </td>



                                                        <td class="text-center">

                                                            <div class="contenedor-botones">
                                                                <button class="btn btn-primary boton-ver w-100" type="submit" id="guardar-btn">
                                                                    <i class="fas fa-save"></i>
                                                                </button>

                                                                <button type="button" class="btn btn-danger w-100 boton-eliminar-inf d-calif" data-informee="<?php echo $mostrar['IDinf'] ?>">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                </form>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </main>
        </div>
    </div>
    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/elimina.js"></script>
    <script src="./assets/js/doc_exclusivos.js"></script>
    <script src="./assets/js/validaciones_input.js"></script>
    <script src="./assets/js/tablas.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.js"></script>
</body>

</html>
<?php
} else {
    header('Location: home.php');
}
?>

