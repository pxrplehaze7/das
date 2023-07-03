<?php
include("./config/conexion.php");
$sqlF = "SELECT t.Rut, t.IDTra, t.NombreTra, t.PaternoTra, t.MaternoTra, t.Decreto, t.Profesion, l.NombreLug, s.NombreSector, t.CelularTra, t.CorreoTra, t.Cumple, c.NombreCon
FROM trabajador t 
INNER JOIN lugar l ON (l.IDLugar = t.IDLugar)
INNER JOIN sector s ON (s.IDSector = t.IDSector)
INNER JOIN contrato c ON (c.IDCon = t.IDCon)";

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
if (!$resultadoF) {
    echo "Error en la consulta: " . mysqli_error($conn);
    exit;
}
while ($ptotal = mysqli_fetch_assoc($resultadoF)) {
?>
    <tr>
        <td class="align-middle"><?php echo $ptotal['Rut']; ?></td>
        <td class="align-middle"><?php echo $ptotal['Decreto']; ?></td>
        <td class="align-middle"><?php echo $ptotal['NombreCon'] ?></td>
        <td class="align-middle"><?php echo $ptotal['NombreTra'] . ' ' . $ptotal['PaternoTra'] . ' ' . $ptotal['MaternoTra']; ?></td>
        <td class="align-middle"><?php echo $ptotal['Profesion']; ?></td>
        <td class="align-middle"><?php echo $ptotal['NombreLug']; ?></td>
        <td class="align-middle"><?php echo $ptotal['NombreSector']; ?></td>
        <td class="align-middle" style="text-align: center; font-weight: 700;">
            <?php
            if ($ptotal['Cumple'] == 1) {
                echo '<span style="color: #00886f;">Si cumple</span>';
            } else {
                echo '<span style="color: #c40055;">No cumple</span>';
            }
            ?>
        </td>
        <td style="vertical-align: middle;">
            <div class="container-ver" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                <a class="button-ir" href="info_contrata.php?id=<?php echo $ptotal['IDTra']; ?>">
                    <span style="display: flex; align-items: center;">
                        <i class="fas fa-share"></i>
                    </span>
                </a>
            </div>
        </td>
    </tr>
<?php } ?>