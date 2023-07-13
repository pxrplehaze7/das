<?php

//CANTIDAD DE LOS QUE CUMPLEN
$cumplenh = "SELECT COUNT(*) FROM `honorario` WHERE Cumple = 1;";
$sqlCumplenh = mysqli_query($conn, $cumplenh);
$rowch = mysqli_fetch_row($sqlCumplenh);
$total_ch = $rowch[0];




//CANTIDAD DE LOS QUE NO CUMPLEN
$NOcumplenh = "SELECT COUNT(*) FROM `honorario` WHERE Cumple = 0;";
$sqlNOCumplenh = mysqli_query($conn, $NOcumplenh);
$rownch = mysqli_fetch_row($sqlNOCumplenh);
$total_nch = $rownch[0];


//CANTIDAD TOTAL
$totalH = "SELECT COUNT(*) FROM `honorario`;";
$sqlH = mysqli_query($conn, $totalH);
$row2 = mysqli_fetch_row($sqlH);
$total_h = $row2[0];






//trabajadores que cumplen con documentacion y tiene un decreto vigente en la das
$dasC = "SELECT COUNT(*) AS cantidad_trabajadores
FROM honorario h
INNER JOIN decretosh dh ON h.IDTraH = dh.IDTraH
WHERE h.Cumple = 1
AND dh.IDLugar = 1
AND dh.Estado IN (1, 2)";
$sqldas = mysqli_query($conn, $dasC);
$row1 = mysqli_fetch_row($sqldas);
$das_c = $row1[0];


//total de trabajadores de la das
$dasT = "SELECT COUNT(*) AS cantidad_trabajadores 
FROM honorario h
INNER JOIN decretosh dh ON h.IDTraH = dh.IDTraH
WHERE dh.IDLugar = 1
AND dh.Estado IN (1, 2)";
$sqldast = mysqli_query($conn, $dasT);
$row2 = mysqli_fetch_row($sqldast);
$das_t = $row2[0];


if ($das_t != 0) {
    $porcentajedash = ($das_c / $das_t) * 100;
    $redondeadodash = number_format($porcentajedash, 0);
} else {
    $porcentajedash = 0;
    $redondeadodash = 0;
}

// //trabajadores que cumplen con documentacion y son de cesfam pinares
$pinaresC = "SELECT COUNT(*) AS cantidad_trabajadores
FROM honorario h
INNER JOIN decretosh dh ON h.IDTraH = dh.IDTraH
WHERE h.Cumple = 1
AND dh.IDLugar = 2
AND dh.Estado IN (1, 2)";
$sqlpin = mysqli_query($conn, $pinaresC);
$row3 = mysqli_fetch_row($sqlpin);
$pin_c = $row3[0];

//total de trabajadores de cesfam pinares
$pinaresT = "SELECT COUNT(*) AS cantidad_trabajadores 
FROM honorario h
INNER JOIN decretosh dh ON h.IDTraH = dh.IDTraH
WHERE dh.IDLugar = 2
AND dh.Estado IN (1, 2)";
$sqlpinT = mysqli_query($conn, $pinaresT);
$row4 = mysqli_fetch_row($sqlpinT);
$pin_t = $row4[0];

if ($pin_t != 0) {
    $porcentajepinh = ($pin_c / $pin_t) * 100;
    $redondeadopinh = number_format($porcentajepinh, 0);
} else {
    $porcentajepinh = 0;
    $redondeadopinh = 0;
}

//trabajadores que cumplen con documentacion y son de cesfam la leonera
$leoC = "SELECT COUNT(*) AS cantidad_trabajadores
FROM honorario h
INNER JOIN decretosh dh ON h.IDTraH = dh.IDTraH
WHERE h.Cumple = 1
AND dh.IDLugar = 3
AND dh.Estado IN (1, 2)";
$sqlleoC = mysqli_query($conn, $leoC);
$row5 = mysqli_fetch_row($sqlleoC);
$leo_c = $row5[0];

//total de trabajadores de cesfam/sapu la leonera
$leoT = "SELECT COUNT(*) AS cantidad_trabajadores 
FROM honorario h
INNER JOIN decretosh dh ON h.IDTraH = dh.IDTraH
WHERE dh.IDLugar = 3
AND dh.Estado IN (1, 2)";
$sqlleoT = mysqli_query($conn, $leoT);
$row6 = mysqli_fetch_row($sqlleoT);
$leo_t = $row6[0];

if ($leo_t != 0) {
    $porcentajeleoh = ($leo_c / $leo_t) * 100;
    $redondeadoleoh = number_format($porcentajeleoh, 0);
} else {
    $porcentajeleoh = 0;
    $redondeadoleoh = 0;
}









//trabajadores que cumplen con documentacion y son de valle la piedra
$valleC = "SELECT COUNT(*) AS cantidad_trabajadores
FROM honorario h
INNER JOIN decretosh dh ON h.IDTraH = dh.IDTraH
WHERE h.Cumple = 1
AND dh.IDLugar = 4
AND dh.Estado IN (1, 2)";
$sqlvalleC = mysqli_query($conn, $valleC);
$row7 = mysqli_fetch_row($sqlvalleC);
$valle_c = $row7[0];

//total de trabajadores de valle la piedra
$valleT = "SELECT COUNT(*) AS cantidad_trabajadores 
FROM honorario h
INNER JOIN decretosh dh ON h.IDTraH = dh.IDTraH
WHERE dh.IDLugar = 4
AND dh.Estado IN (1, 2)";
$sqlvalleT = mysqli_query($conn, $valleT);
$row8 = mysqli_fetch_row($sqlvalleT);
$valle_t = $row8[0];

if ($valle_t != 0) {
    $porcentajevalleh = ($valle_c / $valle_t) * 100;
    $redondeadovalleh = number_format($porcentajevalleh, 0);
} else {
    $porcentajevalleh = 0;
    $redondeadovalleh = 0;
}










// //trabajadores que cumplen con documentacion y son de cesfam chiguayante
$chiguaC = "SELECT COUNT(*) AS cantidad_trabajadores
FROM honorario h
INNER JOIN decretosh dh ON h.IDTraH = dh.IDTraH
WHERE h.Cumple = 1
AND dh.IDLugar = 5
AND dh.Estado IN (1, 2)";
$sqllchiguaC = mysqli_query($conn, $chiguaC);
$row9 = mysqli_fetch_row($sqllchiguaC);
$chigua_c = $row9[0];

//total de trabajadores de cesfam chiguayante
$chiguaT = "SELECT COUNT(*) AS cantidad_trabajadores 
FROM honorario h
INNER JOIN decretosh dh ON h.IDTraH = dh.IDTraH
WHERE dh.IDLugar = 5
AND dh.Estado IN (1, 2)";
$sqllchiguaT = mysqli_query($conn, $chiguaT);
$row10 = mysqli_fetch_row($sqllchiguaT);
$chigua_t = $row10[0];

if ($chigua_t != 0) {
    $porcentajechih = ($chigua_c / $chigua_t) * 100;
    $redondeadochih = number_format($porcentajechih, 0);
} else {
    $porcentajechih = 0;
    $redondeadochih = 0;
}


