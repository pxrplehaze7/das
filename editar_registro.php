<?php
include("./controller/config/conexion.php");

// Obtener el rut enviado por POST
if (isset($_POST['nameRutEditar'])) {
    $rut = $_POST['nameRutEditar']; //se asigna el valor del input rut a $rut

    // Realiza la consulta para obtener la información de la persona WHERE el rut de base de datos sea igual al $rut
    $datosEditar = "SELECT cat.NombreCat, con.NombreCon, afp.NombreAFP, pre.NombrePrev, lug.NombreLug, sec.NombreSector, con.IDCon, afp.IDAFP, cat.IDCat, pre.IDPrev, lug.IDLugar, sec.IDSector, IDTra, NombreTra, PaternoTra, MaternoTra, Decreto, Rut, Genero, Profesion, Medico, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaContrato, RutaDJur, RutaSerM, RutaSCom, RutaExaM, Observ, RutaInscripcion
    FROM trabajador tra
    INNER JOIN categoria cat ON (cat.IDCat = tra.IDCat)
    INNER JOIN contrato con ON (con.IDCon = tra.IDCon)
    INNER JOIN afp afp ON (afp.IDAFP = tra.IDAFP)
    INNER JOIN lugar lug ON (lug.IDLugar = tra.IDLugar)
    INNER JOIN sector sec ON (sec.IDSector = tra.IDSector)
    INNER JOIN prevision pre ON (pre.IDPrev = tra.IDPrev)
    WHERE Rut='$rut' LIMIT 1";




    $resultDatosEditar = mysqli_query($conn, $datosEditar);

    // Verificar si se encontró una persona en la base de datos con el valor de $rut
    if (mysqli_num_rows($resultDatosEditar) == 1) {
        // Si se encuentra una persona, se asigna el resultado a $persona
        $persona = mysqli_fetch_assoc($resultDatosEditar);
    }
} ?>
<?php include("./controller/config/conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Información</title>
    <!-- cdn jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- cdn css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- cdn iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- estilo de registro -->
    <link href="./assets/css/styles.css" rel="stylesheet">
    <!-- estilo menu -->
    <link href="./assets/css/menu.css" rel="stylesheet">
    <!-- SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <header>
        <?php include("./controller/navbar.php") ?>
    </header>


    <div class="container-lg">

        <form id="documentosObligatorios" enctype="multipart/form-data" method="POST">
            <div class="title">
                <h1>Editar Información</h1>
            </div>


            <br>
            <div class="seccion-editar">

                <h6>Datos Personales</h6>
                <div class="row ">
                    <div class="col-md">
                        <label for="idRutInput"><span style="color: red;">*</span> Rut</label>
                        <input type="text" name="nameRut" id="idRutInput" value="<?php echo $rut ?>" class="form-control" pattern="^\d{7,8}-[kK\d]$" maxlength="10" required>
                        <div id="rut-validation"></div>
                        <br>
                    </div>
                    <div class="col-md">
                        <label for="idPersona"><span style="color: red;">*</span> Nombres</label>
                        <input type="text" name="namePersona" id="idPersona" value="<?php echo $persona['NombreTra'] ?>" class="form-control" required>
                        <br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md">
                        <label for="idAppat"><span style="color: red;">*</span> Apellido Paterno</label>
                        <input type="text" name="namePaterno" id="idAppat" value="<?php echo $persona['PaternoTra'] ?>" class="form-control" required>
                        <br>
                    </div>
                    <div class="col-md">
                        <label for="idApmat">Apellido Materno</label>
                        <input type="text" name="nameMaterno" id="idApmat" value="<?php echo $persona['MaternoTra'] ?>" class="form-control">
                        <br>
                    </div>
                </div>

                <div class="art">
                    <div class="row">
                        <div class="col-md-6"> <!-- TIPO DE CONTRATO -->
                            <?php
                            $sqlTipoContrato = "SELECT IDCon, NombreCon FROM contrato";
                            $resultadoContrato = mysqli_query($conn, $sqlTipoContrato);

                            echo "<label for='idSelectCon'><span style='color: red;'>*</span> Tipo de Contrato </label>"; //Label 
                            echo "<select name='nameSelectCon' id='idSelectCon' class='form-select' required>";
                            echo '<option value="" hidden>Selecciona un Contrato</option>'; // Opción por defecto en blanco

                            while ($fila = mysqli_fetch_assoc($resultadoContrato)) {
                                $selected = ($fila['IDCon'] == $persona['IDCon']) ? 'selected' : '';
                                echo "<option value='" . $fila['IDCon'] . "' " . $selected . ">" . $fila['NombreCon'] . "</option>";
                            }
                            echo "</select>";
                            ?>
                            <br>
                        </div>

                        <div class="col-md-6"> <!-- CATEGORIA -->
                            <?php
                            $sqlCategoria = "SELECT IDCat, NombreCat FROM categoria";
                            $resultadoCategoria = mysqli_query($conn, $sqlCategoria);
                            echo "<label for='idSelectCat'><span style='color: red;'>*</span> Categoría </label>"; //Label 
                            echo "<select name='nameSelectCat' id='idSelectCat' class='form-select'> required";
                            echo '<option hidden value=""> Selecciona una Categoría</option>'; // Opción por defecto en blan
                            while ($fila = mysqli_fetch_assoc($resultadoCategoria)) {
                                $selected = ($fila['IDCat'] == $persona['IDCat']) ? 'selected' : '';
                                echo "<option value='" . $fila['IDCat'] . "' " . $selected . ">" . $fila['NombreCat'] . "</option>";
                            }
                            echo "</select>";
                            ?>
                            <br>
                        </div>
                        <br>
                    </div>


                    <?php if ($persona['IDCat'] == 1) { ?>
                        <div id="idPreguntaCat1" class="radioCentro row">
                            <center>
                                <label><span style="color: red;">*</span> ¿Es médico?</label>
                                <div class="radio-inputs">
                                    <label>
                                        <input type="radio" name="nameMedico" id="idSiMedico" value="Si" class="radio-input" <?php if ($persona['Medico'] == 'Si') echo "checked"; ?>>
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
                                        <input type="radio" name="nameMedico" id="idNoMedico" value="No" class="radio-input" <?php if ($persona['Medico'] == 'No') echo "checked"; ?>>
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
                    <?php } ?>





                    <br>
                    <div class="row">
                        <div class="col-md-6"> <!-- LUGAR -->
                            <label for="idSelectLugar"><span style="color: red;">*</span> Lugar</label>
                            <select name="nameSelectLugar" id="idSelectLugar" class="form-select" required onchange="cargarSectores()">
                                <option value="" hidden>Selecciona un Lugar</option>
                                <?php
                                $sqlLugar = "SELECT IDLugar, NombreLug FROM lugar";
                                $resultadoLugar = mysqli_query($conn, $sqlLugar);
                                while ($fila = mysqli_fetch_assoc($resultadoLugar)) {
                                    $selected = ($fila['IDLugar'] == $persona['IDLugar']) ? "selected" : "";
                                    echo "<option value='" . $fila['IDLugar'] . "' $selected>" . $fila['NombreLug'] . "</option>";
                                }
                                ?>
                            </select>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <label for="idSelectSector"><span style="color: red;">*</span> Sector</label>
                            <select name="nameSelectSector" id="idSelectSector" class="form-select" required>
                                <option value="" hidden>Selecciona un Sector</option>
                                <?php
                                $sqlSector = "SELECT IDSector, NombreSector FROM sector";
                                $resultadoSector = mysqli_query($conn, $sqlSector);
                                while ($fila = mysqli_fetch_assoc($resultadoSector)) {
                                    $selected = ($fila['IDSector'] == $persona['IDSector']) ? "selected" : "";
                                    echo "<option value='" . $fila['IDSector'] . "' $selected>" . $fila['NombreSector'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="idProfesion"><span style="color: red;">*</span> Profesión</label>
                        <input type="text" name="nameProfesion" id="idProfesion" value="<?php echo $persona['Profesion'] ?>" class="form-control" require>
                    </div>
                </div>

                <br>
             


                <div class="radioCentro row">
                    <center>
                        <label><span style="color: red;">*</span> Seleccione Género</label>

                        <div class="radio-inputs">
                            <label>
                                <input class="radio-input" type="radio" name="nameGenero" id="idFemenino" value="Femenino" <?php if ($persona['Genero'] == 'Femenino') echo "checked"; ?> required">
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
                                <input class="radio-input" type="radio" name="nameGenero" id="idMasculino" value="Masculino" <?php if ($persona['Genero'] == 'Masculino') echo "checked"; ?> required>
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






            </div>
            <br>
            <div class="seccion-editar">
                <h6>Datos de Contacto</h6>
                <div class="row">
                    <div class="col-6">
                        <label for="idCelular">Celular</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">+56</span>
                            <input type="text" name="nameCelular" id="idCelular" value="<?php echo $persona['CelularTra'] ?>" class="form-control" maxlength="9">
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="idCorreo">Correo Electrónico</label>
                        <input type="text" name="nameCorreo" id="idCorreo" value="<?php echo $persona['CorreoTra'] ?>" class="form-control" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
                    </div>
                </div>
            </div>
            <br>

            <div class="seccion-editar">
                <h6>Documentación</h6>

                <div class="doc-editar"><!-- AFP -->
                    <center><label for="afp">Certificado de Afiliación AFP</label></center>
                    <div class="row" id="afp"> <!-- AFP -->
                        <div class="col-md-3">
                            <label>AFP</label>
                            <?php
                            $sqlAFP = "SELECT IDAFP, NombreAFP FROM afp";
                            $resultadoAFP = mysqli_query($conn, $sqlAFP);
                            echo "<select name='nameSelectAFP' id='idSelectAFP' class='form-select' required>";
                            echo '<option value=1 hidden> Selecciona</option>'; // Opción por defecto en blanco
                            while ($fila = mysqli_fetch_assoc($resultadoAFP)) {
                                $selected = ($fila['IDAFP'] == $persona['IDAFP']) ? 'selected' : '';
                                echo "<option value='" . $fila['IDAFP'] . "' " . $selected . ">" . $fila['NombreAFP'] . "</option>";
                            }
                            echo "</select>";
                            ?>
                        </div>

                        <div class="col-md-3">
                            <?php
                            if (!empty($persona['RutaAFP'])) {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button class="btn btn-primary boton-ver w-100" onclick="window.open(\'' . $persona['RutaAFP'] . '\', \'_blank\')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="' . $persona['RutaAFP'] . '" download class="btn btn-primary boton-descargar w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>';
                            } else {
                                echo '
                                <label>Documento</label>
                                                <div class=" contenedor-botones">
                                                    <button disabled class="btn btn-primary pendiente w-100">Pendiente <i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>';
                            } ?>
                        </div>
                        <div class="col-md-6">
                            <center><label for="idAFPinput">Actualizar</label></center>
                            <div class="input-group">
                                <input type="file" id="idAFPinput" name="nameAFPdoc" class="form-control" accept=".pdf">
                                <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idAFPinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>


                    </div>
                </div>

                <br>

                <div class="doc-editar"><!-- PREVISION -->
                    <center><label for="prevision">Certificado de Afiliación a Previsión</label></center>
                    <div class="row" id="prevision"> <!-- PREVISION -->
                        <div class="col-md-3">
                            <label>Previsión</label>
                            <?php
                            $sqlPrevision = "SELECT IDPrev, NombrePrev FROM prevision";
                            $resultadoPrevision = mysqli_query($conn, $sqlPrevision);
                            echo "<select name='nameSelectPrev' id='idSelectPrev' class='form-select' required>";
                            echo '<option value="" hidden> Selecciona</option>'; // Opción por defecto en blanco

                            while ($fila = mysqli_fetch_assoc($resultadoPrevision)) {
                                $selected = ($fila['IDPrev'] == $persona['IDPrev']) ? 'selected' : '';
                                echo "<option value='" . $fila['IDPrev'] . "' " . $selected . ">" . $fila['NombrePrev'] . "</option>";
                            }
                            echo "</select>";
                            ?>
                        </div>

                        <div class="col-md-3">
                            <?php
                            if (!empty($persona['RutaPrev'])) {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button class="btn btn-primary boton-ver w-100" onclick="window.open(\'' . $persona['RutaPrev'] . '\', \'_blank\')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="' . $persona['RutaPrev'] . '" download class="btn btn-primary boton-descargar w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>';
                            } else {
                                echo '
                                <label>Documento</label>
                                                <div class=" contenedor-botones">
                                                    <button disabled class="btn btn-primary pendiente w-100">Pendiente <i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>';
                            } ?>
                        </div>


                        <div class="col-md-6">
                            <center><label for="idPREVinput">Actualizar</label></center>
                            <div class="input-group">
                                <input type="file" id="idPREVinput" name="namePREVdoc" class="form-control" accept=".pdf">
                                <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idPREVinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>


                    </div>
                </div>

                <br>

                <div class="doc-editar"><!-- DECRETO Y CONTRATO -->
                    <center><label>N° Decreto y Contrato</label></center>
                    <div class="row" id="decreto">
                        <div class="col-md-3">
                            <label>Decreto</label>
                            <input type="text" name="nameDecreto" id="idDecreto" value="<?php echo $persona['Decreto'] ?>" class="form-control" maxlength="30">
                        </div>

                        <div class="col-md-3">
                            <?php
                            if (!empty($persona['RutaContrato'])) {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button class="btn btn-primary w-100 boton-ver" onclick="window.open(\'' . $persona['RutaContrato'] . '\', \'_blank\')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="' . $persona['RutaContrato'] . '" download class="btn btn-primary w-100 boton-descargar"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>';
                            } else {
                                echo '<label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary w-100 pendiente">Pendiente <i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>';
                            } ?>

                        </div>

                        <div class="col-md-6">
                            <label>Actualizar</label>
                            <div class="input-group">
                                <input type="file" id="idDocContratoInput" name="nameDocContratoInput" class="form-control" accept=".pdf">
                                <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idDocContratoInput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>



                    </div>
                </div>

                <br>

                <div class="doc-editar"><!-- NACIMIENTO -->
                    <center><label for="nacimiento"> Certificado de Nacimiento</label></center>
                    <div class="row" id="nacimiento">

                        <div class="col-md-6">
                            <?php
                            if (!empty($persona['RutaNac'])) {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button class="btn btn-primary w-100 boton-ver" onclick="window.open(\'' . $persona['RutaNac'] . '\', \'_blank\')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="' . $persona['RutaNac'] . '" download class="btn btn-primary w-100 boton-descargar"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>';
                            } else {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary w-100 pendiente">Pendiente <i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>';
                            } ?>
                        </div>
                        <div class="col-md-6">
                            <label>Actualizar</label>
                            <div class="input-group ">

                                <input type="file" id="idNACinput" name="nameNACdoc" class="form-control" accept=".pdf">
                                <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idNACinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="doc-editar"><!-- ANTECEDENTES -->
                    <center><label for="antecedentes"> Certificado de Antecedentes</label></center>
                    <div class="row" id="antecedentes">

                        <div class="col-md-6">
                            <?php
                            if (!empty($persona['RutaAntec'])) {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button class="btn btn-primary w-100 boton-ver" onclick="window.open(\'' . $persona['RutaAntec'] . '\', \'_blank\')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="' . $persona['RutaAntec'] . '" download class="btn btn-primary w-100 boton-descargar"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>';
                            } else {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary w-100 pendiente">Pendiente <i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>';
                            } ?>
                        </div>
                        <div class="col-md-6">
                            <label>Actualizar</label>
                            <div class="input-group ">
                                <input type="file" id="idANTECEinput" name="nameANTECEdoc" class="form-control" accept=".pdf">
                                <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idANTECEinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>



                <div class="doc-editar"><!-- CEDULA -->
                    <center><label for="cedula"> Fotocopia Cédula de Identidad </label></center>
                    <div class="row" id="cedula">

                        <div class="col-md-6">
                            <?php
                            if (!empty($persona['RutaCedula'])) {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button class="btn btn-primary w-100 boton-ver" onclick="window.open(\'' . $persona['RutaCedula'] . '\', \'_blank\')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="' . $persona['RutaCedula'] . '" download class="btn btn-primary w-100 boton-descargar"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>';
                            } else {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary w-100 pendiente">Pendiente <i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>';
                            } ?>
                        </div>
                        <div class="col-md-6">
                            <label>Actualizar</label>
                            <div class="input-group ">
                                <input type="file" id="idCedulainput" name="nameCeduladoc" class="form-control" accept=".pdf">
                                <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idCedulainput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="doc-editar"><!-- CEDULA -->
                    <center><label for="cv"> Curriculum Vitae </label></center>
                    <div class="row" id="cv">

                        <div class="col-md-6">
                            <?php
                            if (!empty($persona['RutaCV'])) {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button class="btn btn-primary w-100 boton-ver" onclick="window.open(\'' . $persona['RutaCV'] . '\', \'_blank\')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="' . $persona['RutaCV'] . '" download class="btn btn-primary w-100 boton-descargar"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>';
                            } else {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary w-100 pendiente">Pendiente <i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>';
                            } ?>
                        </div>
                        <div class="col-md-6">
                            <label>Actualizar</label>
                            <div class="input-group ">
                                <input type="file" id="idCVinput" name="nameCVdoc" class="form-control" accept=".pdf">
                                <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idCVinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="doc-editar"><!-- ESTUDIOS -->
                    <center><label for="estudios"> Certificado de Estudios o Título Profesional </label></center>
                    <div class="row" id="estudios">

                        <div class="col-md-6">
                            <?php
                            if (!empty($persona['RutaEstudio'])) {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button class="btn btn-primary w-100 boton-ver" onclick="window.open(\'' . $persona['RutaEstudio'] . '\', \'_blank\')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="' . $persona['RutaEstudio'] . '" download class="btn btn-primary w-100 boton-descargar"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>';
                            } else {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary w-100 pendiente">Pendiente <i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>';
                            } ?>
                        </div>
                        <div class="col-md-6">
                            <label>Actualizar</label>
                            <div class="input-group ">
                                <input type="file" id="idEstudioinput" name="nameEstudiodoc" class="form-control" accept=".pdf">
                                <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idEstudioinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="doc-editar"><!-- DECLARACION -->
                    <center><label for="declaracion"> Declaración Jurada </label></center>
                    <div class="row" id="declaracion">

                        <div class="col-md-6">
                            <?php
                            if (!empty($persona['RutaDJur'])) {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button class="btn btn-primary w-100 boton-ver" onclick="window.open(\'' . $persona['RutaDJur'] . '\', \'_blank\')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="' . $persona['RutaDJur'] . '" download class="btn btn-primary w-100 boton-descargar"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>';
                            } else {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary w-100 pendiente">Pendiente <i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>';
                            } ?>
                        </div>
                        <div class="col-md-6">
                            <label>Actualizar</label>
                            <div class="input-group ">
                                <input type="file" id="idDJuradainput" name="nameDJuradadoc" class="form-control" accept=".pdf">
                                <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idDJuradainput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="doc-editar"><!-- SALUD COMPATIBLE -->
                    <center><label for="saludCompat"> Certificado de Salud Compatible </label></center>
                    <div class="row" id="saludCompat">

                        <div class="col-md-6">
                            <?php
                            if (!empty($persona['RutaSCom'])) {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button class="btn btn-primary w-100 boton-ver" onclick="window.open(\'' . $persona['RutaSCom'] . '\', \'_blank\')"><i class="fa-solid fa-expand"></i></button>
                                                    <a href="' . $persona['RutaSCom'] . '" download class="btn btn-primary w-100 boton-descargar"><i class="fa-sharp fa-solid fa-download"></i></a>
                                                </div>';
                            } else {
                                echo '
                                <label>Documento</label>
                                                <div class="contenedor-botones">
                                                    <button disabled class="btn btn-primary w-100 pendiente">Pendiente <i class="fa-sharp fa-solid fa-clock"></i></button>
                                                </div>';
                            } ?>
                        </div>
                        <div class="col-md-6">
                            <label>Actualizar</label>
                            <div class="input-group ">
                                <input type="file" id="idSCompatibleinput" name="nameSCompatibledoc" class="form-control" accept=".pdf">
                                <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idSCompatibleinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>


            </div><!--fin seccion editar-->


            <div id="examenMedico">
                <br>
                <label for="idExamenMinput">Examen Médico Unico Nacional</label>
                <div class="input-group ">
                    <input type="file" id="idExamenMinput" name="nameExaMdoc" class="form-control" accept=".pdf">
                    <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idExamenMinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
            <br>


            <br>

            <br>
            <div>
                <label for="idSCompatibleinput">Certificado de Salud Compatible</label>
                <div class="input-group ">
                    <input type="file" id="idSCompatibleinput" name="nameSCompatibledoc" class="form-control" accept=".pdf">
                    <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idSCompatibleinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
            <br>
            <div id="servicioMilitarHombre">
                <label for="idMilitarDoc">Certificado de Servicio Militar Obligatorio al día</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="idMilitarDoc" name="nameMilitarDoc" accept=".pdf">
                    <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idMilitarDoc')">Limpiar <i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
            <br>
    </div>
    <br>
    <div class="observaciones seccion-editar">
        <h6>Observaciones</h6>
        <textarea id="idObserv" name="nameObserv" class="form-control" rows="5" maxlength="1000"><?php echo $observ ?></textarea>
    </div>
    <br>
    <div class="boton">
        <button class="btn btn-enviar" type="submit">Registrar <i class="fa-solid fa-floppy-disk"></i></button>
    </div>
    </form>
    </div>

    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/doc_exclusivos.js"></script>

    <!-- cdn js de boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>