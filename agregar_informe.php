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
if (isset($_GET['idh'])) {
    $idhonorario = $_GET['idh'];

    $datosinforme = "SELECT idTraH, Rut, NombreH, PaternoH, MaternoH FROM `honorario`
    WHERE IDTraH='$idhonorario' LIMIT 1";

    $datosinforme = mysqli_query($conn, $datosinforme);
    list($idH, $rut, $nombre, $paterno, $materno) = mysqli_fetch_row($datosinforme);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Informe</title>
    <link rel="icon" type="image/png" href="./assets/img/favicon-32x32.png">
    <link href="./assets/styles/styles.css" rel="stylesheet" />
    <link href="./assets/styles/form.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        .seccion {
            padding-top: 40px;
            padding-bottom: 80px;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <?php require("./components/navbar.php") ?>
    <div id="layoutSidenav">
        <?php require("./components/sidebar.php") ?>
        <div id="layoutSidenav_content">
            <main>
                <?php if (isset($datosinforme)) { ?>
                    <div class="container-md">
                        <form id="informelab" enctype="multi/form-data" method="POST">
                            <input id="idRut" name="nameRut" value="<?php echo $rut ?>" class="form-control" hidden>
                            <input name="nameIDH" value="<?php echo $idH ?>" class="form-control" hidden>

                            <div class="title">
                                <div class="ti">
                                    <h1 class="mt-4">Informe de Labores</h1>
                                </div>
                                <div class="container-volver">
                                    <a class="button-volver" href="info_honorario.php?idh=<?php echo $idH ?>">
                                        Volver <i class="fas fa-reply" style="display: flex; align-items: center; margin-left:6px;"></i>
                                    </a>
                                </div>
                            </div>
                            <br>
                            <div class="datosPersonales seccion">
                                <div class="row ">
                                    <div class="rut-ver col-md-3">
                                        <label for="idRutCa2">Rut</label>
                                        <input id="idRutCa2" name="nameRut2" value="<?php echo $rut ?>" class="form-control" disabled>
                                        <br>
                                    </div>
                                    <div class="nombre col-md-9">
                                        <label for="namePersonaCa"> Nombre Completo</label>
                                        <input type="text" name="namePersonaCa" value="<?php echo $nombre . ' ' . $paterno . ' ' . $materno ?>" id="idPersonaCa" class="form-control" disabled>
                                        <br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="nombre col-md-12">
                                                <label for="nameFuncion"><span style="color: #c40055;">*</span> Función</label>
                                                <input type="text" name="nameFuncion" id="idFuncion" class="form-control" required>
                                                <br>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="mes"><span style="color: #c40055;">*</span> Mes</label>
                                                <select name="namemes" class="form-select" id="mes">
                                                    <option hidden value=""> Selecciona</option>;
                                                    <option value="Enero">Enero</option>
                                                    <option value="Febrero">Febrero</option>
                                                    <option value="Marzo">Marzo</option>
                                                    <option value="Abril">Abril</option>
                                                    <option value="Mayo">Mayo</option>
                                                    <option value="Junio">Junio</option>
                                                    <option value="Julio">Julio</option>
                                                    <option value="Agosto">Agosto</option>
                                                    <option value="Septiembre">Septiembre</option>
                                                    <option value="Octubre">Octubre</option>
                                                    <option value="Noviembre">Noviembre</option>
                                                    <option value="Diciembre">Diciembre</option>
                                                </select>
                                                <br>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="idAnno"><span style="color: red;">*</span> Año</label>
                                                <input type="text" name="nameAnno" id="idAnno" class="form-control input-small" minlength="4" maxlength="4" placeholder="2023" required>
                                            <br>
                                            </div>
                                           
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <label for="idInformeInput"><span style="color: red;">*</span> Informe de Labores</label>
                                    <div class="input-group">
                                        <input type="file" id="idInformeInput" name="nameCalifdoc" class="form-control" accept=".pdf" required>
                                        <button class="button" type="button" onclick="clearFileInput('idInformeInput')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                        </button>
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
                                    <span>Agregar</span>
                                </button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </main>
        </div>
    </div>
    <script>
        $("#annoinforme").on("input", function() {
            var input = $(this).val();
            var regex = /^\d{4}-\d{4}$/;
            if (!regex.test(input)) {
                $(this).addClass("is-invalid");
            } else {
                $(this).removeClass("is-invalid");
            }
        });

        const annoinf = document.getElementById('idAnno');

        annoinf.addEventListener('input', annonum);

        function annonum(event) {
            const input = event.target;
            const sanitizedValue = input.value.replace(/[^0-9]/g, '');
            input.value = sanitizedValue;
        }
    </script>
    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/doc_exclusivos.js"></script>
    <script src="./assets/js/validaciones_input.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</body>

</html>