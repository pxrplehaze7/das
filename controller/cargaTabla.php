

<?php


$sql = "SELECT AKLJSDLA FROM trabajador WHERE ";

if($_POST['cumple'] != "0" ){
    $sql .= " cumple = '".$_POST['cumple']."'   ";

    if($_POST['lugar'] != "0"){
        $sql .= " AND lugar = ".$_POST['lugar']." ";
    }

    if($_POST['sector'] != "0"){
        $sql .= " AND sector = ".$_POST['sector']." ";
    }


}elseif($_POST['lugar'] != "0"){
    $sql .= " lugar = ".$_POST['lugar']." ";

    if($_POST['sector'] != "0"){
        $sql .= " AND sector = ".$_POST['sector']." ";
    }

    
}elseif($_POST['sector'] != "0"){
    $sql .= " sector = ".$_POST['sector']." ";


}



//EJECUTAR LA QUERY



// y armar php
// echo "<tr>
// <td>$res['lugar']</td>
// </tr>"

?>

