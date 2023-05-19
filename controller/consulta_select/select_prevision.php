<?php
$sqlPrevision = "SELECT IDPrev, NombrePrev FROM prevision";
$resultadoPrevision = mysqli_query($conn, $sqlPrevision);
echo "<label for='idSelectCat'>Previsión </label>"; //Label 
echo "<select name='nameSelectPrev' id='idSelectPrev' class='form-select' required>";
echo '<option hidden value=1> Selecciona una Previsión</option>'; // Opción por defecto en blanco

while ($fila = mysqli_fetch_assoc($resultadoPrevision)) {
    echo "<option value='" . $fila['IDPrev'] . "'>" . $fila['NombrePrev'] . "</option>";
}
echo "</select>";
