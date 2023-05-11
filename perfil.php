<?php
// Conectar a la base de datos
include("./controller/config/conexion.php");

// Obtener el rut enviado por GET
if (isset($_POST['nameBuscaRut'])) {
  $rut = $_POST['nameBuscaRut'];

  // Realizar la consulta para obtener la información de la persona
  $sqlDatosTra = "SELECT cat.NombreCat, con.NombreCon, afp.NombreAFP, pre.NombrePrev, lug.NombreLug, NombreTra, PaternoTra, MaternoTra, Rut, Sexo, Profesion, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaDJur,RutaSerM, RutaSCom, RutaExaM, Observ
                  FROM trabajador tra
                  INNER JOIN categoria cat  ON (cat.IDCat   = tra.IDCat)
                  INNER JOIN contrato con   ON (con.IDCon   = tra.IDCon)
                  INNER JOIN afp afp        ON (afp.IDAFP   = tra.IDAFP)
                  INNER JOIN lugar lug      ON (lug.IDLugar = tra.IDLugar)
                  INNER JOIN prevision pre ON (pre.IDPrev  = tra.IDPrev)
                  WHERE Rut='$rut' LIMIT 1";

  $resultadoDatosTra = mysqli_query($conn, $sqlDatosTra);


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
  <!-- iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="./assets/css/perfil.css" rel="stylesheet">
</head>

<body>
  <header>
    <?php include("./controller/navbar.php") ?>
  </header>

  <!-- <div class="container-md">
    <form method="GET">
      <label>Buscar por rut:</label>
      <input type="search" name="nameBuscaRut">
      <button type="submit">Buscar</button>
    </form>

  </div> -->


  <div class="container-md">
    <?php if (isset($persona)) { ?>

      <center>
        <h2><?php echo $persona['NombreTra'] . ' ' . $persona['PaternoTra'] . ' ' . $persona['MaternoTra'] ?></h1>
      </center>

      <div class="datosPersonales seccion">
        <h5>Datos Personales</h5>

        <div class="rut">
          <p>Rut: <?php echo $persona['Rut'] ?></p>
        </div>

        <div class="Genero">
          <p>Genero: <?php echo $persona['Sexo'] ?></p>
        </div>

        <div class="Contrato">
          <p>Tipo de Contrato: <?php echo $persona['NombreCon'] ?></p>
        </div>

        <div class="Lugar">
          <p>Lugar de Trabajo: <?php echo $persona['NombreLug'] ?></p>
        </div>

        <div class="Categoria">
          <p>Categoría: <?php echo $persona['NombreCat'] ?></p>
        </div>

        <div class="Profesión">
          <p>Profesión: <?php echo $persona['Profesion'] ?></p>
        </div>
      </div>



      <div class="datosContacto seccion">
                <h5>Datos de Contacto</h5>
                <div class="row">
                    <div class="celular col-md">
       <p>Celular: <?php echo $persona['CelularTra'] ?></p>
                    </div>
                    <br>
                    <div class="correo col-md">
            <p>CorreoTra: <?php echo $persona['CorreoTra'] ?></p>
                    </div>
                </div>
            </div>


      <div class="documentos row seccion">
      <h5>Dacumentos</h5>
        <div class="nombreAFP col">
          <p>AFP: <?php echo $persona['NombreAFP'] ?></p>
        </div>

        <div class="archivoAFP col">

          <div class="ver">
            <a href="<?php echo $persona['RutaAFP']; ?>" target="_blank"><i class="fa-solid fa-book-open-reader" style="color: #000000;">VER</class=></i></a>
          </div>



          <div class="descarga">
            <a href="<?php echo $persona['RutaAFP']; ?>" download><i class="fa-solid fa-file-arrow-down" style="color: #000000;"></i>DESCARGAR</a><br>

          </div>



        </div>
      </div>



  </div>

  <!-- aqui faltan los documentos -->


<?php  } ?>
</body>

</html>