<?php
include("./config/conexion.php");
$sqlF = "SELECT * FROM trabajador";

if ($_POST['cumple'] != "") {
    $sqlF .= " WHERE ";

    if ($_POST['cumple'] != "") {
        $sqlF .= "Cumple = '" . $_POST['cumple'] . "' ";
    }
}

$resultadoF = mysqli_query($conn, $sqlF);
if (!$resultadoF) {
    echo "Error en la consulta: " . mysqli_error($conn);
    exit;
}

while ($ptotalr = mysqli_fetch_assoc($resultadoF)) { ?>

            <tr>
                <td class="align-middle"><?php echo $ptotalr['Rut'] ?></td>
                <td class="align-middle"><?php echo $ptotalr['NombreTra']; ?></td>
                <td class="align-middle"><?php echo $ptotalr['PaternoTra'] . ' ' . $ptotalr['MaternoTra']; ?></td>
                <td class="align-middle"><?php echo $ptotalr['Profesion'] ?></td>
                <td class="align-middle"><?php echo $ptotalr['CelularTra'] ?></td>
                <td class="align-middle"><?php echo $ptotalr['CorreoTra'] ?></td>

                <td class="align-middle" style="text-align: center; font-weight: 700;">
                    <?php
                    if ($ptotalr['Cumple'] == 1) {
                        echo '<span style="color: #00886f;">Si cumple</span>';
                    } else {
                        echo '<span style="color: #c40055;">No cumple</span>';
                    }
                    ?>
                </td>

                <td class="contenedor-ir" style="vertical-align: middle; text-align: center;">
                    <a class="a-ir" href="info_contrata.php?id=<?php echo $ptotalr['IDTra']; ?> " style="text-decoration: none;">
                        <span>Ir <i class="fa-solid fa-circle-arrow-right"></i></span>
                    </a>
                </td>
            </tr>
        <?php } ?>
  
