<?php
$sqlPrevision = "SELECT IDPrev, NombrePrev FROM prevision";
$resultadoPrevision = mysqli_query($conn, $sqlPrevision);
echo "<label for='idSelectCat'><span style='color: #c40055;'>*</span> Previsión </label>"; 
echo "<select name='nameSelectPrev' id='idSelectPrev' class='form-select' required>";
echo '<option hidden value=1> Selecciona</option>'; 
while ($fila = mysqli_fetch_assoc($resultadoPrevision)) {
    echo "<option value='" . $fila['IDPrev'] . "'>" . $fila['NombrePrev'] . "</option>";
}
echo "</select>";
?>