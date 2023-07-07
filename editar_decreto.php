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
if (isset($_GET['idd'])) {
    $iddecreto = $_GET['idd']; //ID DEL DECRETO


    // $idpersona = "SELECT IDTra FROM decretos WHERE IDdecreto = '$iddecreto' LIMIT 1 ";
    // $resultp = mysqli_query($conn, $idpersona);
    // if (mysqli_num_rows($resultp) == 1) {
    //     $idtra = mysqli_fetch_assoc($resultp);
    // }




    $decre = "SELECT tra.IDTra,tra.NombreTra, tra.PaternoTra, tra.MaternoTra, tra.Rut, l.NombreLug, s.NombreSector, c.NombreCon, d.NDecreto, c.IDCon, d.FechaDoc, d.FechaInicio,d.FechaTermino,l.IDLugar, s.IDSector, d.RutaCon
    FROM decretos d
    INNER JOIN trabajador tra ON (tra.IDTra= d.IDTra)
    INNER JOIN lugar l ON (l.IDLugar = d.IDLugar)
    INNER JOIN sector s ON (s.IDSector = d.IDSector)
    INNER JOIN contrato c ON (c.IDCon = d.IDCon)
    WHERE IDdecreto = '$iddecreto'";
    $resultDecreto = mysqli_query($conn, $decre);
    if (mysqli_num_rows($resultDecreto) == 1) {
        $de = mysqli_fetch_assoc($resultDecreto);
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
    <title>Editar Usuario</title>
    <link rel="icon" type="image/png" href="./assets/img/favicon-32x32.png">
    <link href="./assets/styles/styles.css" rel="stylesheet" />
    <link href="./assets/styles/form.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="sb-nav-fixed">
    <?php require("./components/navbar.php") ?>
    <div id="layoutSidenav">
        <?php require("./components/sidebar.php") ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-md">
                    <form id="EdicionDecretos" enctype="multipart/form-data" method="POST" autocomplete="off">
                        <input name="nameidtrab" value="<?php echo $de['IDTra'] ?>" id="idtrabid" hidden>
                        <input name="nameiddec" value="<?php echo $iddecreto ?>" id="iddec" hidden>
                        <input type="text" name="nameRutt" value="<?php echo $de['Rut'] ?>" hidden>

                        <div class="title">
                            <h1 class="mt-4">Editar Decreto</h1>
                        </div>
                        <br>
                        <div class="seccion">
                            <div id="document-container">
                                <div class="row ">
                                    <div class="col-md-3">
                                        <label for="idRutInput"><span style="color: #f36f03;">*</span> Rut</label>
                                        <input type="text" name="nameRut" id="idRutInputdec" class="form-control" maxlength="10" value="<?php echo $de['Rut'] ?>" disabled>
                                        <br>
                                    </div>
                                    <div class="col-md-7">
                                        <label for="idPersona"><span style="color: #c40055;">*</span> Nombre</label>
                                        <input type="text" name="namePersona" id="idPersona" class="form-control" value="<?php echo $de['NombreTra'] . ' ' . $de['PaternoTra'] . ' ' . $de['MaternoTra'] ?>" disabled>
                                        <br>
                                    </div>
                                    <div class="col-md-2">
                                    <label for="archivo">Archivo</label>

                                        <div class="contenedor-botones" id="archivo">
                                            <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $de['RutaCon']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                            <a href="<?php echo $de['RutaCon'] ?>" download class="btn btn-primary boton-descargar w-100" style="border-top-right-radius: 6px !important;    border-bottom-right-radius: 6px !important;"><i class="fa-sharp fa-solid fa-download"></i></a>

                                        </div>
                                    </div>
                                </div>
                                <div class="row document">
                                    <div class="col-md-6 col-sm-6"> <!-- TIPO DE CONTRATO -->
                                        <?php
                                        $sqlTipoContrato = "SELECT IDCon, NombreCon FROM contrato";
                                        $resultadoContrato = mysqli_query($conn, $sqlTipoContrato);
                                        echo "<label for='idSelectCon'><span style='color: #c40055;'>*</span> Tipo de Contrato </label>";

                                        echo "<select name='nameSelectCon' id='idSelectCon' class='form-select' required onchange='indefinido()'>";
                                        echo '<option value="" hidden> Selecciona</option>';
                                        while ($fila = mysqli_fetch_assoc($resultadoContrato)) {
                                            $seleccionado = ($fila['IDCon'] == $de['IDCon']) ? 'selected' : '';
                                            echo "<option value='" . $fila['IDCon'] . "' " . $seleccionado . ">" . $fila['NombreCon'] . "</option>";
                                        }
                                        echo "</select>";
                                        ?>

                                        <br>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label for="idDecreto"><span style="color: #c40055;">*</span> N° Decreto</label>
                                        <input type="text" name="nameDecreto" value="<?php echo $de['NDecreto'] ?>" class="form-control" maxlength="10" >
                                        <br>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label for="idFechaDocumento"><span style="color: #c40055;">*</span> Fecha de Documento</label>
                                        <input type="date" name="nameFechaDocumento" value="<?php echo $de['FechaDoc'] ?>" class="form-control" id="idFechaDocumento" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6 document">
                                        <label for="idDocContratoInput"><span style="color: #c40055;">*</span> Subir o cambiar archivo</label>
                                        <div class="input-group">
                                            <input type="file" id="idDocContratoInput" name="nameDocContratoInput" class="form-control" accept=".pdf">
                                            <button class="button" type="button" onclick="clearFileInput('idDocContratoInput')">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="art">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6"> <!-- LUGAR -->
                                                <label for="idSelectLugar"><span style="color: #c40055;">*</span> Lugar</label>
                                                <select name="nameSelectLugar" id="idSelectLugar" class="form-select" required onchange="cargarSectores()">
                                                    <option value="" hidden> Selecciona</option>
                                                    <?php
                                                    $sqlLugar = "SELECT IDLugar, NombreLug FROM lugar";
                                                    $resultadoLugar = mysqli_query($conn, $sqlLugar);
                                                    while ($fila2 = mysqli_fetch_assoc($resultadoLugar)) {
                                                        $lugarseleccionado = ($fila2['IDLugar'] == $de['IDLugar']) ? 'selected' : '';
                                                        echo "<option value='" . $fila2['IDLugar'] . "' " . $lugarseleccionado . ">" . $fila2['NombreLug'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <label for="idSelectSector"><span style="color: #c40055;">*</span> Sector</label>
                                                <select name="nameSelectSector" id="idSelectSector" class="form-select" required onchange="cargarSectores()">
                                                    <option value="" hidden>Selecciona un Sector</option>
                                                    <?php
                                                    $sqlSector = "SELECT IDSector, NombreSector FROM sector";
                                                    $resultadoSector = mysqli_query($conn, $sqlSector);
                                                    while ($fila3 = mysqli_fetch_assoc($resultadoSector)) {
                                                        $Sectorselected = ($fila3['IDSector'] == $de['IDSector']) ? "selected" : "";
                                                        echo "<option value='" . $fila3['IDSector'] . "' $Sectorselected>" . $fila3['NombreSector'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label for="idFechaInicio"><span style="color: #c40055;">*</span> Fecha de Inicio</label>
                                        <input type="date" name="nameFechaInicio" value="<?php echo $de['FechaInicio'] ?>" class="form-control" id="idFechaInicio" required>
                                        <br>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label for="idFechaTermino"><span style="color: #c40055;">*</span> Fecha de Termino</label>
                                        <input type="date" name="nameFechaTermino" value="<?php echo $de['FechaTermino'] ?>" class="form-control" id="idFechaTermino" required>
                                        <br>
                                    </div>
                                </div>
                            </div>


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
                                    <span>Registrar</span>
                                </button>
                            </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <!-- <script>
        $(document).ready(function() {
            // Llama a la función cargarSectores al cargar la página
            cargarSectores();

            // Asigna un evento de cambio al campo de selección de lugar
            $('#idSelectLugar').change(cargarSectores);
        });

        // FUNCION QUE CARGA SECTOR SEGUN ID LUGAR
        function cargarSectores() {
            const lugarSeleccionado = document.getElementById("idSelectLugar").value;
            $.ajax({
                url: './controller/lugar_sector.php',
                method: "POST",
                data: {
                    lugarSeleccionado: lugarSeleccionado
                },
                dataType: 'json',
                success: function(respuesta) {
                    let largo = respuesta.length;
                    $("#idSelectSector").empty();

                    for (let i = 0; i < largo; i++) {
                        let idSector = respuesta[i]['IDSector'];
                        let nombreSector = respuesta[i]['NombreSector'];
                        $("#idSelectSector").append("<option value='" + idSector + "'>" + nombreSector + "</option>");
                    }
                },
                error: function(error) {
                    console.error("ERROR", error.responseText);
                }
            });
        }
    </script> -->
    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/doc_exclusivos.js"></script>
    <script src="./assets/js/validaciones_input.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>