<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="./assets/img/logo.png" width="40px" alt="Descripción de la imagen"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registro.php">Registrar</a>
        </li>
      </ul>
      <form class="d-flex" role="search" action="mostrar.php" method="POST">
        <input class="form-control me-2" name="nameBuscaRut" type="search" placeholder="Buscar Rut">
        <button class="btn btn-buscar" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>