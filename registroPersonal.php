<?php
// Conexión a la base de datos
$conn = mysqli_connect('localhost', 'root', '', 'das');

// Verificación de la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Registro de Trabajadores</title>
</head>

<body>
    <form>
        <h2>Registro de Trabajadores</h2>
        <h4>Datos Personales</h4>

        <label for="idPersona">Nombres:</label>
        <input type="text" name="namePersona" id="idPersona" required>

        <label for="idAppat">Apellido Paterno:</label>
        <input type="text" name="namePaterno" id="idAppat" required>

        <label for="idApmat">Apellido Materno:</label>
        <input type="text" name="nameMaterno" id="idApmat">

        <label for="idRutInput">Rut:</label>
        <input type="text" name="nameRut" id="idRutInput" required>

        <h5>Sexo:</h5>
        <label for="idFemenino">Femenino</label>
        <input type="radio" name="sexo" id="idFemenino" value="Femenino" required>

        <label for="idMasculino">Masculino</label>
        <input type="radio" name="sexo" id="idMasculino" value="Masculino" required>


        <h4>Datos de Contacto</h4>

        <label for="idCelular">Celular</label>
        <p>+569</p>
        <input type="tel" name="nameCel" id="idCelular">

        <label for="idCorreo">Correo Electrónico</label>
        <input type="emai" name="nameCorreo" id="idCorreo">

        <h4>Documentación</h4>


        <div class="container-afp">

            <h4>AFP</h4>
            <?php

            // select de afp
            $sqlAFP = "SELECT idAFP, nombreAFP FROM afp";
            $resultadoAFP = mysqli_query($conn, $sqlAFP);
            echo "<label for='idSelectAFP'>Seleccione AFP</label>";
            echo "<select name='nameSelectAFP' id='idSelectAFP'>";
            echo '<option value=""> </option>'; // Opción por defecto en blanco

            while ($fila = mysqli_fetch_assoc($resultadoAFP)) {
                echo "<option value='" . $fila['idAFP'] . "'>" . $fila['nombreAFP'] . "</option>";
            }
            echo "</select>";
            // Cierre de la conexión

            ?>



        </div>









    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>