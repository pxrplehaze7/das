<?php
// Conectar a la base de datos
include("./controller/config/conexion.php");

// Obtener el rut enviado por GET
if (isset($_GET['nameBuscaRut'])) {
  $rut = $_GET['nameBuscaRut'];

  // Realizar la consulta para obtener la información de la persona
  $sqlDatosTra = "SELECT * FROM trabajador WHERE Rut='$rut' LIMIT 1";
  $resultadoDatosTra = mysqli_query($conn, $sqlDatosTra);


  $sqlContrato = "SELECT c.NombreCon
                  FROM contrato c
                  INNER JOIN trabajador tra
                  ON c.IDCon = tra.IDCon";

  $sqlLugar = "SELECT NombreLug
               FROM lugar lug
               INNER JOIN trabajador tra
               ON lug.IDLugar = tra.IDLug";

  // Verificar si se encontró la persona en la base de datos
  if (mysqli_num_rows($resultadoDatosTra) == 1) {
    // Obtener la información de la persona
    $persona = mysqli_fetch_assoc($resultadoDatosTra);

    // Cerrar la conexión a la base de datos  
    mysqli_close($conn);
  } else {
    echo "No se encontró ninguna persona con el rut ingresado";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil</title>
  <!-- cdn jquery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

  <!-- cdn css bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <form method="GET">
    <label>Buscar por rut:</label>
    <input type="text" name="nameBuscaRut">
    <button type="submit">Buscar</button>
  </form>

  <?php if (isset($persona)) { ?>

    <h1><?php echo $persona['NombreTra'] . ' ' . $persona['PaternoTra'] . ' ' . $persona['MaternoTra'] ?></h1>
    <br>
    <p>Rut: <?php echo $persona['Rut'] ?></p>
    <br>
    <p>Género: <?php echo $persona['Sexo'] ?></p>
    <br>
    <p>Categoría: <?php echo $persona['IDCat'] ?></p>
    <br>
    <p>Profesión: <?php echo $persona['Profesion'] ?></p>
    <br>
    <p>Celular: <?php echo $persona['CelularTra'] ?></p>
    <br>
    <p>CorreoTra: <?php echo $persona['CorreoTra'] ?></p>
    <br>
    <p>Tipo de Contrato: <?php echo $persona['IDCon'] ?></p> <!--llave foranea-->
    <br>
    <p>Lugar de Trabajo: <?php echo $persona['IDLugar'] ?></p>

    <!-- Mostrar la ruta de los archivos PDF -->
    <p>Ruta de archivo AFP: <?php echo $persona['RutaAFP'] ?></p>
    <p>Ruta de archivo de nacimiento: <?php echo $persona['RutaNac'] ?></p>
    <p>Ruta de archivo de Militar: <?php echo $persona['RutaSerM'] ?></p>



    <!-- Agregar botones para ver y descargar los archivos PDF -->
    <div class="pdf-buttons">
      <a href="<?php echo $persona['RutaAFP']; ?>" target="_blank"><i class="fa-solid fa-book-open-reader" style="color: #000000;"></class=></i></a><br>
      <a href="<?php echo $persona['RutaAFP']; ?>" download><i class="fa-solid fa-file-arrow-down" style="color: #000000;"></i></a><br>
      <br>
      <a href="<?php echo $persona['RutaNac']; ?>" target="_blank"><i class="fa-solid fa-book-open-reader" style="color: #000000;"></class=></i></a><br>
      <a href="<?php echo $persona['RutaNac']; ?>" download><i class="fa-solid fa-file-arrow-down" style="color: #000000;"></i></a>
      <br>
      <a href="<?php echo $persona['RutaSerM']; ?>" target="_blank"><i class="fa-solid fa-book-open-reader" style="color: #000000;"></class=></i></a><br>
      <a href="<?php echo $persona['RutaSerM']; ?>" download><i class="fa-solid fa-file-arrow-down" style="color: #000000;"></i></a>
    </div>


  <?php  } ?>
</body>

</html>