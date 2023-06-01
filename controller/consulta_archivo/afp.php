<?php
if (!empty($persona['RutaAFP'])) { ?>
    <div class="contenedor-botones">
        <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $persona['RutaAFP']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
        <a href="<?php echo $persona['RutaAFP']?>" download class="btn btn-primary boton-descargar w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
        <button type="button" class="btn btn-danger w-100 boton-eliminar" onclick="event.preventDefault(); deleteFile('RutaAFP', '<?php echo $persona['Rut']; ?>')"><i class="fa-solid fa-trash"></i></button>
    </div>
    
<?php } else { ?>
    <div class="contenedor-botones">
        <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
    </div>
<?php } ?>