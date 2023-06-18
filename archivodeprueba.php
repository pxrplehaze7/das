<?php include("./controller/config/conexion.php");
session_start();
if (!isset($_SESSION['rol'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Información</title>


</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
 

    <?php
include("./controller/config/conexion.php");

// Obtener el rut enviado por POST
if (isset($_POST['nameBuscaRut'])) {
  $rut = $_POST['nameBuscaRut']; //se asigna el valor del input rut a $rut

  // Realizar la consulta para obtener la información de la persona WHERE el rut de base de datos sea igual al $rut
  $sqlDatosTra = "SELECT cat.NombreCat, con.NombreCon, afp.NombreAFP, pre.NombrePrev, lug.NombreLug, sec.NombreSector, tra.IDAFP, tra.IDPrev, tra.IDTra , tra.IDCon, NombreTra, PaternoTra, MaternoTra, Decreto, Rut, Genero, Inscripcion, Profesion, Medico, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaContrato, RutaDJur,RutaSerM, RutaSCom, RutaExaM, RutaInscripcion, Observ
                  FROM trabajador tra
                  INNER JOIN categoria cat  ON (cat.IDCat   = tra.IDCat)
                  INNER JOIN contrato con   ON (con.IDCon   = tra.IDCon)
                  INNER JOIN afp afp        ON (afp.IDAFP   = tra.IDAFP)
                  INNER JOIN lugar lug      ON (lug.IDLugar = tra.IDLugar)
                  INNER JOIN sector sec ON (sec.IDSector  = tra.IDSector)
                  INNER JOIN prevision pre ON (pre.IDPrev  = tra.IDPrev)
                  WHERE Rut='$rut' LIMIT 1";



  $resultadoDatosTra = mysqli_query($conn, $sqlDatosTra);

  // Verificar si se encontró una persona en la base de datos con el valor de $rut
  if (mysqli_num_rows($resultadoDatosTra) == 1) {
    // Si se encuentra una persona, se asigna el resultado a $persona
    $persona = mysqli_fetch_assoc($resultadoDatosTra);
    $idtra = $persona['IDTra'];

    // Cerrar la conexión a la base de datos  
    // mysqli_close($conn);
  } else {
    echo "<script>
      Swal.fire({
        title: 'Usuario no encontrado',
        text: '¿Desea registrar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#00c4a0',
        cancelButtonColor: '#ba0051',
        confirmButtonText: 'Sí',
        allowOutsideClick: false,
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
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <!-- Navbar Brand-->
  <a class="navbar-brand ps-3" href="home.php"><img src="./assets/img/logo.png" width="30px"> DAS Chiguayante</a>
  <!-- Sidebar Toggle-->
  <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
  <!-- Navbar Search-->
  <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="mostrar.php" method="POST" id="searchForm">
    <div class="input-group">
      <input class="form-control" type="text" name="nameBuscaRut" id="nameBuscaRut" placeholder="19876543-K" pattern="^\d{7,8}-[kK\d]$" maxlength="10" minlength="9" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
      <button class="btn btn-primary btn-buscar" id="btnNavbarSearch" type="submit" disabled><i class="fas fa-search"></i></button>
    </div>
  </form>

  <!-- Navbar-->
  <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
      
        <li> <a class="dropdown-item" href="editPerfil.php">Editar perfil</a></li>


        <li>
          <hr class="dropdown-divider" />
        </li>
        <li><a class="dropdown-item" href="./controller/logout.php">Cerrar Sesión</a></li>
      </ul>
    </li>
  </ul>
</nav>



        <?php require("./components/sidebar.php") ?>

        <div id="layoutSidenav_content">
            <main>
                <?php if (isset($persona)) { ?>
                    <div class="container-md">

                        <br>
                        <div class="seccion">
                            <div class="row ">
                                <h6>Datos Personales</h6>
                                <div class="col-md">
                                    <label>Rut</label>
                                    <input value="<?php echo $persona['Rut'] ?>" class="form-control" readonly>
                                    <br>
                                </div>
                                <div class="col-md">
                                    <label> Nombres</label>
                                    <input value="<?php echo $persona['NombreTra'] ?>" class="form-control" readonly>
                                    <br>
                                </div>
                            </div>
                        
                <?php } ?>
            </main>
        </div>
    </div>


</body>

</html>