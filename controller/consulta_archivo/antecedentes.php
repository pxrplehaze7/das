<?php
if (!empty($persona['RutaAntec'])) {
    echo '
        <div class="documento">
            <div class="container">
                <div class="row doc flex-wrap">
                    <div class="col-md-6 titulo d-flex align-items-center">
                        <a class="a">Certificado de Antecedentes</a>
                    </div>
                    <div class="col-md-6 contenedor-botones">
                        <button class="btn btn-primary boton-ver w-100" onclick="window.open(\'' . $persona['RutaAntec'] . '\', \'_blank\')">Visualizar <i class="fa-solid fa-expand"></i></button>
                        <a href="' . $persona['RutaAntec'] . '" download class="btn btn-primary boton-descargar w-100">Descargar <i class="fa-sharp fa-solid fa-download"></i></a>
                    </div>
                </div>
            </div>
        </div>';
} else {
    echo '
            <div class="documento">
                <div class="container">
                    <div class="row doc flex-wrap">
                        <div class="col-md-6 titulo d-flex align-items-center">
                            <a class="a">Certificado de Antecedentes</a>
                        </div>

                        <div class="col-md-6 contenedor-botones">
                        <button disabled class="btn btn-primary pendiente w-100">Documento Pendiente <i class="fa-sharp fa-solid fa-clock"></i></button>
                        </div>
                    </div>
                </div>
            </div>';
}

