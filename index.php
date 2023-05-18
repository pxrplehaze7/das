<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Iniciar Sesión</title>
    <link href="./assets/css/login.css" rel="stylesheet">
</head>

<body>
    <div class="container-form">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="./controller/login.php">

            <div class="mb-3">
                <label for="idCorreoU" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="nameCorreoU" id="idCorreoU" required>
            </div>


            <div class="mb-3">
                <label for="idClaveU" class="form-label">Contraseña</label>
                <input type="email" class="form-control" name="nameClaveU" id="idClaveU" required>
            </div>

            <button type="submit" class="btn btn-primary btn-login">Iniciar Sesión</button>

        </form>
        <a href="recuperarContraseña.html">¿Olvidaste tu contraseña?</a>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html <label for="idRutInput">(*) Rut</label>
<input type="text" name="nameRut" id="idRutInput" placeholder="19876543-K" class="form-control" pattern="^\d{7,8}-[kK\d]$" maxlength="10" required>


<label for="idPREVinput">Certificado de Afiliación</label>
<div class="input-group">
    <input type="file" id="idPREVinput" name="namePREVdoc" class="form-control" accept=".pdf">
    <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idPREVinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
</div>

<?php

$rutPersona = $_POST['nameRut'];
// OBTIENE EL NOMBRE EL HOST
$host = $_SERVER['HTTP_HOST'];

// CARPETA DONDE SE GUARDARAN CARPETAS SEGUN RUT
$ruta = 'pdfs_personal/';

// CARPETAS CON NOMBRE SEGUN EL RUT, SI NO EXISTE LA CREA
if (!file_exists($ruta . $rutPersona)) {
    mkdir($ruta . $rutPersona, 0777, true);

    mkdir($ruta . $rutPersona . '/C_PREVISION/', 0777, true);
}
// REVISA SI EL RUT EXISTE EN LA BASE DE DATOS
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM trabajador WHERE Rut = '$rutPersona'")) > 0) {
    echo "El rut ya existe, no se han subido archivos.";
  } else {

      //SI EXISTE UN ARCHIVO PDF, CONSTRUYE LA RUTA
  if (!empty($pdfPrevision)) {
    //CREA LA RUTA FINAL DEL ARCHIVO 
    $ruta_PrevisionFINAL    = $ruta . $rutPersona . '/C_PREVISION/' . $pdfPrevision;
    //EL ARCHIVO PDF SE MUEVE A LA NUEVA RUTA
    move_uploaded_file($_FILES['namePREVdoc']['tmp_name'], $ruta_PrevisionFINAL);
    //SE CONSTRUYE LA RUTA FINAL (URL) DEL ARCHIVO
    $ruta_PrevisionFINAL    = 'http://' . $host . '/das/controller/' . $ruta_PrevisionFINAL;
  }

  $sqlTrabajador = " INSERT INTO trabajador (IDPrev, Rut, RutaPrev) VALUES ($prevP,'$rutPersona','$ruta_PrevisionFINAL')";
