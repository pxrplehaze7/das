<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SB Admin</title>
    <link href="./assets/styles/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="./assets/img/favicon-32x32.png">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .center-card {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;

        }

        .fondo-inicio {
            background-image: url(./assets/img/bg5.jpg);

        }


        .form {
            position: relative;
            display: flex;
            flex-direction: column;
            border-radius: 0.75rem;
            background-color: #fff;
            color: rgb(97 97 97);
            box-shadow: 20px 20px 30px rgba(0, 0, 0, .05);
            width: 90%;
            background-clip: border-box;
            padding-top: 20px;
        }

        .header {
            position: relative;
            background-clip: border-box;
            background-color: #314385;
            border-radius: 0.75rem;
            overflow: hidden;
            color: #fff;
            box-shadow: 0 0 #0000, 0 0 #0000, 0 0 #0000, 0 0 #0000, rgba(33, 150, 243, .4);
            height: 7rem;
            letter-spacing: 0;
            line-height: 1.375;
            font-weight: 600;
            font-size: 1.9rem;
            font-family: Roboto, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 20px;
            margin-right: 20px;
        }

        .inputs {
            padding: 1.5rem;
            gap: 1rem;
            display: flex;
            flex-direction: column;
        }

        .input-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            min-width: 200px;
            width: 100%;
            height: 2.75rem;
            position: relative;
        }

        .input {
            border: 1px solid rgba(128, 128, 128, 0.61);
            outline: 0;
            color: rgb(69 90 100);
            font-weight: 400;
            font-size: .9rem;
            line-height: 1.25rem;
            padding: 0.75rem;
            background-color: transparent;
            border-radius: .375rem;
            width: 100%;
            height: 100%;
        }

        .input:focus {
            border: 1px solid #1e88e5;
        }




        button {
            --primary-color: #314385;
            --secondary-color: #fff;
            --hover-color: #2f6999;
            --arrow-width: 10px;
            --arrow-stroke: 2px;
            box-sizing: border-box;
            border: 0;
            border-radius: 0.75rem;
            color: var(--secondary-color);
            padding: 13px;
            background: var(--primary-color);
            display: flex;
            transition: 0.2s background;
            align-items: center;
            gap: 0.6em;
            font-weight: bold;
            font-size: 18px;
        }

        button .arrow-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        button .arrow {
            margin-top: 1px;
            width: var(--arrow-width);
            background: var(--primary-color);
            height: var(--arrow-stroke);
            position: relative;
            transition: 0.2s;
        }

        button .arrow::before {
            content: "";
            box-sizing: border-box;
            position: absolute;
            border: solid var(--secondary-color);
            border-width: 0 var(--arrow-stroke) var(--arrow-stroke) 0;
            display: inline-block;
            top: -3px;
            right: 3px;
            transition: 0.2s;
            padding: 3px;
            transform: rotate(-45deg);
        }

        button:hover {
            background-color: var(--hover-color);
        }

        button:hover .arrow {
            background: var(--secondary-color);
        }

        button:hover .arrow:before {
            right: 0;
        }
    </style>
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
                                        <?php

                                        if (isset($_SESSION['login_error']) && $_SESSION['login_error']) {
                                            echo '<div class="alert alert-danger" role="alert">Correo o contraseña incorrectos. Por favor, intenta nuevamente.</div>';
                                            $_SESSION['login_error'] = false;
                                        }
                                        ?>

                                        <form action="./controller/login.php" method="POST" class="form">

                                            <div class="contenedor-login">
                                                <div class="header">Iniciar Sesión</div>
                                                <div class="inputs">
                                                    <input class="input" id="inputEmail" type="email" placeholder="Correo Electrónico" name="correoL" required>
                                                    <input class="input" id="inputPassword" type="password" placeholder="Contraseña" name="contrasennaL" required>





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