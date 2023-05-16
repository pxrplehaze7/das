<?php
        if (!empty($persona['RutaAFP'])) {
            echo '<br>
            <div class="container afp">
                <div class="row doc">
                    <div class="col-sm-4 col-md-6 titulo">
                        <a href="' . $persona['RutaAFP'] . '" target="_blank">Certificado de Afiliacion a AFP</a>
                    </div>
                    <div class="archivos-ver col-sm-4 col-md-3">
                        <a href="' . $persona['RutaAFP'] . '" target="_blank">Visualizar <i class="fa-solid fa-expand"></i></a>
                    </div>
                    <div class="archivos-ver col-sm-4 col-md-3">
                        <a href="' . $persona['RutaAFP'] . '" download>Descargar <i class="fa-sharp fa-solid fa-download"></i></a>
                    </div>
                </div>
            </div>';
        } else {
            echo '
            <br>

            <div class="container afp">
                <div class="row doc">
                    <div class="col-sm-6 col-md-8 titulo pendiente">
                        <a>Certificado de Afiliacion a AFP</a>
                    </div>
                    <div class="archivos-ver col-sm-6 col-md-4 pendiente">
                        <center><a>Documento Pendiente <i class="fa-sharp fa-solid fa-clock"></i></a></center>
                    </div>
                </div>
            </div>';
        }