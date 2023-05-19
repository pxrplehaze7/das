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

