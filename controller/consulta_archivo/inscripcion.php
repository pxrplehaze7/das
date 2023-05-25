<br>
<?php
if (!empty($persona['RutaInscripcion'])) { ?>
    <div class="col-md-6 contenedor-botones">
        <button class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaInscripcion']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
        <a href="' . $persona['RutaInscripcion'] . '" download class="btn btn-primary boton-descargar w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
    </div>
<?php } else { ?>
    <div class="col-md-6 contenedor-botones">
        <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
    </div>
<?php } ?>