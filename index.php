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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
                                                        <span class="togglePassword"> 
                                                            <i id="toggleIcon" class="fas fa-eye" onclick="togglePasswordVisibility()"></i>
                                                        </span>
                                                    </div>

                                                    <button style="justify-content: center;border-radius: 20px;"> Entrar
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
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('inputPassword');
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>