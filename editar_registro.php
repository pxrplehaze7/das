<?php
include("./controller/config/conexion.php");

// Obtener el rut enviado por POST
if (isset($_POST['nameRutEditar'])) {
    $rut = $_POST['nameRutEditar']; //se asigna el valor del input rut a $rut

    // Realizar la consulta para obtener la información de la persona WHERE el rut de base de datos sea igual al $rut
    $datosEditar = "SELECT cat.NombreCat, con.NombreCon, afp.NombreAFP, pre.NombrePrev, lug.NombreLug, con.IDCon, afp.IDAFP, cat.IDCat, pre.IDPrev, lug.IDLugar, IDTra, NombreTra, PaternoTra, MaternoTra, Sector, Decreto, Rut, Genero, Profesion, Medico, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaContrato, RutaDJur,RutaSerM, RutaSCom, RutaExaM, Observ
                  FROM trabajador tra
                  INNER JOIN categoria cat  ON (cat.IDCat   = tra.IDCat)
                  INNER JOIN contrato con   ON (con.IDCon   = tra.IDCon)
                  INNER JOIN afp afp        ON (afp.IDAFP   = tra.IDAFP)
                  INNER JOIN lugar lug      ON (lug.IDLugar = tra.IDLugar)
                  INNER JOIN prevision pre ON (pre.IDPrev  = tra.IDPrev)
                  WHERE Rut='$rut' LIMIT 1";



    $resultDatosEditar = mysqli_query($conn, $datosEditar);

    // Verificar si se encontró una persona en la base de datos con el valor de $rut
    if (mysqli_num_rows($resultDatosEditar) == 1) {
        // Si se encuentra una persona, se asigna el resultado a $persona
        $persona = mysqli_fetch_assoc($resultDatosEditar);
        $idtra = $persona['IDTra'];
        $contrato = $persona['IDCon'];
        $categoria = $persona['IDCat'];
        $afp = $persona['IDAFP'];
        $lugar = $persona['IDLugar'];
        $prevision = $persona['IDPrev'];
    }
} ?>
<?php include("./controller/config/conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Personal</title>
    <!-- cdn jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- cdn css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- cdn iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- estilo de registro -->
    <link href="./assets/css/styles.css" rel="stylesheet">
    <!-- estilo menu -->
    <link href="./assets/css/menu.css" rel="stylesheet">
    <!-- SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <header>
        <?php include("./controller/navbar.php") ?>
    </header>
    <div class="container-md">
        <form id="documentosObligatorios" enctype="multipart/form-data" method="POST">
            <h1>Registro de Trabajadores</h1>
            <br>
            <div class="seccion">
                <h6>Datos Personales</h6>
                <div class="row ">
                    <div class="col-md">
                        <label for="idRutInput"><span style="color: red;">*</span> Rut</label>
                        <input type="text" name="nameRut" id="idRutInput" value="<?php echo $persona['Rut'] ?>" placeholder="19876543-K" class="form-control" pattern="^\d{7,8}-[kK\d]$" maxlength="10" required>
                        <div id="rut-validation"></div>
                        <br>
                    </div>
                    <div class="col-md">
                        <label for="idPersona"><span style="color: red;">*</span> Nombres</label>
                        <input type="text" name="namePersona" id="idPersona" value="<?php echo $persona['NombreTra'] ?>" placeholder="Ingrese Nombres" class="form-control" required>
                        <br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md">
                        <label for="idAppat"><span style="color: red;">*</span> Apellido Paterno</label>
                        <input type="text" name="namePaterno" id="idAppat" value="<?php echo $persona['PaternoTra'] ?>" placeholder="Ingrese Apellido" class="form-control" required>
                        <br>
                    </div>
                    <div class="col-md">
                        <label for="idApmat">Apellido Materno</label>
                        <input type="text" name="nameMaterno" id="idApmat" value="<?php echo $persona['MaternoTra'] ?>" placeholder="Ingrese Apellido" class="form-control">
                        <br>
                    </div>
                </div>

                <div class="art">
                    <div class="row">
                        <div class="col-md-6"> <!-- TIPO DE CONTRATO -->
                            <?php
                            $sqlTipoContrato = "SELECT IDCon, NombreCon FROM contrato";
                            $resultadoContrato = mysqli_query($conn, $sqlTipoContrato);

                            echo "<label for='idSelectCon'><span style='color: red;'>*</span> Tipo de Contrato </label>"; //Label 
                            echo "<select name='nameSelectCon' id='idSelectCon' class='form-select' required>";
                            echo '<option value="" hidden>Selecciona un Contrato</option>'; // Opción por defecto en blanco

                            while ($fila = mysqli_fetch_assoc($resultadoContrato)) {
                                $selected = ($fila['IDCon'] == $contrato) ? 'selected' : '';
                                echo "<option value='" . $fila['IDCon'] . "' " . $selected . ">" . $fila['NombreCon'] . "</option>";
                            }
                            echo "</select>";
                            ?>

                            <br>
                        </div>
                        <div class="col-md-6"> <!-- CATEGORIA -->
                            <?php
                            $sqlCategoria = "SELECT IDCat, NombreCat FROM categoria";
                            $resultadoCategoria = mysqli_query($conn, $sqlCategoria);
                            echo "<label for='idSelectCat'><span style='color: red;'>*</span> Categoría </label>"; //Label 
                            echo "<select name='nameSelectCat' id='idSelectCat' class='form-select'> required";
                            echo '<option hidden value=""> Selecciona una Categoría</option>'; // Opción por defecto en blan
                            while ($fila = mysqli_fetch_assoc($resultadoCategoria)) {
                                $selected = ($fila['IDCat'] == $categoria) ? 'selected' : '';
                                echo "<option value='" . $fila['IDCat'] . "' " . $selected . ">" . $fila['NombreCat'] . "</option>";
                            }
                            echo "</select>";
                            // Cierre de la conexión
                            ?>


                            <br>
                        </div>
                        <br>
                    </div>
                    <div id="idPreguntaCat1" style="display:none;" class="row radioCentro">
                        <center>
                            <label><span style="color: red;">*</span> ¿Es médico?</label>
                        </center>
                        <div class="opciones">
                            <input type="radio" name="nameMedico" id="idSiMedico" value="Si" class="radioInput  form-check-input">
                            <label for="idSiMedico" class="radio label form-check-label">Sí</label>
                            <br>
                            <input type="radio" name="nameMedico" id="idNoMedico" value="No" class="radioInput form-check-input">
                            <label for="idNoMedico" class="radio label form-check-label">No</label>
                        </div>
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-md-6"> <!-- LUGAR -->
                            <?php
                            $sqlLugar = "SELECT IDLugar, NombreLug FROM lugar";
                            $resultadoLugar = mysqli_query($conn, $sqlLugar);
                            echo "<label for='idSelectLugar'><span style='color: red;'>*</span> Lugar </label>"; //Label 
                            echo "<select name='nameSelectLugar' id='idSelectLugar' class='form-select' required>";
                            echo '<option value="" hidden> Selecciona un Lugar</option>'; // Opción por defecto en blan
                            while ($fila = mysqli_fetch_assoc($resultadoLugar)) {
                                $selected = ($fila['IDLugar'] == $lugar) ? 'selected' : '';
                                echo "<option value='" . $fila['IDLugar'] . "' " . $selected . ">" . $fila['NombreLug'] . "</option>";
                            }
                            echo "</select>";
                            ?>

                            <br>
                        </div>
                        <div class="col-md-6">
                            <label for="idSelectSector">Sector:</label>
                            <select class="form-select" id="idSelectSector" name="nameSelectSector">
                                <option value="No Aplicaaa">No Aplica</option>
                                <?php
                                $sqlSector = "SELECT DISTINCT sector FROM trabajador";
                                $resultadoSector = mysqli_query($conn, $sqlSector);

                                while ($fila = mysqli_fetch_assoc($resultadoSector)) {
                                    if ($fila['sector'] == $persona['Sector']) {
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }

                                    echo "<option value='" . $fila['sector'] . "' " . $selected . ">" . $fila['sector'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="">
                        <label for="idProfesion"><span style="color: red;">*</span> Profesión</label>
                        <input type="text" name="nameProfesion" id="idProfesion" class="form-control" require>
                    </div>
                </div>
                <br>
                <div class="radioCentro row">
                    <center>
                        <label><span style="color: red;">*</span> Seleccione Género</label>
                    </center>
                    <div class="opciones">
                        <input type="radio" name="nameGenero" id="idFemenino" value="Femenino" required class="radioInput form-check-input">
                        <label for="idFemenino" class="radio form-check-label">Femenino</label>
                        <input type="radio" name="nameGenero" id="idMasculino" value="Masculino" required class="radioInput form-check-input">
                        <label for="idMasculino" class="radio form-check-label">Masculino</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="seccion">
                <h6>Datos de Contacto</h6>
                <div class="row">
                    <div class="col-6">
                        <label for="idCelular">Celular</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">+56</span>
                            <input type="text" name="nameCelular" id="idCelular" value="<?php echo $persona['CelularTra'] ?>" placeholder="987654321" class="form-control" maxlength="9">
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="idCorreo">Correo Electrónico</label>
                        <input type="text" name="nameCorreo" id="idCorreo" value="<?php echo $persona['CorreoTra'] ?>" placeholder="correo@daschiguayante.cl" class="form-control" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
                    </div>
                </div>
            </div>
            <br>
            <div class="seccion">
                <h6>Documentación</h6>
                <div class="row"> <!-- AFP -->
                    <div class=" col-md-3">
                        <?php
                        $sqlAFP = "SELECT IDAFP, NombreAFP FROM afp";
                        $resultadoAFP = mysqli_query($conn, $sqlAFP);

                        echo "<label for='idSelectAFP'>AFP </label>"; //Label 
                        echo "<select name='nameSelectAFP' id='idSelectAFP' class='form-select'> required";
                        echo '<option value=1 hidden> Selecciona una AFP</option>'; // Opción por defecto en blanco

                        while ($fila = mysqli_fetch_assoc($resultadoAFP)) {
                            $selected = ($fila['IDAFP'] == $lugar) ? 'selected' : '';
                            echo "<option value='" . $fila['IDAFP'] . "' " . $selected . ">" . $fila['NombreAFP'] . "</option>";
                        }
                        echo "</select>";

                        ?>
                    </div>
                    <div class="col-md-9">
                        <label for="idAFPinput">Certificado de Afiliación</label>
                        <div class="input-group">
                            <input type="file" id="idAFPinput" name="nameAFPdoc" class="form-control" accept=".pdf">
                            <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idAFPinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row"> <!-- PREVISION -->
                    <div class=" col-md-3">
                        <?php
                        $sqlPrevision = "SELECT IDPrev, NombrePrev FROM prevision";
                        $resultadoPrevision = mysqli_query($conn, $sqlPrevision);
                        echo "<label for='idSelectCat'>Previsión </label>"; //Label 
                        echo "<select name='nameSelectPrev' id='idSelectPrev' class='form-select' required>";
                        echo '<option hidden value=1> Selecciona una Previsión</option>'; // Opción por defecto en blanco

                        while ($fila = mysqli_fetch_assoc($resultadoPrevision)) {
                            $selected = ($fila['IDPrev'] == $prevision) ? 'selected' : '';
                            echo "<option value='" . $fila['IDPrev'] . "' " . $selected . ">" . $fila['NombrePrev'] . "</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                    <div class="col-md-9">
                        <label for="idPREVinput">Certificado de Afiliación</label>
                        <div class="input-group">
                            <input type="file" id="idPREVinput" name="namePREVdoc" class="form-control" accept=".pdf">
                            <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idPREVinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row"> <!-- DECRETO Y ARCHIVO DE CONTRATO -->
                    <div class="col-md-3">
                        <label for="idDecreto"><span style="color: red;">*</span> Decreto</label>
                        <input type="text" name="nameDecreto" id="idDecreto" class="form-control" maxlength="30">
                    </div>
                    <div class="col-md-9">
                        <label for="idDocContratoInput">Contrato</label>
                        <div class="input-group">
                            <input type="file" id="idDocContratoInput" name="nameDocContratoInput" class="form-control" accept=".pdf">
                            <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idDocContratoInput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                </div>
                <br>
                <div>
                    <label for="idNACinput">Certificado de Nacimiento</label>
                    <div class="input-group ">
                        <input type="file" id="idNACinput" name="nameNACdoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idNACinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
                <div>
                    <label for="idANTECEinput">Certificado de Antecedentes</label>
                    <div class="input-group ">
                        <input type="file" id="idANTECEinput" name="nameANTECEdoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idANTECEinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
                <div>
                    <label for="idCedulainput">Fotocopia Cédula de Identidad</label>
                    <div class="input-group ">
                        <input type="file" id="idCedulainput" name="nameCeduladoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idCedulainput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
                <div>
                    <label for="idCVinput">Curriculum Vitae</label>
                    <div class="input-group ">
                        <input type="file" id="idCVinput" name="nameCVdoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idCVinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <div id="examenMedico">
                    <br>
                    <label for="idExamenMinput">Examen Médico Unico Nacional</label>
                    <div class="input-group ">
                        <input type="file" id="idExamenMinput" name="nameExaMdoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idExamenMinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
                <div>
                    <label for="idEstudioinput">Certificado de Estudios o Título Profesional</label>
                    <div class="input-group ">
                        <input type="file" id="idEstudioinput" name="nameEstudiodoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idEstudioinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
                <div>
                    <label for="idDJuradainput">Declaración Jurada</label>
                    <div class="input-group ">
                        <input type="file" id="idDJuradainput" name="nameDJuradadoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idDJuradainput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
                <div>
                    <label for="idSCompatibleinput">Certificado de Salud Compatible</label>
                    <div class="input-group ">
                        <input type="file" id="idSCompatibleinput" name="nameSCompatibledoc" class="form-control" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idSCompatibleinput')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
                <div id="servicioMilitarHombre">
                    <label for="idMilitarDoc">Certificado de Servicio Militar Obligatorio al día</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="idMilitarDoc" name="nameMilitarDoc" accept=".pdf">
                        <button class="btn btn-limpiar" type="button" onclick="clearFileInput('idMilitarDoc')">Limpiar <i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <br>
            </div>
            <br>
            <div class="observaciones seccion">
                <h6>Observaciones</h6>
                <textarea id="idObserv" name="nameObserv" class="form-control" rows="5" cols="50" maxlength="1000"></textarea>
            </div>
            <br>
            <div class="boton">
                <button class="btn btn-enviar" type="submit">Registrar <i class="fa-solid fa-floppy-disk"></i></button>
            </div>
        </form>
    </div>

    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/doc_exclusivos.js"></script>

    <!-- cdn js de boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>