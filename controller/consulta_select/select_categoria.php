<?php
$sqlCategoria = "SELECT IDCat, NombreCat FROM categoria";
$resultadoCategoria = mysqli_query($conn, $sqlCategoria);
echo "<label for='idSelectCat'><span style='color: #f36f03;'>*</span> Categoría </label>"; //Label 
echo "<select name='nameSelectCat' id='idSelectCat' class='form-select' required>";
echo '<option hidden value=""> Selecciona</option>'; // Opción por defecto en blan
while ($fila = mysqli_fetch_assoc($resultadoCategoria)) {
    echo "<option value='" . $fila['IDCat'] . "'>" . $fila['NombreCat'] . "</option>";
}
echo "</select>";
// Cierre de la conexión
?>

