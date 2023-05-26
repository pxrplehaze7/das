<?php
include("./controller/config/conexion.php");

// Obtener el rut enviado por POST
if (isset($_POST['nameRutEditar'])) {
    $rut = $_POST['nameRutEditar']; //se asigna el valor del input rut a $rut

    // Realiza la consulta para obtener la información de la persona WHERE el rut de base de datos sea igual al $rut
    $datosEditar = "SELECT cat.NombreCat, con.NombreCon, afp.NombreAFP, pre.NombrePrev, lug.NombreLug, sec.NombreSector, con.IDCon, afp.IDAFP, cat.IDCat, pre.IDPrev, lug.IDLugar, sec.IDSector, IDTra, NombreTra, PaternoTra, MaternoTra, Inscripcion, Decreto, Rut, Genero, Profesion, Medico, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaContrato, RutaDJur, RutaSerM, RutaSCom, RutaExaM, Observ, RutaInscripcion
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <?php require("./components/navbar.php") ?>
        <?php require("./components/sidebar.html") ?>


        <div id="layoutSidenav_content">
            <main>
                <?php if (isset($persona)) { ?>
                    <div class="container-md">

                        <form id="editInfoPersonal" action="./controller/editInfoP.php" method="POST">
                            <div class="title">
                                <h1 class="mt-4">Editar Información
                                    <input name="rutInicio" value="<?php echo $rut ?>" class="form-control" hidden>
                                </h1>
                            </div>
                            <br>
                            <div class="seccion">

                                <h6>Datos Personales</h6>
                                <div class="row ">
                                    <div class="col-md">
                                        <label for="idRutInput"><span style="color: red;">*</span> Rut</label>
                                        <input type="text" name="RutInput" id="idRutInput" value="<?php echo $rut ?>" class="form-control" pattern="^\d{7,8}-[kK\d]$" maxlength="10" required>
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


                                    <div id="idInscripcion" class="radioCentro row">
                                        <center>
                                            <label><span style="color: #f36f03;">*</span> ¿Debe presentar Certificado de Inscripción?</label>

                                            <div class="radio-inputs">
                                                <label>
                                                    <input type="radio" name="nameInscrip" id="idSiInscrip" value=1 class="radio-input" <?php if ($persona['Inscripcion'] == 1) echo "checked"; ?>>
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
                                                    <input type="radio" name="nameInscrip" id="idNoInscrip" value=0 class="radio-input" <?php if ($persona['Inscripcion'] == 0) echo "checked"; ?>>
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
                                <br>
                                <div class="boton">
                                    <button class="btn btn-enviar" type="submit">Actualizar Información <i class="fa-solid fa-arrows-rotate"></i></button>
                                </div>
                            </div>


                        </form>
                        <br>
                        <form id="editInfoContacto" action="./controller/editContacto.php" method="POST">
                        <input name="rutInicio" value="<?php echo $rut ?>" class="form-control" hidden>
                            <div class="seccion">
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
                                <br>
                                <div class="boton">
                                    <button class="btn btn-enviar" type="submit">Actualizar Contacto <i class="fa-solid fa-arrows-rotate"></i></button>
                                </div>
                            </div>
                        </form>

                        <br>

                        <form method="POST" action="editar_pdfs.php" enctype="multipart/form-data" id="edicion_pdfs">
                            <div class="documentacion seccion">
                                <h6>Documentación</h6>
                                <table id="docs" class="display table table-striped table-light table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Cambiar o Subir</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="align-middle">
                                                <div class="row">
                                                    <div class="col-md-6">N° de Decreto</div>
                                                    <div class="col-md-6"><input value="<?php echo $persona['Decreto'] ?>" class="form-control"></div>
                                                </div>
                                            </td>
                                            <td class="align-middle"><?php include('./controller/consulta_archivo/contrato.php') ?></td>
                                            <td>a</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Declaración Jurada</td>
                                            <td class="align-middle"><?php include('./controller/consulta_archivo/declaracionJ.php') ?></td>
                                            <td>a</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Certificado de Nacimiento</td>
                                            <td class="align-middle"><?php include('./controller/consulta_archivo/certificadoNac.php') ?></td>
                                            <td>
                                                <div class="input-group ">
                                                    <input type="file" id="idNACinputEDIT" name="nameNACdocEDIT" class="form-control" accept=".pdf">
                                                    <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idNACinputEDIT')"><i class="fa-solid fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Certificado de Antecedentes</td>
                                            <td class="align-middle"><?php include('./controller/consulta_archivo/antecedentes.php') ?></td>
                                            <td>
                                                <div class="input-group ">
                                                    <input type="file" id="idANTECEinputEDIT" name="nameANTECEdocEDIT" class="form-control" accept=".pdf">
                                                    <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idANTECEinputEDIT')"><i class="fa-solid fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Fotocopia de Cédula de Identidad</td>
                                            <td class="align-middle"><?php include('./controller/consulta_archivo/fotocopiaCedula.php') ?></td>
                                            <td>a</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Curriculum Vitae</td>
                                            <td class="align-middle"><?php include('./controller/consulta_archivo/curriculum.php') ?></td>
                                            <td>a</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Certificado de Estudios o Título Profesional</td>
                                            <td class="align-middle"><?php include('./controller/consulta_archivo/estudios.php') ?></td>
                                            <td>a</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Certificado de Salud Compatible</td>
                                            <td class="align-middle"><?php include('./controller/consulta_archivo/saludCompatible.php') ?></td>
                                            <td>a</td>
                                        </tr>

                                        <tr>

                                            <td class="align-middle">
                                                <div class="row">
                                                    <div class="col-md-6">Certificado de Afiliacion a AFP</div>
                                                    <div class="col-md-6"> <?php
                                                                            $sqleditafp = "SELECT IDAFP, NombreAFP FROM afp";
                                                                            $resultadoeditafp = mysqli_query($conn, $sqleditafp);
                                                                            echo "<select name='nameSelectAFP' id='idSelectAFP' class='form-select' required>";
                                                                            while ($fila = mysqli_fetch_assoc($resultadoeditafp)) {
                                                                                $selected = ($fila['IDAFP'] == $persona['IDAFP']) ? 'selected' : '';
                                                                                echo "<option value='" . $fila['IDAFP'] . "' " . $selected . ">" . $fila['NombreAFP'] . "</option>";
                                                                            }
                                                                            echo "</select>";
                                                                            ?></div>
                                                </div>
                                            </td>
                                            <td class="align-middle"><?php if ($persona['IDAFP'] != 1) {
                                                                            include('./controller/consulta_archivo/afp.php');
                                                                        } ?></td>
                                            <td>a</td>
                                        </tr>


                                        <tr>
                                            <td class="align-middle">
                                                <div class="row">
                                                    <div class="col-md-6">Certificado de Afiliacion Previsional</div>
                                                    <div class="col-md-6"> <?php
                                                                            $sqleditprev = "SELECT IDPrev, NombrePrev FROM prevision";
                                                                            $resultadoeditprev = mysqli_query($conn, $sqleditprev);
                                                                            echo "<select name='nameSelectPrev' id='idSelectPrev' class='form-select' required>";
                                                                            while ($fila = mysqli_fetch_assoc($resultadoeditprev)) {
                                                                                $selected = ($fila['IDPrev'] == $persona['IDPrev']) ? 'selected' : '';
                                                                                echo "<option value='" . $fila['IDPrev'] . "' " . $selected . ">" . $fila['NombrePrev'] . "</option>";
                                                                            }
                                                                            echo "</select>";
                                                                            ?></div>
                                                </div>
                                            </td>
                                            <td class="align-middle"><?php if ($persona['IDPrev'] != 1) {
                                                                            include('./controller/consulta_archivo/prevision.php');
                                                                        } ?></td>
                                            <td>a</td>
                                        </tr>



                                        <?php if ($persona['Inscripcion'] == 1) { ?>
                                            <tr>
                                                <td class="align-middle">Certificado de inscripción en el Registro Nacional de Prestadores Individuales</td>
                                                <td class="align-middle"><?php include('./controller/consulta_archivo/inscripcion.php') ?></td>
                                                <td>a</td>
                                            </tr> <?php } ?>


                                        <?php if ($persona['Medico'] == 'Si') { ?>
                                            <tr>
                                                <td class="align-middle">Examen Único Nacional de Conocimientos de Medicina</td>
                                                <td class="align-middle"><?php include('./controller/consulta_archivo/examenMedico.php') ?></td>
                                                <td>a</td>
                                            </tr> <?php } ?>

                                        <?php if ($persona['Genero'] == 'Masculino') { ?>
                                            <tr>
                                                <td class="align-middle">Certificado de Servicio Militar al Día</td>
                                                <td class="align-middle"><?php include('./controller/consulta_archivo/servicioMilitar.php') ?></td>
                                                <td>a</td>
                                            </tr> <?php } ?>

                                    </tbody>
                                </table>


                            </div><!--fin seccion editar-->
                        </form>

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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


</body>

</html>