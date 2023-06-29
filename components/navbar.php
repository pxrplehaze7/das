<?php
include("./controller/config/conexion.php");

// Obtener el rut enviado por POST
if (isset($_GET['id'])) {
  $idtra = $_GET['id']; //se asigna el valor del input rut a $rut

  // Realizar la consulta para obtener la información de la persona WHERE el rut de base de datos sea igual al $rut
  $sqlDatosTra = "SELECT cat.NombreCat, afp.NombreAFP, pre.NombrePrev, tra.IDAFP, tra.IDPrev, tra.IDTra , tra.IDCat, NombreTra, PaternoTra, MaternoTra, Rut, Genero, Inscripcion, Profesion, Medico, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaDJur,RutaSerM, RutaSCom, RutaExaM, RutaInscripcion, Observ
                  FROM trabajador tra
                  INNER JOIN categoria cat  ON (cat.IDCat   = tra.IDCat)
                  INNER JOIN afp afp        ON (afp.IDAFP   = tra.IDAFP)

                  INNER JOIN prevision pre ON (pre.IDPrev  = tra.IDPrev)
                  WHERE IDTra='$idtra' LIMIT 1";



  $resultadoDatosTra = mysqli_query($conn, $sqlDatosTra);

  // Verificar si se encontró una persona en la base de datos con el valor de $rut
  if (mysqli_num_rows($resultadoDatosTra) == 1) {
    // Si se encuentra una persona, se asigna el resultado a $persona
    $persona = mysqli_fetch_assoc($resultadoDatosTra);
    $idtra = $persona['IDTra'];

    // Cerrar la conexión a la base de datos  
    // mysqli_close($conn);
  }
}
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <!-- Navbar Brand-->
  <a class="navbar-brand ps-3" href="home.php"><img src="./assets/img/logo.png" width="30px"> DAS Chiguayante</a>
  <!-- Sidebar Toggle-->
  <button class="btn btn-link btn-sm order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
    </svg></button>
  <!-- Navbar Search-->
  <form class="d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="mostrar.php" method="POST" id="searchForm">
    <div class="input-group">
      <input class="form-control" type="text" name="nameBuscaRut" id="nameBuscaRut" placeholder="19876543-K" pattern="^\d{7,8}-[kK\d]$" maxlength="10" minlength="9" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
      <button class="btn btn-primary btn-buscar" id="btnNavbarSearch" type="submit" disabled><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg>
</button>
    </div>
  </form>

  <script>
    document.getElementById("searchForm").addEventListener("submit", function(e) {
      e.preventDefault();

      var input = document.getElementById("nameBuscaRut").value.trim();
      if (input.length < 9) {
        e.preventDefault();
        alert("El campo debe tener al menos 9 caracteres.");
      } else {
        $.ajax({
            url: "./controller/buscar.php",
            method: "POST",
            data: {
              nameBuscaRut: input
            }
          })
          .done(function(respuesta) {
            //alert('LA RESPUESTA ES:'+respuesta)
            console.log('200 LA RESPUESTA ES id:', respuesta)
            window.location.href = "mostrar.php?id=" + respuesta

          })
          .fail(function(error) {
            //alert('400??LA RESPUESTA ES:'+respuesta)
            console.error(error)
            $('body').append(error.responseText);
          })
          .always(function(respuesta) {
            console.info("LA RESPUESTA: ", respuesta)
          });
      }



    });

    document.getElementById("nameBuscaRut").addEventListener("input", function() {
      var input = this.value.trim();
      var btnBuscar = document.getElementById("btnNavbarSearch");

      if (input.length >= 9) {
        btnBuscar.removeAttribute("disabled");
      } else {
        btnBuscar.setAttribute("disabled", "disabled");
      }
    });
  </script>

  <!-- Navbar-->
  <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
</svg></a>
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