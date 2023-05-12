<?php
// Conectar a la base de datos
include("./controller/config/conexion.php");

// Obtener el rut enviado por GET
if (isset($_POST['nameBuscaRut'])) {
    $rut = $_POST['nameBuscaRut'];

    // Realizar la consulta para obtener la información de la persona
    $sqlDatosTra = "SELECT cat.NombreCat, con.NombreCon, afp.NombreAFP, pre.NombrePrev, lug.NombreLug, NombreTra, PaternoTra, MaternoTra, Rut, Sexo, Profesion, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaDJur,RutaSerM, RutaSCom, RutaExaM, Observ
                  FROM trabajador tra
                  INNER JOIN categoria cat  ON (cat.IDCat   = tra.IDCat)
                  INNER JOIN contrato con   ON (con.IDCon   = tra.IDCon)
                  INNER JOIN afp afp        ON (afp.IDAFP   = tra.IDAFP)
                  INNER JOIN lugar lug      ON (lug.IDLugar = tra.IDLugar)
                  INNER JOIN prevision pre ON (pre.IDPrev  = tra.IDPrev)
                  WHERE Rut='$rut' LIMIT 1";

    $resultadoDatosTra = mysqli_query($conn, $sqlDatosTra);


    // Verificar si se encontró la persona en la base de datos
    if (mysqli_num_rows($resultadoDatosTra) == 1) {
        // Obtener la información de la persona
        $persona = mysqli_fetch_assoc($resultadoDatosTra);

        // Cerrar la conexión a la base de datos  
        mysqli_close($conn);
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
    <title>Perfil del Trabajador</title>
    <!-- cdn jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <!-- cdn css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- estilo de registro -->
    <link href="./assets/css/registroPersonal.css" rel="stylesheet">
    <!-- revisa si el rut ya existe -->
    <script src="./assets/js/revisa_rut.js"></script>

</head>

<body>
    <header>
        <?php include("./controller/navbar.php") ?>
    </header>
    <div class="container-md">

        <form class="documentosObligatorios" enctype="multipart/form-data" method="POST">
            <center>
                <h2><?php echo $persona['NombreTra'] . ' ' . $persona['PaternoTra'] . ' ' . $persona['MaternoTra'] ?></h1>
            </center>
            <br>
            <div class="datosPersonales-ver seccion">

                <div class="primerGrupo row ">
                    <p>Datos Personales</p>
                    <div class="rut-ver col-md">
                        <label>Rut</label>
                        <input value="<?php echo $persona['Rut'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="genero-ver col-md">
                        <label>Género</label>
                        <input value="<?php echo $persona['Sexo'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>

                <div class="segundoGrupo row">
                    <div class="contrato-ver col-md">
                        <label>Tipo de Contrato </label>
                        <input value="<?php echo $persona['NombreCon'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="lugar-ver col-md">
                        <label>Lugar de Trabajo</label>
                        <input value="<?php echo $persona['NombreLug'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>

                <div class="tercerGrupo row">
                    <div class="categoria-ver col-md">
                        <label>Categoria </label>
                        <input value="<?php echo $persona['NombreCat'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="profesion-ver col-md">
                        <label>Profesion</label>
                        <input value="<?php echo $persona['Profesion'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>

                <div class="cuartoGrupo row">
                    <div class="otros-ver col-md">
                        <label>AFP</label>
                        <input value="<?php echo $persona['NombreAFP'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                    <div class="profesion-ver col-md">
                        <label>Previsión de Salud</label>
                        <input value="<?php echo $persona['NombrePrev'] ?>" class="form-control" readonly>
                        <br>
                    </div>
                </div>

            </div>

            <br>

            <div class="datosContacto seccion">
                <p>Datos de Contacto</p>
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


            <div class="documentacion seccion">
                <p>Documentación</p>

                <div class="c-nacimiento row"> <!-- CERTIFICADO DE NACIMIENTO -->
                    <div class="col-md">
                        <h6>Certificado de Nacimiento</h6>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaNac']; ?>" target="_blank">VER</a>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaNac']; ?>" download>DESCARGAR</a>
                    </div>
                </div>

                <div class="cedula row"> <!-- CEDULA DE IDENTIDAD -->
                    <div class="col-md">
                        <h6>Fotocopia de Cédula de Identidad</h6>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaCedula']; ?>" target="_blank">VER</a>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaCedula']; ?>" download>DESCARGAR</a>
                    </div>
                </div>

                <div class="antecedentes row"> <!-- ANTECEDENTES -->
                    <div class="col-md">
                        <h6>Certificado de Antecedentes</h6>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaAntec']; ?>" target="_blank">VER</a>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaAntec']; ?>" download>DESCARGAR</a>
                    </div>
                </div>

                <div class="curriculum row"> <!-- CURRICULUM -->
                    <div class="col-md">
                        <h6>Curriculum Vitae</h6>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaCV']; ?>" target="_blank">VER</a>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaCV']; ?>" download>DESCARGAR</a>
                    </div>
                </div>

                <div class="estudios row"> <!-- CERTIFICADO DE ESTUDIOS-->
                    <div class="col-md">
                        <h6>Certificado de Estudios o Título Profesional</h6>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaEstudio']; ?>" target="_blank">VER</a>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaEstudio']; ?>" download>DESCARGAR</a>
                    </div>
                </div>

                <div class="servicioMilitar row"> <!-- SERVICIO MILITAR hacer que se vea solo si existe -->
                    <div class="col-md">
                        <h6>Certificado de Servicio Militar al Día</h6>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaSerM']; ?>" target="_blank">VER</a>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaSerM']; ?>" download>DESCARGAR</a>
                    </div>
                </div>

                <div class="afp row"> <!-- AFP -->
                    <div class="col-md">
                        <h6>Certificado de Afiliacion a AFP</h6>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaAFP']; ?>" target="_blank">VER</a>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaAFP']; ?>" download>DESCARGAR</a>
                    </div>
                </div>

                <div class="declaracion row"> <!-- DECLARACION JURADA -->
                    <div class="col-md">
                        <h6>Declaración Jurada</h6>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaDJur']; ?>" target="_blank">VER</a>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaDJur']; ?>" download>DESCARGAR</a>
                    </div>
                </div>

                <div class="saludCompatible row"> <!-- SALUD COMPATIBLE -->
                    <div class="col-md">
                        <h6>Certificado de Salud Compatible</h6>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaSCom']; ?>" target="_blank">VER</a>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaSCom']; ?>" download>DESCARGAR</a>
                    </div>
                </div>

                <div class="examenMedico row"> <!-- EXAMEN MEDICO UNICO NACIONAL hacer que se vea solo si existe -->
                    <div class="col-md">
                        <h6>Examen Médico Único Nacional</h6>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaExaM']; ?>" target="_blank">VER</a>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaExaM']; ?>" download>DESCARGAR</a>
                    </div>
                </div>

                <div class="prevision row"> <!-- CEDULA DE IDENTIDAD -->
                    <div class="col-md">
                        <h6>Certificado de Afiliación a Sistema de Salud </h6>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaPrev']; ?>" target="_blank">VER</a>
                    </div>
                    <div class="archivos-ver col-md">
                        <a href="<?php echo $persona['RutaPrev']; ?>" download>DESCARGAR</a>
                    </div>
                </div>

            </div>

            <script src="./assets/js/main.js"></script>
            <!-- cdn js de boostrap -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>