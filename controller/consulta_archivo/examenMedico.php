<?php
    if ($persona['Medico'] == 'Si') {
        if (!empty($persona['RutaExaM'])) {
            echo '<br>
            <div class="container examenMedico">
                <div class="row doc">
                    <div class="col-sm-4 col-md-6 titulo">
                        <a href="' . $persona['RutaExaM'] . '" target="_blank">Examen Único Nacional de Conocimientos de Medicina</a>
                    </div>
                    <div class="archivos-ver col-sm-4 col-md-3">
                        <a href="' . $persona['RutaExaM'] . '" target="_blank">Visualizar <i class="fa-solid fa-expand"></i></a>
                    </div>
                    <div class="archivos-ver col-sm-4 col-md-3">
                        <a href="' . $persona['RutaExaM'] . '" download>Descargar <i class="fa-sharp fa-solid fa-download"></i></a>
                    </div>
                </div>
            </div>';
        } else {
            echo '
            <br>
            <div class="container examenMedico">
                <div class="row doc">
                    <div class="col-sm-6 col-md-8 titulo pendiente">
                        <a>Examen Único Nacional de Conocimientos de Medicina</a>
                    </div>
                    <div class="archivos-ver col-sm-6 col-md-4 pendiente">
                        <center><a>Documento en estado pendiente</a></center>
                    </div>
                </div>
            </div>';
        }
    }
