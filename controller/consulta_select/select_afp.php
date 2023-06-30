<?php
 $sqlAFP = "SELECT IDAFP, NombreAFP FROM afp";
 $resultadoAFP = mysqli_query($conn, $sqlAFP);

 echo "<label for='idSelectAFP'><span style='color: #c40055;'>*</span> AFP </label>";
 echo "<select name='nameSelectAFP' id='idSelectAFP' class='form-select' required>";
 echo '<option value=1 hidden> Selecciona</option>'; 

 while ($fila = mysqli_fetch_assoc($resultadoAFP)) {
     echo "<option value='" . $fila['IDAFP'] . "'>" . $fila['NombreAFP'] . "</option>";
 }
 echo "</select>";
