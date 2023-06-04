

<?php


$sql = "SELECT AKLJSDLA FROM trabajador WHERE ";

if($_POST['aplica'] != "0" ){
    $sql .= " cumple = '".$_POST['aplica']."'   ";

    if($_POST['lugar'] != "0"){
        $sql .= " AND lugar = ".$_POST['lugar']." ";
    }

    if($_POST['SECTOR'] != "0"){
        $sql .= " AND SECTOR = ".$_POST['SECTOR']." ";
    }


}elseif($_POST['lugar'] != "0"){
    $sql .= " lugar = ".$_POST['lugar']." ";

    if($_POST['SECTOR'] != "0"){
        $sql .= " AND SECTOR = ".$_POST['SECTOR']." ";
    }

    
}elseif($_POST['SECTOR'] != "0"){
    $sql .= " SECTOR = ".$_POST['SECTOR']." ";


}



//EJECUTAR LA QUERY



// y armar php
// echo "<tr>
// <td>$res['lugar']</td>
// </tr>"

?>

