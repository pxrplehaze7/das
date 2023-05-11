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

</head>

<body>
    <header>
        <?php include("./controller/navbar.html") ?>
    </header>
    <div class="container-md container-formulario">

        <form id="documentosObligatorios" enctype="multipart/form-data" method="POST">

            <h2>Registro de Trabajadores</h2>
            <div class="container-md datosPersonales">
                <p>Datos Personales</p>
                <div class="primerGrupo row ">
                    <div class="rut col-6">
                        <!-- <label for="idRutInput">Rut:</label> -->
                        <input type="text" name="nameRut" id="idRutInput" placeholder="19876543-2" required>
                        <div id="rut-validation"></div>
                    </div>
                    <div class="nombre col-6">
                        <!-- <label for="idPersona">Nombres:</label> -->
                        <input type="text" name="namePersona" id="idPersona" placeholder="Nombres" required>
                    </div>
                </div>
                <br>
                <div class="segundoGrupo row">
                    <div class="paterno col-6">
                        <input type="text" name="namePaterno" id="idAppat" placeholder="Apellido Paterno" required>
                    </div>
                    <div class="materno col-6">
                        <input type="text" name="nameMaterno" id="idApmat" placeholder="Apellido Materno">
                    </div>
                </div>

                <!-- hasta aqui esta bien -->

                <div class="tercerGrupo row">
                    <p>Género:</p>
                    <div class="opciones">
                        <label for="idFemenino">Femenino</label>
                        <input type="radio" name="nameGenero" id="idFemenino" value="Femenino" required>

                        <label for="idMasculino">Masculino</label>
                        <input type="radio" name="nameGenero" id="idMasculino" value="Masculino" required>
                    </div>
                </div>
            </div>
    </div>
    <br>
    <div class="container-md datosContacto">
        <p>Datos de Contacto</p>
        <br>
        <div class="cuartoGrupo row">
            <div class="celular col-6">
                <input type="cel" name="nameCelular" id="idCelular" placeholder="9876 5432">
            </div>
            <div class="correo col-6">
                <input type="email" name="nameCorreo" id="idCorreo" placeholder="correo@correo.com">
            </div>
        </div>
    </div>
    <br>
    <div class="datosTrabajo row">
        <div class="contrato col"> <!-- TIPO DE CONTRATO -->
            <?php include("./controller/consulta_select/select_contrato.php"); ?>
            <br>
        </div>
        <br>
        <div class="lugar col"> <!-- LUGAR -->
            <?php include("./controller/consulta_select/select_lugar.php"); ?>
        </div>
        <br>
        <div class="categoria col"> <!-- CATEGORIA -->
            <?php include("./controller/consulta_select/select_categoria.php"); ?>
            <br>
            <div id="idPreguntaCat1" style="display:none;">
                <p>¿Es médico?</p>

                <label for="idSiMedico">Sí</label>
                <input type="radio" name="nameMedico" id="idSiMedico" value="Sí" required>

                <label for="idNoMedico">No</label>
                <input type="radio" name="nameMedico" id="idNoMedico" value="No" required>
            </div>


        </div>
    </div>


    <label for="idProfesion">Profesión:</label>
    <input type="text" name="nameProfesion" id="idProfesion">
    <br>



    <div class="container-md afp"> <!-- AFP -->
        <p>AFP</p>
        <?php include("./controller/consulta_select/select_afp.php"); ?>
        <br>
        <label for="idAFPinput">Certificado de Afiliación</label>
        <input type="file" id="idAFPinput" name="nameAFPdoc" class="form-control" accept=".pdf">
        <br>
    </div>
    <br>
    <div class="container-md nacimiento">
        <label for="idNACinput">Certificado de Nacimiento:</label>
        <input type="file" id="idNACinput" name="nameNACdoc" class="form-control" accept=".pdf">
    </div>
    <br>
    <div class="container-md antecedentes">
        <label for="idANTECEinput">Certificado de Antecedentes:</label>
        <input type="file" id="idANTECEinput" name="nameANTECEdoc" class="form-control" accept=".pdf">
    </div>
    <br>
    <div class="container-md cedula">
        <label for="idCedulainput">Fotocopia Cédula de Identidad:</label>
        <input type="file" id="idCedulainput" name="nameCeduladoc" class="form-control" accept=".pdf">
    </div>
    <br>
    <div class="container-md curriculum">
        <label for="idCVinput">Curriculum Vitae</label>
        <input type="file" id="idCVinput" name="nameCVdoc" class="form-control" accept=".pdf">
    </div>
    <br>
    <div class="container-md examenM" id="examenMedico">
        <label for="idExamenMinput">Examen Médico Unico Nacional</label>
        <input type="file" id="idExamenMinput" name="nameExaMdoc" class="form-control" accept=".pdf">
    </div>
    <br>
    <div class="container-md prevision"> <!-- PREVISION -->
        <p>Previsión:</p>
        <?php include("./controller/consulta_select/select_prevision.php"); ?>
        <label for="idPREVinput">Certificado de Afiliación</label>
        <input type="file" id="idPREVinput" name="namePREVdoc" class="form-control" accept=".pdf">
    </div>
    <br>
    <div class="container-md estudios">
        <label for="idEstudioinput">Certificado de Estudios o Título Profesional</label>
        <input type="file" id="idEstudioinput" name="nameEstudiodoc" class="form-control" accept=".pdf">
    </div>
    <br>
    <div class="container-md decJurada">
        <label for="idDJuradainput">Declaración Jurada</label>
        <input type="file" id="idDJuradainput" name="nameDJuradadoc" class="form-control" accept=".pdf">
    </div>
    <br>
    <div class="container-md saludCompatible">
        <label for="idSCompatibleinput">Certificado de Salud Compatible</label>
        <input type="file" id="idSCompatibleinput" name="nameSCompatibledoc" class="form-control" accept=".pdf">
    </div>
    <br>
    <div id="servicioMilitarHombre">
        <label for="idMilitarDoc">Certificado de Servicio Militar Obligatorio al día:</label>
        <input type="file" id="idMilitarDoc" name="nameMilitarDoc" class="form-control" accept=".pdf">
        <br>
    </div>
    <br>
    <div class="container-md observaciones">
        <label for="idObserv">Observaciones:</label>
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