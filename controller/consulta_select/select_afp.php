<?php
 $sqlAFP = "SELECT IDAFP, NombreAFP FROM afp";
 $resultadoAFP = mysqli_query($conn, $sqlAFP);

 echo "<label for='idSelectAFP'>AFP </label>"; //Label 
 echo "<select name='nameSelectAFP' id='idSelectAFP' class='form-select'>";
 echo '<option value="" hidden="hidden"> Selecciona una AFP</option>'; // Opción por defecto en blanco

 while ($fila = mysqli_fetch_assoc($resultadoAFP)) {
     echo "<option value='" . $fila['IDAFP'] . "'>" . $fila['NombreAFP'] . "</option>";
 }
 echo "</select>";
