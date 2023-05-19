<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Trabajador</title>

    <!-- cdn css bootstrap -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- cdn iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- estilo de registro -->
    <link href="./assets/css/styles.css" rel="stylesheet">
    <!-- estilo menu -->
    <link href="./assets/css/menu.css" rel="stylesheet">
    <!-- sweet alert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <header>
        <?php include("./controller/navbar.php") ?>
    </header>
    <?php if (isset($persona)) { ?>
        <div class="container-md">
            <h1>Información Personal</h1>
            <br>
            <div class="seccion">
                <div class="row ">
                    <h6>Datos Personales</h6>
                    <form action="calificaciones.php" method="POST">
                        <input type="hidden" name="nameRutCalifica" value="<?php echo $persona['Rut'] ?>">
                        <button class="btn btn-calificacion" type="submit">Calificaciones <i class="fa-solid fa-arrow-up-right-from-square"></i></button>
                    </form>
                    <div class="col-md">
                        <label>Rut</label>
                        <input value="<?php echo $persona['Rut'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="col-md">
                        <label> Nombres</label>
                        <input value="<?php echo $persona['NombreTra'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md">
                        <label> Apellido Paterno</label>
                        <input value="<?php echo $persona['PaternoTra'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="col-md">
                        <label>Apellido Materno</label>
                        <input value="<?php echo $persona['MaternoTra'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md">
                        <label>Género</label>
                        <input value="<?php echo $persona['Genero'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="col-md">
                        <label>Tipo de Contrato </label>
                        <input value="<?php echo $persona['NombreCon'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label>Categoria </label>
                        <input value="<?php echo $persona['NombreCat'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label>Lugar de Trabajo</label>
                        <input value="<?php echo $persona['NombreLug'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="sector-ver col-md">
                        <label>Sector</label>
                        <input value="<?php echo $persona['Sector'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label>Profesion</label>
                        <input value="<?php echo $persona['Profesion'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="col-md">
                        <label>Genero</label>
                        <input value="<?php echo $persona['Genero'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label>AFP</label>
                        <input value="<?php echo $persona['NombreAFP'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="col-md">
                        <label>Previsión de Salud</label>
                        <input value="<?php echo $persona['NombrePrev'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-md">
                        <label>Celular </label>
                        <input value="<?php echo $persona['CelularTra'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <br>
                    <div class="col-md">
                        <label>Correo</label>
                        <input value="<?php echo $persona['CorreoTra'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
            </div>
            <br>
            <div class="documentacion seccion">
                <h6>Documentación</h6>
                <br>
                <?php include('./controller/consulta_archivo/contrato.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/declaracionJ.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/certificadoNac.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/antecedentes.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/fotocopiaCedula.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/curriculum.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/estudios.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/saludCompatible.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/afp.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/consultaPrev.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/examenMedico.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/servicioMilitar.php') ?>
            </div>
        <?php } ?>
        <!-- cdn js de boostrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
       s <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
</body>
</html>
