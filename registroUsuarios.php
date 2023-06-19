<?php
include("./controller/config/conexion.php");
session_start();
if (!isset($_SESSION['rol'])) {
    header('Location: index.php');
    exit();
}
if ($_SESSION['rol'] !== '1') {
    header('Location: ./components/error.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Registro Usuarios</title>
    <!-- ESTILOS -->
    <link href="./assets/styles/styles.css" rel="stylesheet" />
    <link href="./assets/styles/form.css" rel="stylesheet" />
    <!-- cdn jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- cdn css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

    <!-- ICONOS -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>

<body class="sb-nav-fixed">
    <?php require("./components/navbar.php") ?>
    <div id="layoutSidenav">

        <?php require("./components/sidebar.php") ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-md">
                    <form id="registroU" method="POST">
                        <div class="title">
                            <h1 class="mt-4">Registro de Usuario</h1>
                        </div>
                        <br>
                        <div class="seccion">
                            <div class="alert alert-warning" role="alert">
                                Si el rut es 19876543-K la contraseña temporal será DAS19876543.
                            </div>
                            <div class="row ">
                                <div class="col-md">
                                    <label for="idRutInput"><span style="color: #f36f03;">*</span> Rut</label>
                                    <input type="text" name="nameRut" id="idRutInput" placeholder="19876543-K" class="form-control" maxlength="10" required>
                                    <br>
                                </div>
                                <div class="col-md">
                                    <label for="idPersona"><span style="color: #c40055;">*</span> Nombres</label>
                                    <input type="text" name="namePersona" id="idPersona" placeholder="Ingrese Nombres" class="form-control" oninput="validarTexto(this)" required>
                                    <br>
                                </div>
                                <div class="col-md">
                                    <label for="idAppat"><span style="color: #c40055;">*</span> Apellido Paterno</label>
                                    <input type="text" name="namePaterno" id="idAppat" placeholder="Ingrese Apellido" class="form-control" oninput="validarTexto(this)" required>
                                    <br>
                                </div>

                            </div>

                            <div class="row" style="padding-bottom: 17px;">
                                <div class="col-md">
                                    <label for="idApmat">Apellido Materno</label>
                                    <input type="text" name="nameMaterno" id="idApmat" placeholder="Ingrese Apellido" class="form-control" oninput="validarTexto(this)">
                                    <br>
                                </div>
                                <div class="col-md">
                                    <label for=" idCorreo"><span style="color: #c40055;">*</span> Correo Electrónico</label>
                                    <input type="text" name="nameCorreo" id="idCorreo" placeholder="correo@daschiguayante.cl" class="form-control" required>
                                    <br>
                                </div>

                                <div class="col-md">
                                    <label><span style="color: #c40055;">*</span> Tipo de Permiso</label>
                                    <select class="form-control" id="idPermiso" name="namePermiso" required>
                                        <option hidden value=""> Seleccione</option>
                                        <option value=1>Administrador</option>
                                        <option value=0>Solo lectura</option>
                                    </select>
                                    <br>
                                </div>

                            </div>


                            <div class="boton-registrar">
                                <button id="btnRegistrar" type="submit" class="boton-registrarB">
                                    <div class="svg-wrapper-1">
                                        <div class="svg-wrapper">
                                            <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z" fill="currentColor"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <span>Registrar</span>
                                </button>

                            </div>

                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script src="./assets/js/sidebar.js"></script> <!-- HACE QUE SE ENCOJA EL MENU LATERAL -->
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/doc_exclusivos.js"></script>
    <script src="./assets/js/validaciones_input.js"></script>
</body>

</html>