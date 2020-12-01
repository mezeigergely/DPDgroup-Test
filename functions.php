<?php

$a1 = 0;
$a2 = 0;
$b1 = 0;
$b2 = 0;
$c1 = 0;
$c2 = 0;
$d1 = 0;
$d2 = 0;
$eur = 0;


function emptyOrNot($n1, $n2)
{
    if ($n1 == "" || $n2 == "") {
        echo "empty values";
    } else {
        echo $n1 . ", " . $n2;
    }
}


function degreesToRadians($degree)
{
    return $degree * 3.14 / 180;
}

function distBetweenTwoPoints($n1, $n2, $p1, $p2)
{
    $earthRadiusKm = 6371;
    $vari1 = $p1 - $n1;
    $vari2 = $p2 - $n2;
    $dLat = degreesToRadians($vari1);
    $dLon = degreesToRadians($vari2);

    $n1 = degreesToRadians($n1);
    $p1 = degreesToRadians($p1);

    $a = sin($dLat / 2) * sin($dLat / 2) +
        sin($dLon / 2) * sin($dLon / 2) * cos($n1) * cos($p1);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    return $earthRadiusKm * $c * 1000;
}

function perimeter($f1_1, $f1_2, $f2_1, $f2_2, $a1_1, $a1_2)
{
    $firtsSide = distBetweenTwoPoints($f1_1, $f1_2, $f2_1, $f2_2,);
    $secSide = distBetweenTwoPoints($f1_1, $f1_2, $a1_1, $a1_2);

    $total = 2 * ($firtsSide + $secSide);

    return number_format($total, 2, '.', '');
}

function area($f1_1, $f1_2, $f2_1, $f2_2, $a1_1, $a1_2)
{
    $firtsSide = distBetweenTwoPoints($f1_1, $f1_2, $f2_1, $f2_2,);
    $secSide = distBetweenTwoPoints($f1_1, $f1_2, $a1_1, $a1_2);

    $total = $firtsSide * $secSide;

    return number_format($total, 2, '.', '');
}
