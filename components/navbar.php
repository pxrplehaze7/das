<?php
include("./controller/config/conexion.php");

?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <!-- Navbar Brand-->
  <a class="navbar-brand ps-3" href="home.php"><img src="./assets/img/logo.png" width="30px"> DAS Chiguayante</a>
  <!-- Sidebar Toggle-->
  <button class="btn btn-link btn-sm order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
    </svg></button>
  <!-- Navbar Search-->
  <!-- <form class="d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="resultados.php" method="POST" id="searchForm">
    <div class="input-group">
      <input class="form-control" type="text" name="nameBuscaRut" id="nameBuscaRut" placeholder="19876543-K" pattern="^\d{7,8}-[kK\d]$" maxlength="10" minlength="9" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
      <button class="btn btn-primary btn-buscar" id="btnNavbarSearch" type="submit" disabled><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg>
</button>
    </div>
  </form> -->

 

  <!-- Navbar-->
  <ul class="navbar-nav ms-auto me-3 me-lg-4">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
</svg></a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

        <li> <a class="dropdown-item" href="editar_mi_perfil.php">Editar perfil</a></li>


        <li>
          <hr class="dropdown-divider" />
        </li>
        <li><a class="dropdown-item" href="./controller/logout.php">Cerrar Sesión</a></li>
      </ul>
    </li>
  </ul>
</nav>
<!-- 
<script>
        document.getElementById("searchForm").addEventListener("submit", function(e) {
            e.preventDefault();

            var input = document.getElementById("nameBuscaRut").value.trim();
            if (input.length < 9) {
                e.preventDefault();
                alert("El campo debe tener al menos 9 caracteres.");
            } else {
                $.ajax({
                        url: "./controller/buscar_persona.php",
                        method: "POST",
                        data: {
                            rut: input
                        }
                    })
                    .done(function(respuesta) {
                        //alert('LA RESPUESTA ES:'+respuesta)
                        console.log('200 LA RESPUESTA ES id:', respuesta)
                       console.log('el rut a buscar es:', input)

                        window.location.href = "resultados.php?rut=" + input

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
    </script> -->