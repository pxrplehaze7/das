 <?php
    $sqlLugar = "SELECT IDLugar, NombreLug FROM lugar";
    $resultadoLugar = mysqli_query($conn, $sqlLugar);
    echo "<label for='idSelectLugar'>(*) Lugar </label>"; //Label 
    echo "<select name='nameSelectLugar' id='idSelectLugar' class='form-select'>";
    echo '<option value="" hidden> Selecciona un Lugar</option>'; // Opción por defecto en blan
    while ($fila = mysqli_fetch_assoc($resultadoLugar)) {
        echo "<option value='" . $fila['IDLugar'] . "'>" . $fila['NombreLug'] . "</option>";
    }
    echo "</select>";
    ?>
