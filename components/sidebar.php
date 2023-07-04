<div id="layoutSidenav_nav">
  <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
      <div class="nav">
        <div class="sb-sidenav-menu-heading">Principal</div>
        <a class="nav-link" href="home.php">
          <div class="sb-nav-link-icon">
            <i class="fas fa-tachometer-alt"></i>
          </div>
          Inicio
        </a>
        <?php
        if ($_SESSION['rol'] === '1') { ?>
          <div class="sb-sidenav-menu-heading">Registro</div>

          <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseTrabajador" aria-expanded="false" aria-controls="collapseTrabajador">
            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
            Trabajador
            <div class="sb-sidenav-collapse-arrow">
              <i class="fas fa-angle-down"></i>
            </div>
          </a>
          <div class="collapse" id="collapseTrabajador" aria-labelledby="headingTrabajador" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionTrabajador">
              <a class="nav-link" href="registro_contrata_i.php">
                A Contrata e Indefinidos
              </a>

              <a class="nav-link" href="registro_honorario.php">
                A honorarios
              </a>
            </nav>
          </div>

          <a class="nav-link" href="registrar_usuario.php">
            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
            Usuario
          </a>

        <?php } ?>


        <div class="sb-sidenav-menu-heading">Tablas</div>


        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseListaTrabajadores" aria-expanded="false" aria-controls="collapseListaTrabajadores">
          <div class="sb-nav-link-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z" />
            </svg>
          </div>
          Lista de Trabajadores
          <div class="sb-sidenav-collapse-arrow">
            <i class="fas fa-angle-down"></i>
          </div>
        </a>
        <div class="collapse" id="collapseListaTrabajadores" aria-labelledby="headingListaTrabajadores" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionListaTrabajadores">
            <a class="nav-link" href="lista_contrata_i.php">
              A Contrata e Indefinidos
            </a>

            <a class="nav-link" href="lista_honorarios.php">
              A honorarios
            </a>
          </nav>
        </div>


        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseListaDecretos" aria-expanded="false" aria-controls="collapseListaDecretos">
          <div class="sb-nav-link-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z" />
            </svg>
          </div>
          Lista de Decretos
          <div class="sb-sidenav-collapse-arrow">
            <i class="fas fa-angle-down"></i>
          </div>
        </a>
        <div class="collapse" id="collapseListaDecretos" aria-labelledby="headingListaDecretos" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionListaDecretos">
            <a class="nav-link" href="lista_decretos_c.php">
              A Contrata e Indefinidos
            </a>

            <a class="nav-link" href="lista_decretos_h.php">
              A honorarios
            </a>
          </nav>
        </div>


        <?php
        if ($_SESSION['rol'] === '1') { ?>
          <a class="nav-link" href="lista_usuarios.php">
            <div class="sb-nav-link-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z" />
              </svg>
            </div>
            Lista de Usuarios
          </a>
        <?php } ?>
      </div>
    </div>


    <div class="sb-sidenav-footer">

      <div class="small">Usuario conectado como:</div>
      <?php
      if (isset($_SESSION['nombre'])) {
        $nombreCompleto = $_SESSION['nombre'];
        echo "<div>$nombreCompleto</div>";
      }
      ?>
    </div>
  </nav>
</div>