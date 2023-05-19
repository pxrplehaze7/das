<?php

include("./controller/config/conexion.php");

if (isset($_POST['nameRutCalifica'])) {
    $rut = $_POST['nameRutCalifica'];

    $sqlTra = "SELECT idTra, concat(nombreTra, ' ',PaternoTra , ' ' , MaternoTra) as nombre  FROM `trabajador`
    WHERE Rut='$rut' LIMIT 1";

$resultadoDatosTra = mysqli_query($conn, $sqlTra);
list($idTrabajador,$nombre) = mysqli_fetch_row($resultadoDatosTra);

//consultar nombres y rut de trabajador para despues mostrar y guardar
}



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


</head>

<body>
    <header>
        <?php include("./controller/navbar.php") ?>
    </header>
    <div class="container-md">

        <form id="documentosApelacion" enctype="multipart/form-data" method="POST">

            <h2>Calificaciones</h2>
            <br>
            <div class="datosPersonales seccion">
                <h6><?php echo $nombre ?></h6>
                <div class="primerGrupo art row ">
                    <div class="rut-ver col-md">
                        <label>Rut</label>
                        <input id="idRutCa" name="nameRutCa" value="<?php echo $rut ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class=" col-md">
                        <label for="idTrabCa">(*) ID Trabajador</label>
                        <input id="idTrabCa" name="nameTrabCa" value="<?php echo $idTrabajador ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>

                <div class="row art">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col">
                                <label for="idInicio">(*) Desde</label>
                                <input type="text" name="nameInicio" id="idInicio" class="form-control input-small" required>
                            </div>

                            <div class="col">
                                <label for="idFin">(*) Hasta</label>
                                <input type="text" name="nameFin" id="idFin" class="form-control input-small" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="idCalifInput">Calificación</label>
                        <div class="input-group">
                            <input type="file" id="idCalifInput" name="nameCalifdoc" class="form-control" accept=".pdf">
                            <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idCalifInput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="radioCentro row">
                    <center>
                        <label>¿Realizo una Apelación?</label>
                    </center>
                    <div class="opciones">
                        <input type="radio" name="nameApeloRes" id="idSiApelo" value="Si" required class="radioInput form-check-input">
                        <label for="idSiApelo" class="radio form-check-label">Sí</label>

                        <input type="radio" name="nameApeloRes" id="idNoApelo" value="No" required class="radioInput form-check-input">
                        <label for="idNoApelo" class="radio form-check-label">No</label>
                    </div>
                </div>

                <div id="adjuntaApelacion">
                    <label for="idApelacionDoc">Apelación</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="idApelacionDoc" name="nameApelacionDoc" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idApelacionDoc')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
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