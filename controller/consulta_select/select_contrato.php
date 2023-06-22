<?php
    $sqlTipoContrato = "SELECT IDCon, NombreCon FROM contrato";
    $resultadoContrato = mysqli_query($conn, $sqlTipoContrato);
    echo "<label for='idSelectCon'><span style='color: #c40055;'>*</span> Tipo de Contrato </label>";
    echo "<select name='nameSelectCon' id='idSelectCon' class='form-select' required onchange='honorario()'>";
    echo '<option value="" hidden> Selecciona</option>'; 
    while ($fila = mysqli_fetch_assoc($resultadoContrato)) {
        echo "<option value='" . $fila['IDCon'] . "'>" . $fila['NombreCon'] . "</option>";
    }
    echo "</select>";
?>
