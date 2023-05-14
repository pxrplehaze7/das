
<?php
    $sqlTipoContrato = "SELECT IDCon, NombreCon FROM contrato";
    $resultadoContrato = mysqli_query($conn, $sqlTipoContrato);
    echo "<label for='idSelectCon'>Tipo de Contrato </label>"; //Label 
    echo "<select name='nameSelectCon' id='idSelectCon' class='form-select'>";
    echo '<option value=""> Selecciona un Contrato</option>'; // Opción por defecto en blanco

    while ($fila = mysqli_fetch_assoc($resultadoContrato)) {
        echo "<option value='" . $fila['IDCon'] . "'>" . $fila['NombreCon'] . "</option>";
    }
    echo "</select>";
?>
