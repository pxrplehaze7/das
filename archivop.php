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
    <script src="./assets/js/revisa_rut.js"></script>
</head>

<body>

    <div class="container-md">

        <form id="documentosObligatorios" enctype="multipart/form-data" method="POST">

            <h2>Registro de Trabajadores</h2>
            <div class="container-md datosPersonales">
                <p>Datos Personales</p>

                <div class="container-md nombre">
                    <label for="idPersona">Nombres:</label>
                    <input type="text" class="mb-3" name="namePersona" id="idPersona" required>
                </div>

                <div class="container-md paterno">
                    <label for="idAppat">Apellido Paterno:</label>
                    <input type="text" class="mb-3" name="namePaterno" id="idAppat" required>
                </div>

                <div class="container-md materno">
                    <label for="idApmat">Apellido Materno:</label>
                    <input type="text" class="mb-3" name="nameMaterno" id="idApmat">
                </div>

                <div class="container-md rut">
                    <label for="idRutInput">Rut:</label>
                    <input type="text" class="mb-3" name="nameRut" id="idRutInput" required>
                    <div id="rut-validation"></div>
                </div>

                <div class="container-md genero">
                    <p>Genero:</p>
                    <label for="idFemenino">Femenino</label>
                    <input type="radio" name="nameGenero" id="idFemenino" value="Femenino" required>

                    <label for="idMasculino">Masculino</label>
                    <input type="radio" name="nameGenero" id="idMasculino" value="Masculino" required>
                </div>
            </div>

            <br>

            <div class="container-md datosContacto">
                <p>Datos de Contacto</p>
                <div class="input-group mb-3 celular">
                    <span class="input-group-text" id="idCelular">+569</span>
                    <input type="cel" class="form-control" name="nameCelular" id="idCelular">
                </div>
                <br>
                <div class="correo">
                    <label for="idCorreo">Correo Electrónico</label>
                    <input type="emai" class="mb-3" name="nameCorreo" id="idCorreo">
                </div>
            </div>

            <div class="container-md categoria"> <!-- CATEGORIA -->
                <p>Categoría</p>
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

            <label for="idProfesion">Profesión:</label>
            <input type="text" class="mb-3" name="nameProfesion" id="idProfesion">
            <br>

            <div class="container-md contrato"> <!-- TIPO DE CONTRATO -->
                <p>Tipo de Contrato</p>
                <?php include("./controller/consulta_select/select_contrato.php"); ?>
                <br>
            </div>

            <div class="container-md lugar"> <!-- LUGAR -->
                <p>Lugar</p>
                <?php include("./controller/consulta_select/select_lugar.php"); ?>
            </div>

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
            <div class="container-md examenM">
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