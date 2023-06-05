

<?php
include("./config/conexion.php");

$sqlF = "SELECT Rut, Decreto, NombreTra, PaternoTra, MaternoTra, Profesion, IDLugar, IDSector, Cumple FROM trabajador WHERE ";

if($_POST['cumple'] != "0" ){
    $sqlF .= " cumple = '".$_POST['cumple']."'   ";

    if($_POST['lugar'] != "0"){
        $sqlF .= " AND lugar = ".$_POST['lugar']." ";
    }

    if($_POST['sector'] != "0"){
        $sqlF .= " AND sector = ".$_POST['sector']." ";
    }


}elseif($_POST['lugar'] != "0"){
    $sqlF .= " lugar = ".$_POST['lugar']." ";

    if($_POST['sector'] != "0"){
        $sqlF .= " AND sector = ".$_POST['sector']." ";
    }

    
}elseif($_POST['sector'] != "0"){
    $sqlF .= " sector = ".$_POST['sector']." ";


}

//EJECUTAR LA QUERY
while ($ptotal = mysqli_fetch_assoc($resultadoF)) { ?>
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


