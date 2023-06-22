<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Iniciar Sesión</title>
    <link rel="icon" type="image/png" href="./assets/img/favicon-32x32.png">
    <link href="./assets/styles/index.css" rel="stylesheet" />
    <link href="./assets/styles/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="fondo-inicio">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row  d-flex align-items-center justify-content-center">
                        <div class="col-lg-5 center-card">
                            <div class="" style="width: 100%;">
                                <div class="l">
                                    <div class="card-body" style="display: flex;justify-content: center;">

                                        <form action="./controller/login.php" method="POST" class="form">
                                            <div class="contenedor-login">
                                                <div class="header">Iniciar Sesión</div>
                                                <div class="contenedor-alerta">
                                                    <?php
                                                    if (isset($_SESSION['login_error']) && $_SESSION['login_error']) {
                                                        echo '<div class="alert alert-danger alerta-login" role="alert" >Correo Electrónico o contraseña incorrectos.<br>Por favor, intenta nuevamente.</div>';
                                                        $_SESSION['login_error'] = false;
                                                    }
                                                    ?>
                                                </div>
                                                <div class="inputs">
                                                    <div class="inputGroup">
                                                        <input id="inputEmail" type="text" name="correoL" required>
                                                        <label for="inputEmail">Correo Electrónico</label>
                                                    </div>
                                                    <div class="inputGroup">
                                                        <input id="inputPassword" type="password" name="contrasennaL" required>
                                                        <label for="inputPassword">Contraseña</label>
                                                    </div>
                                                    <button style="justify-content: center;">
                                                        Entrar
                                                        <div class="arrow-wrapper">
                                                            <div class="arrow"></div>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>