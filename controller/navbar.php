
<?php
include("./controller/config/conexion.php");

// Obtener el rut enviado por POST
if (isset($_POST['nameBuscaRut'])) {
    $rut = $_POST['nameBuscaRut']; //se asigna el valor del input rut a $rut

    // Realizar la consulta para obtener la información de la persona WHERE el rut de base de datos sea igual al $rut
    $sqlDatosTra = "SELECT cat.NombreCat, con.NombreCon, afp.NombreAFP, pre.NombrePrev, lug.NombreLug, IDTra, NombreTra, PaternoTra, MaternoTra, Sector, Decreto, Rut, Genero, Profesion, Medico, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaContrato, RutaDJur,RutaSerM, RutaSCom, RutaExaM
                  FROM trabajador tra
                  INNER JOIN categoria cat  ON (cat.IDCat   = tra.IDCat)
                  INNER JOIN contrato con   ON (con.IDCon   = tra.IDCon)
                  INNER JOIN afp afp        ON (afp.IDAFP   = tra.IDAFP)
                  INNER JOIN lugar lug      ON (lug.IDLugar = tra.IDLugar)
                  INNER JOIN prevision pre ON (pre.IDPrev  = tra.IDPrev)
                  WHERE Rut='$rut' LIMIT 1";

    $resultadoDatosTra = mysqli_query($conn, $sqlDatosTra);

    // Verificar si se encontró una persona en la base de datos con el valor de $rut
    if (mysqli_num_rows($resultadoDatosTra) == 1) {
        // Si se encuentra una persona, se asigna el resultado a $persona
        $persona = mysqli_fetch_assoc($resultadoDatosTra);

        // Cerrar la conexión a la base de datos  
        // mysqli_close($conn);
    } else {
      echo "<script>
      Swal.fire({
        title: 'Usuario no encontrado',
        text: '¿Desea registrar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'registro.php';
        } else {
          window.location.href = 'home.php';
        }
      });
    </script>";
      
    }
}
?>



<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php"><img src="./assets/img/logo.png" width="30px" alt="Descripción de la imagen"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="home.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registro.php">Registrar</a>
        </li>
      </ul>
      <form class="d-flex" role="search" action="mostrar.php" method="POST">
        <input class="form-control me-2" name="nameBuscaRut" type="search" placeholder="19876543-K" pattern="^\d{7,8}-[kK\d]$" maxlength="10">
        <button class="btn btn-buscar" type="submit">Buscar <i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
    </div>
  </div>
</nav>
