<?php
if (!empty($persona['RutaContrato'])) { ?>
    <div class="contenedor-botones">
        <button class="btn btn-primary w-100 boton-ver" onclick="window.open('<?php echo $persona['RutaContrato']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
        <a href="' . $persona['RutaContrato'] . '" download class="btn btn-primary w-100 boton-descargar"><i class="fa-sharp fa-solid fa-download"></i></a>
    </div>

<?php } else { ?>
    <div class="contenedor-botones">
        <button disabled class="btn btn-primary w-100 pendiente"><i class="fa-sharp fa-solid fa-clock"></i></button>
    </div>
<?php } ?>