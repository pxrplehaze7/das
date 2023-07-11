<?php

//CANTIDAD DE LOS QUE CUMPLEN
$cumplent = "SELECT COUNT(*) FROM `trabajador` WHERE Cumple = 1;";
$sqlCumplent = mysqli_query($conn, $cumplent);
$rowct = mysqli_fetch_row($sqlCumplent);
$total_ct = $rowct[0];

$cumplenh = "SELECT COUNT(*) FROM `honorario` WHERE Cumple = 1;";
$sqlCumplenh = mysqli_query($conn, $cumplenh);
$rowch = mysqli_fetch_row($sqlCumplenh);
$total_ch = $rowch[0];




//CANTIDAD DE LOS QUE NO CUMPLEN

$NOcumplent = "SELECT COUNT(*) FROM `trabajador` WHERE Cumple = 0;";
$sqlNOCumplent = mysqli_query($conn, $NOcumplent);
$rownct = mysqli_fetch_row($sqlNOCumplent);
$total_nct = $rownct[0];

$NOcumplenh = "SELECT COUNT(*) FROM `honorario` WHERE Cumple = 0;";
$sqlNOCumplenh = mysqli_query($conn, $NOcumplenh);
$rownch = mysqli_fetch_row($sqlNOCumplenh);
$total_nch = $rownch[0];


//CANTIDAD TOTAL
$totalTRA = "SELECT COUNT(*) FROM `trabajador`;";
$sqlT = mysqli_query($conn, $totalTRA);
$row = mysqli_fetch_row($sqlT);
$total_t = $row[0];

$totalH = "SELECT COUNT(*) FROM `honorario`;";
$sqlH = mysqli_query($conn, $totalH);
$row2 = mysqli_fetch_row($sqlH);
$total_h = $row2[0];

// //trabajadores que cumplen con documentacion y son de la das
// $dasC = "SELECT COUNT(*) FROM `trabajador` WHERE `IDLugar` = 1 AND `Cumple` = 1";
// $sqldas = mysqli_query($conn, $dasC);
// $row1 = mysqli_fetch_row($sqldas);
// $das_c = $row1[0];

// //total de trabajadores de la das
// $dasT = "SELECT COUNT(*)FROM `trabajador` WHERE `IDLugar`=1";
// $sqldast = mysqli_query($conn, $dasT);
// $row2 = mysqli_fetch_row($sqldast);
// $das_t = $row2[0];

// if ($das_t != 0) {
//     $porcentajedas = ($das_c / $das_t) * 100;
//     $redondeadodas = number_format($porcentajedas, 0);
// } else {
//     $porcentajedas = 0;
//     $redondeadodas = 0;
// }

// //trabajadores que cumplen con documentacion y son de cesfam pinares
// $pinaresC = "SELECT COUNT(*) FROM `trabajador` WHERE `IDLugar` = 2 AND `Cumple` = 1";
// $sqlpin = mysqli_query($conn, $pinaresC);
// $row3 = mysqli_fetch_row($sqlpin);
// $pin_c = $row3[0];

// //total de trabajadores de cesfam pinares
// $pinaresT = "SELECT COUNT(*)FROM `trabajador` WHERE `IDLugar`=2";
// $sqlpinT = mysqli_query($conn, $pinaresT);
// $row4 = mysqli_fetch_row($sqlpinT);
// $pin_t = $row4[0];

// if ($pin_t != 0) {
//     $porcentajepin = ($pin_c / $pin_t) * 100;
//     $redondeadopin = number_format($porcentajepin, 0);
// } else {
//     $porcentajepin = 0;
//     $redondeadopin = 0;
// }

// //trabajadores que cumplen con documentacion y son de cesfam la leonera
// $leoC = "SELECT COUNT(*) FROM `trabajador` WHERE `IDLugar` = 3 AND `Cumple` = 1";
// $sqlleoC = mysqli_query($conn, $leoC);
// $row5 = mysqli_fetch_row($sqlleoC);
// $leo_c = $row5[0];

// //total de trabajadores de cesfam/sapu la leonera
// $leoT = "SELECT COUNT(*)FROM `trabajador` WHERE `IDLugar`=3";
// $sqlleoT = mysqli_query($conn, $leoT);
// $row6 = mysqli_fetch_row($sqlleoT);
// $leo_t = $row6[0];

// if ($leo_t != 0) {
//     $porcentajeleo = ($leo_c / $leo_t) * 100;
//     $redondeadoleo = number_format($porcentajeleo, 0);
// } else {
//     $porcentajeleo = 0;
//     $redondeadoleo = 0;
// }

// //trabajadores que cumplen con documentacion y son de valle la piedra
// $valleC = "SELECT COUNT(*) FROM `trabajador` WHERE `IDLugar` = 4 AND `Cumple` = 1";
// $sqlvalleC = mysqli_query($conn, $valleC);
// $row7 = mysqli_fetch_row($sqlvalleC);
// $valle_c = $row7[0];

// //total de trabajadores de valle la piedra
// $valleT = "SELECT COUNT(*)FROM `trabajador` WHERE `IDLugar`=4";
// $sqlvalleT = mysqli_query($conn, $valleT);
// $row8 = mysqli_fetch_row($sqlvalleT);
// $valle_t = $row8[0];

// if ($valle_t != 0) {
//     $porcentajevalle = ($valle_c / $valle_t) * 100;
//     $redondeadovalle = number_format($porcentajevalle, 0);
// } else {
//     $porcentajevalle = 0;
//     $redondeadovalle = 0;
// }

// //trabajadores que cumplen con documentacion y son de cesfam chiguayante
// $chiguaC = "SELECT COUNT(*) FROM `trabajador` WHERE `IDLugar` = 5 AND `Cumple` = 1";
// $sqllchiguaC = mysqli_query($conn, $chiguaC);
// $row9 = mysqli_fetch_row($sqllchiguaC);
// $chigua_c = $row9[0];

// //total de trabajadores de cesfam chiguayante
// $chiguaT = "SELECT COUNT(*)FROM `trabajador` WHERE `IDLugar`=5";
// $sqllchiguaT = mysqli_query($conn, $chiguaT);
// $row10 = mysqli_fetch_row($sqllchiguaT);
// $chigua_t = $row10[0];

// if ($chigua_t != 0) {
//     $porcentajechi = ($chigua_c / $chigua_t) * 100;
//     $redondeadochi = number_format($porcentajechi, 0);
// } else {
//     $porcentajechi = 0;
//     $redondeadochi = 0;
// }


// $pinaresC="SELECT COUNT(*) AS cantidad_trabajadores
// FROM trabajador t
// JOIN decretos d ON t.IDTra = d.IDTra
// WHERE d.IDLugar = 'IDLugar'
//   AND d.Estado = 0";
//   $sqlPINC=mysqli_query($conn, $pinaresC);
// $cantidad = mysqli_fetch_row($sqlPINC);
// $pinaresC = $cantidad[0];