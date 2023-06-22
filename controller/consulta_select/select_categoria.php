<?php
$sqlCategoria = "SELECT IDCat, NombreCat FROM categoria";
$resultadoCategoria = mysqli_query($conn, $sqlCategoria);
echo "<label for='idSelectCat'><span style='color: #c40055;'>*</span> Categoría </label>"; 
echo "<select name='nameSelectCat' id='idSelectCat' class='form-select' required>";
echo '<option hidden value=""> Selecciona</option>'; 
while ($fila = mysqli_fetch_assoc($resultadoCategoria)) {
    echo "<option value='" . $fila['IDCat'] . "'>" . $fila['NombreCat'] . "</option>";
}
echo "</select>";
?>

