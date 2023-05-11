
<?php
$sqlCategoria = "SELECT IDCat, NombreCat FROM categoria";
$resultadoCategoria = mysqli_query($conn, $sqlCategoria);
echo '<span class="obligatorio">* </span>';
echo "<label for='idSelectCat'>Seleccione Categoría: </label>"; //Label 
echo "<select name='nameSelectCat' id='idSelectCat' class='form-select'>";
echo '<option value=""> Selecciona una opción</option>'; // Opción por defecto en blan
while ($fila = mysqli_fetch_assoc($resultadoCategoria)) {
    echo "<option value='" . $fila['IDCat'] . "'>" . $fila['NombreCat'] . "</option>";
}
echo "</select>";
// Cierre de la conexión
?>