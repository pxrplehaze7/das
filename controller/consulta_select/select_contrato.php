
<?php
    $sqlTipoContrato = "SELECT IDCon, NombreCon FROM contrato";
    $resultadoContrato = mysqli_query($conn, $sqlTipoContrato);
    echo '<span class="obligatorio">* </span>';
    echo "<label for='idSelectCon'>Seleccione Contrato: </label>"; //Label 
    echo "<select name='nameSelectCon' id='idSelectCon' class='form-select'>";
    echo '<option value=""> Selecciona una opción</option>'; // Opción por defecto en blanco

    while ($fila = mysqli_fetch_assoc($resultadoContrato)) {
        echo "<option value='" . $fila['IDCon'] . "'>" . $fila['NombreCon'] . "</option>";
    }
    echo "</select>";
?>
