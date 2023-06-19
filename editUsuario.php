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

if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];
    $user = "SELECT * FROM usuario WHERE IDUsuario = '$idUsuario'";
    $ruser = mysqli_query($conn, $user);

    if (mysqli_num_rows($ruser) == 1) {
        $us = mysqli_fetch_assoc($ruser);
    }
} else {
    echo "No se recibió ningún ID de usuario";
}

?>

<?php include("./controller/config/conexion.php"); ?>
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
    <div id="layoutSidenav">
        <?php require("./components/navbar.php") ?>
        <?php require("./components/sidebar.php") ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-md">
                    <form id="editU" method="POST">
                        <input name="nameidu" value="<?php echo $idUsuario ?>" class="form-control" id="iduser" hidden>

                        <div class="title">

                            <div class="ti">
                                <h1 class="mt-4">Editar Usuario</h1>
                            </div>

                            <div class="container-volver">
                                <a class="button-volver" href="tablaU.php">
                                    Volver <i class="fas fa-reply" style="display: flex; align-items: center; margin-left:6px;"></i>
                                </a>
                            </div>

                        </div>

                        <br>
                        <div class="seccion">

                            <div class="row ">

                                <div class="col-md">
                                    <label for="idRutInput"><span style="color: #f36f03;">*</span> Rut</label>
                                    <input type="text" name="nameRut" value="<?php echo $us['RutU'] ?>" id="idRutInput" class="form-control" maxlength="10" required>
                                    <br>
                                </div>

                                <div class="col-md">
                                    <label for="idPersona"><span style="color: #c40055;">*</span> Nombres</label>
                                    <input type="text" name="namePersona" value="<?php echo $us['NombreU'] ?>" id="idPersona" class="form-control" oninput="validarTexto(this)" required>
                                    <br>
                                </div>
                                <div class="col-md">
                                    <label for="idAppat"><span style="color: #c40055;">*</span> Apellido Paterno</label>
                                    <input type="text" name="namePaterno" value="<?php echo $us['ApellidoP'] ?>" id="idAppat" class="form-control" oninput="validarTexto(this)" required>
                                    <br>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 17px;">
                                <div class="col-md">
                                    <label for="idApmat">Apellido Materno</label>
                                    <input type="text" name="nameMaterno" value="<?php echo $us['ApellidoM'] ?>" id="idApmat" class="form-control" oninput="validarTexto(this)">
                                    <br>
                                </div>
                                <div class="col-md">
                                    <label for="idCorreo"><span style="color: #c40055;">*</span> Correo Electrónico</label>
                                    <input type="text" name="nameCorreo" value="<?php echo $us['CorreoU'] ?>" id="idCorreo" class="form-control" required>
                                    <br>
                                </div>
                                <div class="col-md">
                                    <label><span style="color: #c40055;">*</span> Tipo de permiso</label>
                                    <select class="form-control" id="idPermiso" name="namePermiso" required>
                                        <option value=1 <?php if ($us['Rol'] == 1) echo 'selected'; ?>>Administrador</option>
                                        <option value=0 <?php if ($us['Rol'] == 0) echo 'selected'; ?>>Solo lectura</option>
                                    </select>
                                    <br>
                                </div>
                            </div>


                            <div class="d-flex justify-content-center align-items-center">
                                <div class="d-flex justify-content-between">
                                    <button class="Btn2 resets" id="btnEditaDoc" type="submit">Actualizar
                                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                        </svg>
                                    </button>
                    </form>

                    <form method="POST" id="resetP">
                        <input type="text" name="nameRut" value="<?php echo $us['RutU'] ?>" id="rutuser" hidden>
                        <input name="nameidu" value="<?php echo $idUsuario ?>" class="form-control" id="iduser" hidden>
                        <button class="Btn2-restablece resets" id="resetpass" type="submit">Restablecer Contraseña <i class="fa-solid fa-lock"></i>
                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                            </svg>
                        </button>
                    </form>
                </div>
        </div>
    </div>

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