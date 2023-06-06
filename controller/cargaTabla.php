<?php
include("./config/conexion.php");

$sqlF = "SELECT t.Rut, t.Decreto, t.NombreTra, t.PaternoTra, t.MaternoTra, t.Profesion, l.NombreLug, s.NombreSector, t.Cumple 
         FROM trabajador t
         INNER JOIN lugar l ON (l.IDLugar = t.IDLugar)
         INNER JOIN sector s ON (s.IDSector = t.IDSector)";

if ($_POST['cumple'] != "" || $_POST['lugar'] != "0" || $_POST['sector'] != "0") {
    $sqlF .= " WHERE";

    if ($_POST['cumple'] != "") {
        $sqlF .= " t.Cumple = '" . $_POST['cumple'] . "' ";

        if ($_POST['lugar'] != "0") {
            $sqlF .= " AND t.IDLugar = '" . $_POST['lugar'] . "' ";
        }

        if ($_POST['sector'] != "0") {
            $sqlF .= " AND t.IDSector = '" . $_POST['sector'] . "' ";
        }
    } elseif ($_POST['lugar'] != "0") {
        $sqlF .= " t.IDLugar = '" . $_POST['lugar'] . "' ";

        if ($_POST['sector'] != "0") {
            $sqlF .= " AND t.IDSector = '" . $_POST['sector'] . "' ";
        }
    } elseif ($_POST['sector'] != "0") {
        $sqlF .= " t.IDSector = '" . $_POST['sector'] . "' ";
    }
}

$resultadoF = mysqli_query($conn, $sqlF);

// Verificar si se produjo un error en la consulta
if (!$resultadoF) {
    echo "Error en la consulta: " . mysqli_error($conn);
    exit;
}

// EJECUTAR LA QUERY
while ($ptotal = mysqli_fetch_assoc($resultadoF)) {
    ?>
    <tr>
        <td><?php echo $ptotal['Rut']; ?></td>
        <td><?php echo $ptotal['Decreto']; ?></td>
        <td><?php echo $ptotal['NombreTra'] . ' ' . $ptotal['PaternoTra'] . ' ' . $ptotal['MaternoTra']; ?></td>
        <td><?php echo $ptotal['Profesion']; ?></td>
        <td><?php echo $ptotal['NombreLug']; ?></td>
        <td><?php echo $ptotal['NombreSector']; ?></td>
        <td style="text-align: center; background-color: <?php echo ($ptotal['Cumple'] == 1) ? '#00c4a0' : '#c40055'; ?>; color: white; font-weight: bold;">
            <?php echo ($ptotal['Cumple'] == 1) ? 'Si cumple' : 'No cumple'; ?>
        </td>
    </tr>
<?php } ?>
