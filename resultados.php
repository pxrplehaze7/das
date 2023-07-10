<?php
session_start();

include("./config/conexion.php");
$rut = $_POST['nameBuscaRut'];
$sql = "(SELECT IDTraH, NombreH, PaternoH, MaternoH, Rut, Genero, Inscripcion, Profesion, Medico, CelularH, CorreoH, RutaCV, RutaAntec, RutaCedula, RutaEstudio, RutaExaM, RutaInscripcion, Observ
         FROM honorario
         WHERE Rut='$rut' LIMIT 1)
        UNION
        (SELECT cat.NombreCat, afp.NombreAFP, pre.NombrePrev, tra.IDAFP, tra.IDPrev, tra.IDTra, NombreTra, PaternoTra, MaternoTra, Rut, Genero, Inscripcion, Profesion, Medico, CelularTra, CorreoTra, RutaPrev, RutaCV, RutaAFP, RutaNac, RutaAntec, RutaCedula, RutaEstudio, RutaDJur, RutaSerM, RutaSCom, RutaExaM, RutaInscripcion, Observ
         FROM trabajador tra
         INNER JOIN categoria cat ON (cat.IDCat = tra.IDCat)
         INNER JOIN afp afp ON (afp.IDAFP = tra.IDAFP)
         INNER JOIN prevision pre ON (pre.IDPrev = tra.IDPrev)
         WHERE Rut='$rut' LIMIT 1)";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (isset($row['IDTraH'])) {
            // Resultado encontrado en la tabla 'honorario'
            $IDTraH = $row['IDTraH'];
            $NombreH = $row['NombreH'];
            $PaternoH = $row['PaternoH'];
            // ... continuar con los demás campos de la tabla 'honorario'
            
            // Mostrar los datos en el formato deseado
            echo "Resultado encontrado en honorario:<br>";
            echo "ID: $IDTraH<br>";
            echo "Nombre: $NombreH<br>";
            echo "Apellido: $PaternoH<br>";
            // ... mostrar los demás campos de la tabla 'honorario'
            echo "<br>";
        } else {
            // Resultado encontrado en la tabla 'trabajador'
            $IDTra = $row['IDTra'];
            $NombreTra = $row['NombreTra'];
            $PaternoTra = $row['PaternoTra'];
            // ... continuar con los demás campos de la tabla 'trabajador'
            
            // Mostrar los datos en el formato deseado
            echo "Resultado encontrado en trabajador:<br>";
            echo "ID: $IDTra<br>";
            echo "Nombre: $NombreTra<br>";
            echo "Apellido: $PaternoTra<br>";
            // ... mostrar los demás campos de la tabla 'trabajador'
            echo "<br>";
        }
    }
} else {
    echo "No se encontraron resultados.";
}



?>
