<?php
include("./controller/config/conexion.php");

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Personal</title>
    <!-- cdn jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- cdn css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- cdn iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- estilo de registro -->
    <link href="./assets/css/registroPersonal.css" rel="stylesheet">
    <!-- estilo menu -->
    <link href="./assets/css/menu.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>


</head>

<body>
    <header>
        <?php include("./controller/navbar.php") ?>
    </header>
    <div class="container-md">

        <form id="documentosObligatorios" enctype="multipart/form-data" method="POST">

            <h1>Registro de Trabajadores</h1>
            <br>
            <div class="datosPersonales seccion">
                <h6>Datos Personales</h6>
                <div class="primerGrupo art row ">
                    <div class="rut col-md">

                        <label for="idRutInput">(*) Rut</label>
                        <input type="text" name="nameRut" id="idRutInput" placeholder="19876543-K" class="form-control" pattern="^\d{7,8}-[kK\d]$" maxlength="10" required>
                        <div id="rut-validation"></div>
                        <br>
                    </div>
                    <div class="nombre col-md">

                        <label for="idPersona">(*) Nombres</label>
                        <input type="text" name="namePersona" id="idPersona" placeholder="Ingrese Nombres" class="form-control" required>
                        <br>
                    </div>
                </div>

                <div class="segundoGrupo row">
                    <div class="paterno art col-md">

                        <label for="idAppat">(*) Apellido Paterno</label>
                        <input type="text" name="namePaterno" id="idAppat" placeholder="Ingrese Apellido" class="form-control" required>
                        <br>
                    </div>

                    <div class="materno art col-md">
                        <label for="idApmat">Apellido Materno</label>
                        <input type="text" name="nameMaterno" id="idApmat" placeholder="Ingrese Apellido" class="form-control">
                        <br>
                    </div>
                </div>

                <div class="datosTrabajo art">
                    <div class="grupo1 row">
                        <div class="contrato col-md-6"> <!-- TIPO DE CONTRATO -->
                            <?php include("./controller/consulta_select/select_contrato.php"); ?>
                            <br>
                        </div>

                        <div class="categoria col-md-6"> <!-- CATEGORIA -->
                            <?php include("./controller/consulta_select/select_categoria.php"); ?>
                            <br>
                        </div>
                        <br>
                    </div>

                    <div id="idPreguntaCat1" style="display:none;" class="row radioCentro">
                        <center>
                            <label>(*) ¿Es médico?</label>
                        </center>
                        <div class="opciones">

                            <input type="radio" name="nameMedico" id="idSiMedico" value="Si" class="radioInput  form-check-input">
                            <label for="idSiMedico" class="radio label form-check-label">Sí</label>
                            <br>
                            <input type="radio" name="nameMedico" id="idNoMedico" value="No" class="radioInput form-check-input">
                            <label for="idNoMedico" class="radio label form-check-label">No</label>
                        </div>
                        <br>
                    </div>

                    <div class="grupo2 row">
                        <div class="lugar col-md-6"> <!-- LUGAR -->
                            <?php include("./controller/consulta_select/select_lugar.php"); ?>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <label for="idSelectSector">Sector:</label>
                            <select class="form-select" id="idSelectSector" name="nameSelectSector">
                            <option value="No Aplica">No aplica</option>
                            </select>
                        </div>

                    </div>

                    <div class="profesion art">
                        <label for="idProfesion">(*) Profesión</label>
                        <input type="text" name="nameProfesion" id="idProfesion" class="form-control">
                    </div>

                </div>
                <br>

                <div class="tercerGrupo radioCentro row">
                    <center>
                        <label>(*) Seleccione Género</label>
                    </center>
                    <div class="opciones">
                        <input type="radio" name="nameGenero" id="idFemenino" value="Femenino" required class="radioInput form-check-input">
                        <label for="idFemenino" class="radio form-check-label">Femenino</label>

                        <input type="radio" name="nameGenero" id="idMasculino" value="Masculino" required class="radioInput form-check-input">
                        <label for="idMasculino" class="radio form-check-label">Masculino</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="datosContacto seccion">
                <h6>Datos de Contacto</h6>
                <div class="cuartoGrupo art row">
                    <div class="col-6">
                        <label for="idCelular">Celular</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">+56</span>
                            <input type="text" name="nameCelular" id="idCelular" placeholder="987654321" class="form-control" maxlength="9">
                        </div>
                    </div>
                    <div class="correo col-6">
                        <label for="idCorreo">Correo Electrónico</label>
                        <input type="text" name="nameCorreo" id="idCorreo" placeholder="correo@daschiguayante.cl" class="form-control" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
                    </div>
                </div>
            </div>
            <br>

            <div class="documentacion seccion">
                <h6>Documentación</h6>

                <div class="afp row art"> <!-- AFP -->
                    <div class=" col-md-3">
                        <?php include("./controller/consulta_select/select_afp.php"); ?>
                    </div>
                    <div class="col-md-9">
                        <label for="idAFPinput">Certificado de Afiliación</label>
                        <div class="input-group">
                            <input type="file" id="idAFPinput" name="nameAFPdoc" class="form-control" accept=".pdf">
                            <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idAFPinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                </div>
                <br>

                <div class="prevision row art"> <!-- PREVISION -->
                    <div class=" col-md-3">
                        <?php include("./controller/consulta_select/select_prevision.php"); ?>
                    </div>
                    <div class="col-md-9">
                        <label for="idPREVinput">Certificado de Afiliación</label>
                        <div class="input-group">
                            <input type="file" id="idPREVinput" name="namePREVdoc" class="form-control" accept=".pdf">
                            <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idPREVinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                </div>
                <br>

                <div class="prevision row art"> <!-- DECRETO Y ARCHIVO DE CONTRATO -->
                    <div class="col-md-3">
                        <label for="idDecreto">(*) Decreto</label>
                        <input type="text" name="nameDecreto" id="idDecreto" class="form-control" maxlength="30">
                    </div>

                    <div class="col-md-9">
                        <label for="idDocContratoInput">Contrato</label>
                        <div class="input-group">
                            <input type="file" id="idDocContratoInput" name="nameDocContratoInput" class="form-control" accept=".pdf">
                            <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idDocContratoInput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                </div>
                <br>

                <div class="nacimiento art">
                    <label for="idNACinput">Certificado de Nacimiento</label>
                    <div class="input-group ">
                        <input type="file" id="idNACinput" name="nameNACdoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idNACinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
                <div class="antecedentes art">
                    <label for="idANTECEinput">Certificado de Antecedentes</label>
                    <div class="input-group ">
                        <input type="file" id="idANTECEinput" name="nameANTECEdoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idANTECEinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
                <div class="cedula art">
                    <label for="idCedulainput">Fotocopia Cédula de Identidad</label>
                    <div class="input-group ">
                        <input type="file" id="idCedulainput" name="nameCeduladoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idCedulainput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
                <div class="curriculum art">
                    <label for="idCVinput">Curriculum Vitae</label>
                    <div class="input-group ">
                        <input type="file" id="idCVinput" name="nameCVdoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idCVinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <div class="examenM art" id="examenMedico">
                    <br>
                    <label for="idExamenMinput">Examen Médico Unico Nacional</label>
                    <div class="input-group ">
                        <input type="file" id="idExamenMinput" name="nameExaMdoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idExamenMinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
                <div class="estudios art">
                    <label for="idEstudioinput">Certificado de Estudios o Título Profesional</label>
                    <div class="input-group ">
                        <input type="file" id="idEstudioinput" name="nameEstudiodoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idEstudioinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
                <div class="decJurada art">
                    <label for="idDJuradainput">Declaración Jurada</label>
                    <div class="input-group ">
                        <input type="file" id="idDJuradainput" name="nameDJuradadoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idDJuradainput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
                <div class="saludCompatible art">
                    <label for="idSCompatibleinput">Certificado de Salud Compatible</label>
                    <div class="input-group ">
                        <input type="file" id="idSCompatibleinput" name="nameSCompatibledoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idSCompatibleinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
                <div id="servicioMilitarHombre art" class="servicioMilitarHombre">
                    <label for="idMilitarDoc">Certificado de Servicio Militar Obligatorio al día</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="idMilitarDoc" name="nameMilitarDoc" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idMilitarDoc')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
            </div>
            <br>
            <!-- <div class="observaciones seccion">
                <h6>Observaciones</h6>
                <textarea id="idObserv" name="nameObserv" class="form-control" rows="4" cols="50"></textarea>
            </div>
            <br> -->
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