
<?php
// ARCHIVO DE EJECUCION AUTOMATICA DIARIA

$conn = mysqli_connect('localhost', 'root', '', 'das');

// SE VERIFICAN LOS DATOS DE CONEXION
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}



//DECRETOS VIGENTES QUE PASAN A POR FINALIZAR
$sql = "SELECT IDdecreto FROM decretos WHERE Estado=1 AND NOW()>=FechaAlerta AND NOW()<=FechaTermino";
$resultados = mysqli_query($conn, $sql);
while ($res = mysqli_fetch_array($resultados)) {

    $update = "UPDATE decretos SET Estado=2, Confirmacion=0 WHERE IDdecreto = " . $res['IDdecreto'];
    $act = mysqli_query($conn, $update);
    if ($act) {
        echo "Estado cambiado a por vencer" . $res['IDdecreto'];
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    echo "<br>";
}

//DECRETOS POR FINALIZAR QUE PASAN A VENCIDOS

$sqlv = "SELECT IDdecreto FROM decretos WHERE Estado=2 AND NOW()>FechaTermino";
$resultados = mysqli_query($conn, $sqlv);
while ($res2 = mysqli_fetch_array($resultados)) {

    $update = "UPDATE decretos SET Estado=0, Confirmacion=1 WHERE IDdecreto = " . $res2['IDdecreto'];
    $act = mysqli_query($conn, $update);
    if ($act) {
        echo "Estado cambiado a finalizado" . $res2['IDdecreto'];
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    echo "<br>";
}




//DECRETOS VIGENTES HONORARIOS QUE PASAN A POR FINALIZAR
$sql = "SELECT IDdecretoH FROM decretosh WHERE Estado=1 AND NOW()>=FechaAlerta AND NOW()<=FechaTermino";
$resultados = mysqli_query($conn, $sql);
while ($res = mysqli_fetch_array($resultados)) {

    $update = "UPDATE decretosh SET Estado=2, Confirmacion=0 WHERE IDdecretoH = " . $res['IDdecretoH'];
    $act = mysqli_query($conn, $update);
    if ($act) {
        echo "Estado cambiado a por vencer" . $res['IDdecretoH'];
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    echo "<br>";
}

//DECRETOS POR FINALIZAR HONORARIOS QUE PASAN A VENCIDOS

$sqlv = "SELECT IDdecretoH FROM decretosh WHERE Estado=2 AND NOW()>FechaTermino";
$resultados = mysqli_query($conn, $sqlv);
while ($res2 = mysqli_fetch_array($resultados)) {

    $update = "UPDATE decretosh SET Estado=0, Confirmacion=1 WHERE IDdecretoH = " . $res2['IDdecretoH'];
    $act = mysqli_query($conn, $update);
    if ($act) {
        echo "Estado cambiado a finalizado" . $res2['IDdecretoH'];
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    echo "<br>";
}




mysqli_close($conn);
?>