<?php
if (!empty($persona['RutaContrato'])) { ?>
    <div class="contenedor-botones">
        <button type="button" class="btn btn-primary w-100 boton-ver" onclick="window.open('<?php echo $persona['RutaContrato']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
        <a href="<?php echo $persona['RutaContrato'] ?>" download class="btn btn-primary boton-descargar w-100"><i class="fa-sharp fa-solid fa-download"></i></a>
        <button type="button" class="btn btn-danger w-100 boton-eliminar" onclick="event.preventDefault(); deleteFile('RutaContrato', '<?php echo $persona['Rut']; ?>')"><i class="fa-solid fa-trash"></i></button>

    </div>

<?php } else { ?>
    <div class="contenedor-botones">
        <button disabled class="btn btn-primary w-100 pendiente"><i class="fa-sharp fa-solid fa-clock"></i></button>
    </div>
<?php } ?>