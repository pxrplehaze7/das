<?php
include("./controller/config/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Personal</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    
</head>

<body>
    <form id="documentosObligatorios" enctype="multipart/form-data" method="POST">

        <label for="rut">rut</label>
        <input type="text" name="nameRut" id="idRutInput">
        <br>


        <label for="idAFPinput">AFP</label>
        <input type="file" id="idAFPinput" name="nameAFPdoc" accept=".pdf">
        <br>


        <label for="idNACinput">Certificado de Nacimiento</label>
        <input type="file" id="idNACinput" name="nameNACdoc" accept=".pdf">
        <br>


        <input type="submit" value="Enviar">
    </form>
    <script src="./assets/js/main.js"></script>
</body>

</html>