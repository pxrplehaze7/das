<?php
$sqlPrevision = "SELECT IDPrev, NombrePrev FROM prevision";
$resultadoPrevision = mysqli_query($conn, $sqlPrevision);
echo "<select name='nameSelectPrev' id='idSelectPrev' class='form-select'>";
echo '<option value=""> Selecciona una opción</option>'; // Opción por defecto en blanco

while ($fila = mysqli_fetch_assoc($resultadoPrevision)) {
    echo "<option value='" . $fila['IDPrev'] . "'>" . $fila['NombrePrev'] . "</option>";
}
echo "</select>";
