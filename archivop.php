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
    <!-- cdn jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    
    <!-- cdn css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="./assets/js/doc_exclusivos.js"></script>
</head>

<body>
    <form id="documentosObligatorios" enctype="multipart/form-data" method="POST">

    <label for="idRutInput">Rut:</label>
        <input type="text" class="mb-3" name="nameRut" id="idRutInput" required>


        <label for="idAFPinput">AFP</label>
        <input type="file" id="idAFPinput" name="nameAFPdoc" accept=".pdf">
        <br>


        <label for="idNACinput">Certificado de Nacimiento</label>
        <input type="file" id="idNACinput" name="nameNACdoc" accept=".pdf">
        <br>


        <h5>Genero:</h5>
        <label for="idFemenino">Femenino</label>
        <input type="radio" name="genero" id="idFemenino" value="Femenino" required>

        <label for="idMasculino">Masculino</label>
        <input type="radio" name="genero" id="idMasculino" value="Masculino" required>


        <div id="servicioMilitarHombre"> 
        <label for="idMilitarDoc">Certificado de Servicio Militar</label>
        <input type="file" id="idMilitarDoc" name="nameMilitarDoc" accept=".pdf">
        <br>
        </div>




        <div class="container-afp"><!-- TIPO DE AFP -->
            <h4>AFP</h4>
            <?php
            $sqlAFP = "SELECT IDAFP, NombreAFP FROM afp";
            $resultadoAFP = mysqli_query($conn, $sqlAFP);
            echo "<label for='idSelectAFP'>Seleccione AFP: </label>"; //Label 
            echo "<select name='nameSelectAFP' id='idSelectAFP'>";
            echo '<option value="" hidden> Selecciona una opción</option>'; // Opción por defecto en blanco

            while ($fila = mysqli_fetch_assoc($resultadoAFP)) {
                echo "<option value='" . $fila['IDAFP'] . "'>" . $fila['NombreAFP'] . "</option>";
            }
            echo "</select>";
            // Cierre de la conexión
            ?>
        </div>



        <input type="submit" value="Enviar">
    </form>
    <script src="./assets/js/main.js"></script>

    <!-- cdn js de boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>