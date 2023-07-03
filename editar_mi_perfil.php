<?php
session_start();
include("./controller/config/conexion.php");

if (!isset($_SESSION['rol'])) {
    header('Location: index.php');
    exit();
}
if (isset($_SESSION['idperfil'])) {
    echo $_SESSION['idperfil'];
    $idUsuario = $_SESSION['idperfil'];
    $datosperfil = "SELECT * FROM usuario WHERE IDUsuario='$idUsuario' LIMIT 1";
    $resultDatosperfil = mysqli_query($conn, $datosperfil);
    if (mysqli_num_rows($resultDatosperfil) == 1) {
        $miperfil = mysqli_fetch_assoc($resultDatosperfil);
        $nombre = $miperfil['NombreU'];
        $apellidop = $miperfil['ApellidoP'];
        $apellidom = $miperfil['ApellidoM'];
        $correo = $miperfil['CorreoU'];
        $idper = $miperfil['IDUsuario'];
        $pass = $miperfil['Contrasenna'];
    } else {
        echo "No se encontraron datos de perfil";
        exit();
    }
} else {
    echo "No se ha establecido la variable de sesión 'idperfil'";
    exit();
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Editar mi Perfil</title>
    <link rel="icon" type="image/png" href="./assets/img/favicon-32x32.png">
    <link href="./assets/styles/styles.css" rel="stylesheet" />
    <link href="./assets/styles/form.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php require("./components/navbar.php"); ?>
    <div id="layoutSidenav">
        <?php require("./components/sidebar.php"); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-md">
                    <form id="miperfil" method="POST" autocomplete="off">
                        <div class="title">
                            <h1 class="mt-4">Editar mis datos</h1>
                        </div>
                        <br>
                        <div class="seccion">
                            <input name="idperson" id="idPersonaperfil" value="<?php echo $idper ?> " type="hidden">
                            <div class="row ">
                                <div class="col-md">
                                    <label for="idPersona"><span style="color: #c40055;">*</span> Nombres</label>
                                    <input type="text" name="namePersona" id="idPersona" value="<?php echo $nombre; ?>" class="form-control" oninput="validarTexto(this)" required>
                                </div>
                                <div class="col-md">
                                    <label for="idAppat"><span style="color: #c40055;">*</span> Apellido Paterno</label>
                                    <input type="text" name="namePaterno" id="idAppat" value="<?php echo $apellidop; ?>" class="form-control" oninput="validarTexto(this)" required>
                                </div>
                                <div class="col-md">
                                    <label for="idApmat">Apellido Materno</label>
                                    <input type="text" name="nameMaterno" id="idApmat" value="<?php echo $apellidom; ?>" class="form-control" oninput="validarTexto(this)">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <label for="idCorreop"><span style="color: #c40055;">*</span> Correo Electrónico</label>
                                    <input type="text" name="nameCorreo" id="idCorreop" value="<?php echo $correo; ?>" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <label for="idPass"><span style="color: #c40055;">*</span> Cambiar Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" name="namePassNueva" id="idPass" class="form-control" autocomplete="new-password">
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="height: 38px;border-top-right-radius: 5px;border-bottom-right-radius: 5px;border-bottom-left-radius: 0px;border-top-left-radius: 0px;">
                                                <i id="toggleIcon" class="fas fa-eye" onclick="togglePasswordVisibility()"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <br>
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
                                    <span>Guardar</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('idPass');
            var toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

    <script src="./assets/js/sidebar.js"></scripT>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/doc_exclusivos.js"></script>
    <script src="./assets/js/validaciones_input.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>