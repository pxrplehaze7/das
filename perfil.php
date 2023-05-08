<?php
// Conectar a la base de datos
include("./controller/config/conexion.php");

// Obtener el rut enviado por GET
if (isset($_GET['nameBuscaRut'])) {
  $rut = $_GET['nameBuscaRut'];

  // Realizar la consulta para obtener la información de la persona
  $sql = "SELECT * FROM trabajador WHERE Rut='$rut' LIMIT 1";
  $resultado = mysqli_query($conn, $sql);

  // Verificar si se encontró la persona en la base de datos
  if (mysqli_num_rows($resultado) == 1) {
    // Obtener la información de la persona
    $persona = mysqli_fetch_assoc($resultado);

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);

    // Mostrar la información de la persona en la página de perfil
    // ...
  } else {
    echo "No se encontró ninguna persona con el rut ingresado";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Perfil de trabajador</title>
</head>

<body>
  <form method="GET">
    <label>Buscar por rut:</label>
    <input type="text" name="nameBuscaRut">
    <button type="submit">Buscar</button>
  </form>

  <?php if (isset($persona)) : ?>

    <p>Rut: <?php echo $persona['Rut'] ?></p>

    <!-- Mostrar la ruta de los archivos PDF -->
    <p>Ruta de archivo AFP: <?php echo $persona['RutaAFP'] ?></p>
    <p>Ruta de archivo de nacimiento: <?php echo $persona['RutaNac'] ?></p>
    <p>Ruta de archivo de Militar: <?php echo $persona['RutaSerM'] ?></p>


    <!-- Agregar botones para ver y descargar los archivos PDF -->
    <div class="pdf-buttons">
      <a href="<?php echo $persona['RutaAFP']; ?>" target="_blank">Ver archivo AFP</a><br>
      <a href="<?php echo $persona['RutaAFP']; ?>" download>Descargar archivo AFP</a><br>
      <a href="<?php echo $persona['RutaNac']; ?>" target="_blank">Ver archivo de nacimiento</a><br>
      <a href="<?php echo $persona['RutaNac']; ?>" download>Descargar archivo de nacimiento</a>
      <a href="<?php echo $persona['RutaSerM']; ?>" target="_blank">Ver certificado de Servicio Militar</a><br>
      <a href="<?php echo $persona['RutaSerM']; ?>" download>Descargar certificado de Servicio Militar</a>
    </div>


  <?php endif; ?>
</body>

</html>