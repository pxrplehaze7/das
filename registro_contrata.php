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
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Registro</title>
    <link rel="icon" type="image/png" href="./assets/img/favicon-32x32.png">
    <link href="./assets/styles/styles.css" rel="stylesheet" />
    <link href="./assets/styles/form.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php require("./components/navbar.php") ?>
    <div id="layoutSidenav">
        <?php require("./components/sidebar.php") ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-md">
                    <form id="documentosObligatorios" enctype="multipart/form-data" method="POST" autocomplete="off">
                        <div class="title">
                            <h1 class="mt-4">Registro de trabajador a Contrata e Indefinido</h1>
                        </div>
                        <br>
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-exclamation-circle"></i>
                            <strong>¡Importante!</strong> Decreto se registra en el siguiente paso.
                        </div>
                        <div class="seccion">
                            <h6 style="padding-top: 20px !important;">Datos Personales</h6>
                            <div class="row ">
                                <div class="col-md">
                                    <label for="idRutInput"><span style="color: #f36f03;">*</span> Rut</label>
                                    <input type="text" name="nameRut" id="idRutInput" placeholder="19876543-K" class="form-control" maxlength="10" required>
                                    <div id="rut-validation"></div>
                                    <br>
                                </div>
                                <div class="col-md">
                                    <label for="idPersona"><span style="color: #c40055;">*</span> Nombres</label>
                                    <input type="text" name="namePersona" id="idPersona" placeholder="Ingrese Nombres" class="form-control" oninput="validarTexto(this)" required>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label for="idAppat"><span style="color: #c40055;">*</span> Apellido Paterno</label>
                                    <input type="text" name="namePaterno" id="idAppat" placeholder="Ingrese Apellido" class="form-control" oninput="validarTexto(this)" required>
                                    <br>
                                </div>
                                <div class="col-md">
                                    <label for="idApmat">Apellido Materno</label>
                                    <input type="text" name="nameMaterno" id="idApmat" placeholder="Ingrese Apellido" class="form-control" oninput="validarTexto(this)">
                                    <br>
                                </div>
                            </div>
                            <div class="art">
                                <div class="row">
                                    <div class="col-md-6"> <!-- CATEGORIA -->
                                        <?php
                                        $sqlCategoria = "SELECT IDCat, NombreCat FROM categoria";
                                        $resultadoCategoria = mysqli_query($conn, $sqlCategoria);
                                        echo "<label for='idSelectCat'><span style='color: #c40055;'>*</span> Categoría </label>";
                                        echo "<select name='nameSelectCat' id='idSelectCat' class='form-select' required>";
                                        echo '<option hidden value=""> Selecciona</option>';
                                        while ($fila = mysqli_fetch_assoc($resultadoCategoria)) {
                                            echo "<option value='" . $fila['IDCat'] . "'>" . $fila['NombreCat'] . "</option>";
                                        }
                                        echo "</select>";
                                        ?>
                                        <br>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="idProfesion"><span style="color: #c40055;">*</span> Profesión</label>
                                        <input type="text" name="nameProfesion" id="idProfesion" class="form-control" required>
                                    </div>
                                </div>
                                <div id="idInscripcion" class="radioCentro row">
                                    <center>
                                        <label><span style="color: #c40055;">*</span> ¿Debe presentar Certificado de Inscripción?</label>
                                        <div class="radio-inputs">
                                            <label>
                                                <input type="radio" name="nameInscrip" id="idSiInscrip" value=1 class="radio-input">
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
                                                <input type="radio" name="nameInscrip" id="idNoInscrip" value=0 class="radio-input">
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
                                <div id="idPreguntaCat1" style="display:none;" class="radioCentro row">
                                    <center>
                                        <label><span style="color: #c40055;">*</span> ¿Es médico?</label>
                                        <div class="radio-inputs">
                                            <label>
                                                <input type="radio" name="nameMedico" id="idSiMedico" value="Si" class="radio-input">
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
                                                <input type="radio" name="nameMedico" id="idNoMedico" value="No" class="radio-input">
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
                            </div>
                            <br>
                            <div class="radioCentro row">
                                <center>
                                    <label><span style="color: #c40055;">*</span> Seleccione Género</label>
                                    <div class="radio-inputs">
                                        <label>
                                            <input class="radio-input" type="radio" name="nameGenero" id="idFemenino" value="Femenino" required">
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
                                            <input class="radio-input" type="radio" name="nameGenero" id="idMasculino" value="Masculino" required>
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
                        <div class="seccion">
                            <h6 style="padding-top: 20px !important;">Datos de Contacto</h6>
                            <div class="row">
                                <div class="col-6">
                                    <label for="idCelular">Celular</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">+56</span>
                                        <input type="text" name="nameCelular" id="idCelular" placeholder="987654321" class="form-control" maxlength="9" oninput="validarCelular(this)">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="idCorreo">Correo Electrónico</label>
                                    <input type="text" name="nameCorreo" id="idCorreo" placeholder="correo@daschiguayante.cl" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="seccion">
                            <h6 style="padding-top: 20px !important;">Documentación</h6>
                            <div class="row document" id="afp"> <!-- AFP -->
                                <div class=" col-md-3">
                                    <?php
                                    $sqlAFP = "SELECT IDAFP, NombreAFP FROM afp";
                                    $resultadoAFP = mysqli_query($conn, $sqlAFP);
                                    echo "<label for='idSelectAFP'><span style='color: #c40055;'>*</span> AFP </label>";
                                    echo "<select name='nameSelectAFP' id='idSelectAFP' class='form-select' required>";
                                    echo '<option value="" hidden> Selecciona</option>';

                                    while ($fila = mysqli_fetch_assoc($resultadoAFP)) {
                                        echo "<option value='" . $fila['IDAFP'] . "'>" . $fila['NombreAFP'] . "</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </div>
                                <div class="col-md-9">
                                    <label for="idAFPinput"><span style="color: #c40055;">*</span> Certificado de Afiliación a AFP</label>
                                    <div class="input-group">
                                        <input type="file" id="idAFPinput" name="nameAFPdoc" class="form-control" accept=".pdf">

                                        <button class="button" type="button" onclick="clearFileInput('idAFPinput')">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row document" id="prevision"> <!-- PREVISION -->
                                <div class=" col-md-3">
                                    <?php
                                    $sqlPrevision = "SELECT IDPrev, NombrePrev FROM prevision";
                                    $resultadoPrevision = mysqli_query($conn, $sqlPrevision);
                                    echo "<label for='idSelectCat'><span style='color: #c40055;'>*</span> Previsión </label>";
                                    echo "<select name='nameSelectPrev' id='idSelectPrev' class='form-select' required>";
                                    echo '<option hidden value=""> Selecciona</option>';
                                    while ($fila = mysqli_fetch_assoc($resultadoPrevision)) {
                                        echo "<option value='" . $fila['IDPrev'] . "'>" . $fila['NombrePrev'] . "</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </div>
                                <div class="col-md-9">
                                    <label for="idPREVinput"><span style="color: #c40055;">*</span> Certificado de Afiliación a Previsión</label>
                                    <div class="input-group">
                                        <input type="file" id="idPREVinput" name="namePREVdoc" class="form-control" accept=".pdf">
                                        <button class="button" type="button" onclick="clearFileInput('idPREVinput')">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="document" id="nacimiento">
                                <label for="idNACinput"><span style="color: #c40055;">*</span> Certificado de Nacimiento</label>
                                <div class="input-group ">
                                    <input type="file" id="idNACinput" name="nameNACdoc" class="form-control" accept=".pdf">
                                    <button class="button" type="button" onclick="clearFileInput('idNACinput')">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button>
                                </div>
                                <br>
                            </div>
                            <div class="document">
                                <label for="idANTECEinput"><span style="color: #c40055;">*</span> Certificado de Antecedentes</label>
                                <div class="input-group ">
                                    <input type="file" id="idANTECEinput" name="nameANTECEdoc" class="form-control" accept=".pdf">
                                    <button class="button" type="button" onclick="clearFileInput('idANTECEinput')">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button>
                                </div>
                                <br>
                            </div>
                            <div class="document">
                                <label for="idCedulainput"><span style="color: #c40055;">*</span> Fotocopia Cédula de Identidad</label>
                                <div class="input-group ">
                                    <input type="file" id="idCedulainput" name="nameCeduladoc" class="form-control" accept=".pdf">

                                    <button class="button" type="button" onclick="clearFileInput('idCedulainput')">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button>
                                </div>
                                <br>
                            </div>
                            <div class="document" id="cv">
                                <label for="idCVinput"><span style="color: #c40055;">*</span> Curriculum Vitae</label>
                                <div class="input-group ">
                                    <input type="file" id="idCVinput" name="nameCVdoc" class="form-control" accept=".pdf">
                                    <button class="button" type="button" onclick="clearFileInput('idCVinput')">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button>
                                </div>
                                <br>
                            </div>
                            <div class="document" id="examenMedico">
                                <label for="idExamenMinput"><span style="color: #c40055;">*</span> Examen Médico Unico Nacional</label>
                                <div class="input-group ">
                                    <input type="file" id="idExamenMinput" name="nameExaMdoc" class="form-control" accept=".pdf">
                                    <button class="button" type="button" onclick="clearFileInput('idExamenMinput')">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button>
                                </div>
                                <br>
                            </div>
                            <div class="document" id="inscripcionMedico">
                                <label for="idInscripinput"><span style="color: #c40055;">*</span> Certificado de inscripción en el Registro Nacional de Prestadores Individuales</label>
                                <div class="input-group ">
                                    <input type="file" id="idInscripinput" name="nameInscripdoc" class="form-control" accept=".pdf">

                                    <button class="button" type="button" onclick="clearFileInput('idInscripinput')">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button>
                                </div>
                                <br>
                            </div>
                            <div class="document">
                                <label for="idEstudioinput"><span style="color: #c40055;">*</span> Certificado de Estudios o Título Profesional</label>
                                <div class="input-group ">
                                    <input type="file" id="idEstudioinput" name="nameEstudiodoc" class="form-control" accept=".pdf">
                                    <button class="button" type="button" onclick="clearFileInput('idEstudioinput')">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button>
                                </div>
                                <br>
                            </div>
                            <div class="document" id="declaraciondoc">
                                <label for="idDJuradainput"><span style="color: #c40055;">*</span> Declaración Jurada</label>
                                <div class="input-group ">
                                    <input type="file" id="idDJuradainput" name="nameDJuradadoc" class="form-control" accept=".pdf">
                                    <button class="button" type="button" onclick="clearFileInput('idDJuradainput')">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button>
                                </div>
                                <br>
                            </div>
                            <div class="document" id="saludcomdoc">
                                <label for="idSCompatibleinput"><span style="color: #c40055;">*</span> Certificado de Salud Compatible</label>
                                <div class="input-group ">
                                    <input type="file" id="idSCompatibleinput" name="nameSCompatibledoc" class="form-control" accept=".pdf">
                                    <button class="button" type="button" onclick="clearFileInput('idSCompatibleinput')">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button>
                                </div>
                                <br>
                            </div>
                            <div class="document" id="servicioMilitarHombre">
                                <label for="idMilitarDoc"><span style="color: #c40055;">*</span> Certificado de Servicio Militar Obligatorio al día</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="idMilitarDoc" name="nameMilitarDoc" accept=".pdf">
                                    <button class="button" type="button" onclick="clearFileInput('idMilitarDoc')">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button>
                                </div>
                                <br>
                            </div>
                        </div>
                        <br>
                        <div class="observaciones seccion">
                            <h6 style="padding-top: 20px !important;">Observaciones</h6>
                            <textarea id="idObserv" name="nameObserv" class="form-control" rows="5" cols="50" maxlength="1000"></textarea>
                        </div>
                        <br>
                        <div class="boton-registrar">
                            <button id="btnRegistrar" type="submit" class="boton-registrarB">
                                <div class="svg-wrapper-1">
                                    <div class="svg-wrapper">
                                        <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                </div>
                                <span>Registrar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/doc_exclusivos.js"></script>
    <script src="./assets/js/validaciones_input.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>