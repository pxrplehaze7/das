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
    <!-- estilo de registro -->
    <link href="./assets/css/registroPersonal.css" rel="stylesheet">
    <!-- revisa si el rut ya existe -->
    <script src="./assets/js/revisa_rut.js"></script>
    <script src="./assets/js/botonesLimpiar.js"></script>

</head>

<body>
    <header>
        <?php include("./controller/navbar.php") ?>
    </header>
    <div class="container-md">

        <form id="documentosObligatorios" enctype="multipart/form-data" method="POST">

            <h2>Registro de Trabajadores</h2>
            <br>
            <div class="datosPersonales seccion">
                <p>Datos Personales</p>
                <div class="primerGrupo row ">
                    <div class="rut col-md">

                        <label for="idRutInput">Rut</label>
                        <input type="text" name="nameRut" id="idRutInput" placeholder="19876543-2" class="form-control" required>
                        <div id="rut-validation"></div>
                        <br>
                    </div>
                    <div class="nombre col-md">

                        <label for="idPersona">Nombres</label>
                        <input type="text" name="namePersona" id="idPersona" placeholder="Ingrese Nombres" class="form-control" required>
                        <br>
                    </div>
                </div>

                <div class="segundoGrupo row">
                    <div class="paterno col-md">

                        <label for="idAppat">Apellido Paterno</label>
                        <input type="text" name="namePaterno" id="idAppat" placeholder="Ingrese Apellido" class="form-control" required>
                        <br>
                    </div>

                    <div class="materno col-md">
                        <label for="idApmat">Apellido Materno</label>
                        <input type="text" name="nameMaterno" id="idApmat" placeholder="Ingrese Apellido" class="form-control">
                        <br>
                    </div>
                </div>


                <div class="datosTrabajo row">
                    <div class="contrato col-md"> <!-- TIPO DE CONTRATO -->
                        <?php include("./controller/consulta_select/select_contrato.php"); ?>
                        <br>
                    </div>
                    <br>
                    <div class="lugar col-md"> <!-- LUGAR -->
                        <?php include("./controller/consulta_select/select_lugar.php"); ?>
                    </div>
                    <br>
                    <div class="categoria col-md"> <!-- CATEGORIA -->
                        <?php include("./controller/consulta_select/select_categoria.php"); ?>
                        <br>
                    </div>

                    <div id="idPreguntaCat1" style="display:none;" class="row radioCentro">
                        <center>
                            <label>¿Es médico?</label>
                        </center>
                        <div class="opciones">

                            <input type="radio" name="nameMedico" id="idSiMedico" value="Si" class="radioInput" novalidate>
                            <label for="idSiMedico" class="radio">Sí</label>

                            <input type="radio" name="nameMedico" id="idNoMedico" value="No" class="radioInput" novalidate>
                            <label for="idNoMedico" class="radio">No</label>
                        </div>
                    </div>


                    <div class="profesion">

                        <label for="idProfesion">Profesión:</label>
                        <input type="text" name="nameProfesion" id="idProfesion" class="form-control">
                    </div>

                </div>

                <br>

                <!-- hasta aqui esta bien -->

                <div class="tercerGrupo radioCentro row">
                    <center>
                        <label>Seleccione Género:</label>
                    </center>
                    <div class="opciones">

                        <input type="radio" name="nameGenero" id="idFemenino" value="Femenino" required class="radioInput">
                        <label for="idFemenino" class="radio">Femenino</label>

                        <input type="radio" name="nameGenero" id="idMasculino" value="Masculino" required class="radioInput">
                        <label for="idMasculino" class="radio">Masculino</label>



                    </div>
                </div>
            </div>
            <br>
            <div class="datosContacto seccion">
                <p>Datos de Contacto</p>
                <div class="cuartoGrupo row">
                    <div class="celular col-md">
                        <label for="idCelular">Celular</label>
                        <input type="text" name="nameCelular" id="idCelular" placeholder="9876 5432" class="form-control">
                    </div>
                    <br>
                    <div class="correo col-md">
                        <label for="idCorreo">Correo Electrónico</label>
                        <input type="text" name="nameCorreo" id="idCorreo" placeholder="correo@correo.com" class="form-control">
                    </div>
                </div>
            </div>
            <br>



            <div class="documentacion seccion">
                <p>Documentación</p>
                <div class="afp row"> <!-- AFP -->
                    <div class="col-md">
                        <?php include("./controller/consulta_select/select_afp.php"); ?>
                        <br>
                    </div>
                    <div class="col-md">

                        <label for="idAFPinput">Certificado de Afiliación</label>
                        <input type="file" id="idAFPinput" name="nameAFPdoc" class="form-control" accept=".pdf">
                    </div>
                </div>
                <br>

                <div class="prevision row"> <!-- PREVISION -->
                    <div class="col-md">
                        <?php include("./controller/consulta_select/select_prevision.php"); ?>
                        <br>
                    </div>
                    <div class="col-md">

                        <label for="idPREVinput">Certificado de Afiliación</label>
                        <input type="file" id="idPREVinput" name="namePREVdoc" class="form-control" accept=".pdf">
                    </div>

                </div>
                <br>

                <div class="nacimiento row">
                    <label for="idNACinput">Certificado de Nacimiento:</label>
                    <div class="inputFile col-sm-9 col-md-10">
                        <input type="file" id="idNACinput" name="nameNACdoc" class="form-control" accept=".pdf">
                    </div>
                    <div class="eliminarBoton col-sm-3 col-md-2">
                        <button class="btn btn-outline-secondary" type="button" onclick="clearFileInput('idNACinput')">Clear</button>
                    </div>
                </div>


                <br>
                <div class="antecedentes row">
                    <label for="idANTECEinput">Certificado de Antecedentes:</label>
                    <div class="inputFile col-sm-9 col-md-10">
                        <input type="file" id="idANTECEinput" name="nameANTECEdoc" class="form-control" accept=".pdf">
                    </div>
                    <div class="eliminarBoton col-sm-3 col-md-2">
                        <button class="btn btn-outline-secondary" type="button" onclick="clearFileInput('idANTECEinput')">Clear</button>
                    </div>

                </div>
                <br>
                <div class="cedula row">
                    <label for="idCedulainput">Fotocopia Cédula de Identidad:</label>
                    <div class="inputFile col-sm-9 col-md-10">
                        <input type="file" id="idCedulainput" name="nameCeduladoc" class="form-control" accept=".pdf">
                    </div>
                    <div class="eliminarBoton col-sm-3 col-md-2">
                        <button class="btn btn-outline-secondary" type="button" onclick="clearFileInput('idCedulainput')">Clear</button>
                    </div>
                </div>
                <br>
                <div class="curriculum row">
                    <label for="idCVinput">Curriculum Vitae</label>
                    <div class="inputFile col-sm-9 col-md-10">
                        <input type="file" id="idCVinput" name="nameCVdoc" class="form-control" accept=".pdf">
                    </div>
                    <div class="eliminarBoton col-sm-3 col-md-2">
                        <button class="btn btn-outline-secondary" type="button" onclick="clearFileInput('idCVinput')">Clear</button>
                    </div>
                </div>

                <div class="examenM row" id="examenMedico">
                    <br>
                    <label for="idExamenMinput">Examen Médico Unico Nacional</label>
                    <div class="inputFile col-sm-9 col-md-10">
                        <input type="file" id="idExamenMinput" name="nameExaMdoc" class="form-control" accept=".pdf">
                    </div>
                    <div class="eliminarBoton col-sm-3 col-md-2">
                        <button class="btn btn-outline-secondary" type="button" onclick="clearFileInput('idExamenMinput')">Clear</button>
                    </div>
                </div>
                <br>

                <div class="estudios row">
                    <label for="idEstudioinput">Certificado de Estudios o Título Profesional</label>
                    <div class="inputFile col-sm-9 col-md-10">
                        <input type="file" id="idEstudioinput" name="nameEstudiodoc" class="form-control" accept=".pdf">
                    </div>
                    <div class="eliminarBoton col-sm-3 col-md-2">
                        <button class="btn btn-outline-secondary" type="button" onclick="clearFileInput('idEstudioinput')">Clear</button>
                    </div>
                </div>
                <br>
                <div class="decJurada row">
                    <label for="idDJuradainput">Declaración Jurada</label>
                    <div class="inputFile col-sm-9 col-md-10">
                        <input type="file" id="idDJuradainput" name="nameDJuradadoc" class="form-control" accept=".pdf">
                    </div>
                    <div class="eliminarBoton col-sm-3 col-md-2">
                        <button class="btn btn-outline-secondary" type="button" onclick="clearFileInput('idDJuradainput')">Clear</button>
                    </div>
                </div>
                <br>
                <div class="saludCompatible row">
                    <label for="idSCompatibleinput">Certificado de Salud Compatible</label>
                    <div class="inputFile col-sm-9 col-md-10">
                        <input type="file" id="idSCompatibleinput" name="nameSCompatibledoc" class="form-control" accept=".pdf">
                    </div>
                    <div class="eliminarBoton col-sm-3 col-md-2">
                        <button class="btn btn-outline-secondary" type="button" onclick="clearFileInput('idSCompatibleinput')">Clear</button>
                    </div>
                </div>
                <br>
                <div id="servicioMilitarHombre" class="servicioMilitarHombre row">
                    <label for="idMilitarDoc">Certificado de Servicio Militar Obligatorio al día:</label>
                    <div class="inputFile col-sm-9 col-md-10">
                        <input type="file" id="idMilitarDoc" name="nameMilitarDoc" class="form-control" accept=".pdf">
                    </div>
                    <div class="eliminarBoton col-sm-3 col-md-2">
                        <button class="btn btn-outline-secondary" type="button" onclick="clearFileInput('idMilitarDoc')">Clear</button>
                    </div>
                </div>
                <br>
            </div>
            <br>
            <div class="observaciones seccion">
                <p>Observaciones</p>
                <textarea id="idObserv" name="nameObserv" class="form-control" rows="4" cols="50"></textarea>
            </div>
            <br>

            <input type="submit" value="Enviar">
        </form>


    </div>

    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/doc_exclusivos.js"></script>
    <!-- cdn js de boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>