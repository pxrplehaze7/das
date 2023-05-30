<?php
if (!empty($persona['RutaAFP'])) { ?>
    <div class="contenedor-botones">
        <button class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaAFP']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
        <a href="' . $persona['RutaAFP'] . '" download class="btn btn-primary boton-descargar d-edit w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
        <button class="btn btn-danger w-100 boton-eliminar"><i class="fa-solid fa-trash"></i></button>
    </div>
    
<?php } else { ?>
    <div class="contenedor-botones">
        <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
    </div>
<?php } ?>