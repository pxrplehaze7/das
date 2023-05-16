<?php
include("./controller/config/conexion.php");

// Obtener el rut enviado por POST
if (isset($_POST['nameBuscaRut'])) {
    $rut = $_POST['nameBuscaRut']; //se asigna el valor del input rut a $rut

    // Realizar la consulta para obtener la información de la persona WHERE el rut de base de datos sea igual al $rut
    $sqlDatosTra = "SELECT cat.NombreCat, con.NombreCon, afp.NombreAFP, pre.NombrePrev, lug.NombreLug, NombreTra, PaternoTra, MaternoTra, Sector, Decreto, Rut, Genero, Profesion, Medico, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaContrato, RutaDJur,RutaSerM, RutaSCom, RutaExaM, Observ
                  FROM trabajador tra
                  INNER JOIN categoria cat  ON (cat.IDCat   = tra.IDCat)
                  INNER JOIN contrato con   ON (con.IDCon   = tra.IDCon)
                  INNER JOIN afp afp        ON (afp.IDAFP   = tra.IDAFP)
                  INNER JOIN lugar lug      ON (lug.IDLugar = tra.IDLugar)
                  INNER JOIN prevision pre ON (pre.IDPrev  = tra.IDPrev)
                  WHERE Rut='$rut' LIMIT 1";

    $resultadoDatosTra = mysqli_query($conn, $sqlDatosTra);

    // Verificar si se encontró una persona en la base de datos con el valor de $rut
    if (mysqli_num_rows($resultadoDatosTra) == 1) {
        // Si se encuentra una persona, se asigna el resultado a $persona
        $persona = mysqli_fetch_assoc($resultadoDatosTra);

        // Cerrar la conexión a la base de datos  
        // mysqli_close($conn);
    } else {
        echo "No se encontró ninguna persona con el rut ingresado";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Trabajador</title>

    <!-- cdn css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- cdn iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- estilo de registro -->
    <link href="./assets/css/registroPersonal.css" rel="stylesheet">
    <!-- estilo menu -->
    <link href="./assets/css/menu.css" rel="stylesheet">


</head>

<body>
    <header>
        <?php include("./controller/navbar.php") ?>
    </header>
    <div class="container-md">

        <div>

            <center>
                <h2><?php echo $persona['NombreTra'] . ' ' . $persona['PaternoTra'] . ' ' . $persona['MaternoTra'] ?></h1>
            </center>
            <br>

            <div class="datosPersonales-ver seccion">

                <div class="primerGrupo row ">
                    <h6>Datos Personales</h6>
                    <div class="rut-ver col-md">
                        <label>Rut</label>
                        <input value="<?php echo $persona['Rut'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="genero-ver col-md">
                        <label>Género</label>
                        <input value="<?php echo $persona['Genero'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>

                <div class="segundoGrupo row">
                    <div class="categoria-ver col-md">
                        <label>Categoria </label>
                        <input value="<?php echo $persona['NombreCat'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="contrato-ver col-md">
                        <label>Tipo de Contrato </label>
                        <input value="<?php echo $persona['NombreCon'] ?>" class="form-control" readonly>
                        <br>
                    </div>

                </div>

                <div class="tercerGrupo row">
                    <div class="lugar-ver col-md">
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
                <div class="cuartoGrupo row">

                    <div class="profesion-ver col-md">
                        <label>Profesion</label>
                        <input value="<?php echo $persona['Profesion'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="genero-ver col-md">
                        <label>Genero</label>
                        <input value="<?php echo $persona['Genero'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>

                <div class="quintoGrupo row">
                    <div class="afp-ver col-md">
                        <label>AFP</label>
                        <input value="<?php echo $persona['NombreAFP'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="prevision-ver col-md">
                        <label>Previsión de Salud</label>
                        <input value="<?php echo $persona['NombrePrev'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
            </div>


            <br>

            <div class="datosContacto seccion">
                <h6>Datos de Contacto</h6>
                <div class="cuartoGrupo row">
                    <div class="celular-ver col-md">
                        <label>Celular </label>
                        <input value="<?php echo $persona['CelularTra'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <br>
                    <div class="correo-ver col-md">
                        <label>Correo</label>
                        <input value="<?php echo $persona['CorreoTra'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>
            </div>
            <br>







            <!-- -------------- -->


            <div class="documentacion seccion">
                <h6>Documentación</h6>
                <?php include('./controller/consulta_archivo/certificadoNac.php') ?>

                <br>

                <?php include('./controller/consulta_archivo/antecedentes.php') ?>

                <br>

                <?php include('./controller/consulta_archivo/curriculum.php') ?>


                <br>
                <div class="container estudios"> <!-- CERTIFICADO DE ESTUDIOS-->
                    <div class="row doc">
                        <div class="col-sm-4 col-md-6 titulo">
                            <a href="<?php echo $persona['RutaEstudio']; ?>" target="_blank">Certificado de Estudios o Título Profesional</a>
                        </div>
                        <div class="archivos-ver col-sm-4 col-md-3">
                            <a href="<?php echo $persona['RutaEstudio']; ?>" target="_blank">Visualizar <i class="fa-solid fa-expand"></i></a>
                        </div>
                        <div class="archivos-ver col-sm-4 col-md-3">
                            <a href="<?php echo $persona['RutaEstudio']; ?>" download>Descargar <i class="fa-sharp fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>


                <?php include('./controller/consulta_archivo/servicioMilitar.php') ?>
                <br>
                <?php include('./controller/consulta_archivo/fotocopiaCedula.php') ?>

                <br>
                <?php include('./controller/consulta_archivo/fotocopiaCedula.php') ?>

                <div class="container afp"> <!-- AFP -->
                    <div class="row doc">
                        <div class="col-sm-4 col-md-6 titulo">
                            <a href="<?php echo $persona['RutaAFP']; ?>" target="_blank">Certificado de Afiliacion a AFP</a>
                        </div>
                        <div class="archivos-ver col-sm-4 col-md-3">
                            <a href="<?php echo $persona['RutaAFP']; ?>" target="_blank">Visualizar <i class="fa-solid fa-expand"></i></a>
                        </div>
                        <div class="archivos-ver col-sm-4 col-md-3">
                            <a href="<?php echo $persona['RutaAFP']; ?>" download>Descargar <i class="fa-sharp fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container declaracion"> <!-- DECLARACION JURADA -->
                    <div class="row doc">
                        <div class="col-sm-4 col-md-6 titulo">
                            <a href="<?php echo $persona['RutaDJur']; ?>" target="_blank">Declaración Jurada</a>
                        </div>
                        <div class="archivos-ver col-sm-4 col-md-3">
                            <a href="<?php echo $persona['RutaDJur']; ?>" target="_blank">Visualizar <i class="fa-solid fa-expand"></i></a>
                        </div>
                        <div class="archivos-ver col-sm-4 col-md-3">
                            <a href="<?php echo $persona['RutaDJur']; ?>" download>Descargar <i class="fa-sharp fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container saludCompatible"> <!-- SALUD COMPATIBLE -->
                    <div class="row doc">
                        <div class="col-sm-4 col-md-6 titulo">
                            <a href="<?php echo $persona['RutaSCom']; ?>" target="_blank">Certificado de Salud Compatible</a>
                        </div>
                        <div class="archivos-ver col-sm-4 col-md-3">
                            <a href="<?php echo $persona['RutaSCom']; ?>" target="_blank">Visualizar <i class="fa-solid fa-expand"></i></a>
                        </div>
                        <div class="archivos-ver col-sm-4 col-md-3">
                            <a href="<?php echo $persona['RutaSCom']; ?>" download>Descargar <i class="fa-sharp fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>
                <?php include('./controller/consulta_archivo/examenMedico.php') ?>
                <br>
                <div class="container prevision">
                    <div class="row doc">
                        <div class="col-sm-4 col-md-6 titulo">
                            <a href="<?php echo $persona['RutaPrev']; ?>" target="_blank">Certificado de Afiliación a Sistema de Salud</a>
                        </div>
                        <div class="archivos-ver col-sm-4 col-md-3">
                            <a href="<?php echo $persona['RutaPrev']; ?>" target="_blank">Visualizar <i class="fa-solid fa-expand"></i></a>
                        </div>
                        <div class="archivos-ver col-sm-4 col-md-3">
                            <a href="<?php echo $persona['RutaPrev']; ?>" download>Descargar <i class="fa-sharp fa-solid fa-download"></i></a>
                        </div>
                    </div>

                </div>

            </div>

            <script src="./assets/js/main.js"></script>
            <script src="./assets/js/doc_exclusivos.js"></script>
            <!-- cdn js de boostrap -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>

</html>