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
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <h2>Registro de Trabajadores</h2>
        <h4>Datos Personales</h4>

        <label for="idPersona">Nombres:</label>
        <input type="text" class="mb-3" name="namePersona" id="idPersona" required>

        <label for="idAppat">Apellido Paterno:</label>
        <input type="text" class="mb-3" name="namePaterno" id="idAppat" required>

        <label for="idApmat">Apellido Materno:</label>
        <input type="text" class="mb-3" name="nameMaterno" id="idApmat">

        <label for="idRutInput">Rut:</label>
        <input type="text" class="mb-3" name="nameRut" id="idRutInput" required>

        <h5>Genero:</h5>
        <label for="idFemenino">Femenino</label>
        <input type="radio" name="sexo" id="idFemenino" value="Femenino" required>

        <label for="idMasculino">Masculino</label>
        <input type="radio" name="sexo" id="idMasculino" value="Masculino" required>


        <h4>Datos de Contacto</h4>

        <label for="idCelular">Celular</label>
        <p>+569</p>
        <input type="tel" class="mb-3" name="nameCel" id="idCelular">

        <label for="idCorreo">Correo Electrónico</label>
        <input type="emai" class="mb-3" name="nameCorreo" id="idCorreo">

        <h4>Documentación</h4>


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




        <div class="container-contrato"> <!-- TIPO DE CONTRATO -->
            <h4>Tipo de Contrato</h4>
            <?php
            $sqlTipoContrato = "SELECT IDCon, NombreCon FROM contrato";
            $resultadoContrato = mysqli_query($conn, $sqlTipoContrato);
            echo "<label for='idSelectCon'>Seleccione Contrato: </label>"; //Label 
            echo "<select name='nameSelectCon' id='idSelectCon'>";
            echo '<option value="" hidden> Selecciona una opción</option>'; // Opción por defecto en blanco

            while ($fila = mysqli_fetch_assoc($resultadoContrato)) {
                echo "<option value='" . $fila['IDCon'] . "'>" . $fila['NombreCon'] . "</option>";
            }
            echo "</select>";
            // Cierre de la conexión
            ?>
        </div>

        <div class="container-categoria"> <!-- CATEGORIA -->
            <h4>Categoría</h4>
            <?php
            $sqlCategoria = "SELECT IDCat, NombreCat FROM categoria";
            $resultadoCategoria = mysqli_query($conn, $sqlCategoria);
            echo "<label for='idSelectCat'>Seleccione Categoría: </label>"; //Label 
            echo "<select name='nameSelectCat' id='idSelectCat'>";
            echo '<option value="" hidden> Selecciona una opción</option>'; // Opción por defecto en blanco

            while ($fila = mysqli_fetch_assoc($resultadoCategoria)) {
                echo "<option value='" . $fila['IDCat'] . "'>" . $fila['NombreCat'] . "</option>";
            }
            echo "</select>";
            // Cierre de la conexión
            ?>
        </div>


        <div class="container-prevision"> <!-- PREVISION -->
            <h4>Previsión</h4>
            <?php
            $sqlPrevision = "SELECT IDPrev, NombrePrev FROM prevision";
            $resultadoPrevision = mysqli_query($conn, $sqlPrevision);
            echo "<label for='idSelectPrev'> Seleccione Previsión: </label>"; //Label 
            echo "<select name='nameSelectPrev' id='idSelectPrev'>";
            echo '<option value="" hidden> Selecciona una opción</option>'; // Opción por defecto en blanco

            while ($fila = mysqli_fetch_assoc($resultadoPrevision)) {
                echo "<option value='" . $fila['IDPrev'] . "'>" . $fila['NombrePrev'] . "</option>";
            }
            echo "</select>";
            // Cierre de la conexión
            ?>
        </div>




        <div class="container-lugar"> <!-- LUGAR -->
            <h4>Lugar</h4>
            <?php
            $sqlLugar = "SELECT IDLugar, NombreLug FROM lugar";
            $resultadoLugar = mysqli_query($conn, $sqlLugar);
            echo "<label for='idSelectLugar'> Seleccione Lugar: </label>"; //Label 
            echo "<select name='nameSelectLugar' id='idSelectLugar'>";
            echo '<option value="" hidden> Selecciona una opción</option>'; // Opción por defecto en blanco

            while ($fila = mysqli_fetch_assoc($resultadoLugar)) {
                echo "<option value='" . $fila['IDLugar'] . "'>" . $fila['NombreLug'] . "</option>";
            }
            echo "</select>";
            // Cierre de la conexión
            ?>
        </div>




    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>