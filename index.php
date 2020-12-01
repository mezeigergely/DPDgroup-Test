<?php

// implement php file
require_once("functions.php");


// validation
if (isset($_GET['submit'])) {
    $a1 = $_GET["point-A-latitude"];
    $a2 = $_GET["point-A-longitude"];
    $b1 = $_GET["point-B-latitude"];
    $b2 = $_GET["point-B-longitude"];

    if ($a1 == "" || $a2 == "" || $b1 == "" || $b2 == "") {
        echo "empty value(s)";
    } else {
        if ((($a1 > -90 && $a1 < 90) && ($b1 > -90 && $b1 < 90)) && (($a2 > -180 && $a2 < 180) && ($b2 > -180 && $b2 < 180))) {
            $c1 = $b1;
            $c2 = $a2;
            $d1 = $a1;
            $d2 = $b2;
        } else {
            echo "wrong input(s)";
        }
    }
    // constants
    $door_size = 0;
    $corner_element_size = 0;
    $pillar_size = 0;
    $wire_size = 0;

    $door_price = 0;
    $corner_element_price = 0;
    $pillar_price = 0;
    $wire_price = 0;

    // file handling
    $file_handle = fopen("consts.txt", "rb");

    while (!feof($file_handle)) {

        $line_of_text = fgets($file_handle);
        $parts = explode('=', $line_of_text);

        switch ($parts[0]) {
            case "door":
                $door_size = (int)$parts[1];
                $door_price = (int)$parts[2];
                break;
            case "corner_element":
                $corner_element_size = (int)$parts[1];
                $corner_element_price = (int)$parts[2];
                break;
            case "pillar":
                $pillar_size = (int)$parts[1];
                $pillar_price = (int)$parts[2];
                break;
            case "wire":
                $wire_size = (int)$parts[1];
                $wire_price = (int)$parts[2];
                break;
        }
    }
    fclose($file_handle);


    // calculating
    $perimeter = perimeter($a1, $a2, $d1, $d2, $c1, $c2);
    $remainder = $perimeter - (($door_size * 4) + ($corner_element_size * 4) + ($pillar_size * 8));
    $wire_pillar = $remainder / 2.2;
    $ceil_wire_pillar = ceil($wire_pillar);
    $eur = (4 * $door_price) + (4 * $corner_element_price) + ((8 + $ceil_wire_pillar) * $pillar_price) + ($ceil_wire_pillar * $wire_price);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DPDgroup Test by Gergely Mezei</title>
</head>

<body>
    <div>
        <form method="GET">
            <div id="point-A">
                <p><strong>Point A:</strong></p>
                <label for="point-A">Latitude: </label>
                <input type="text" id="point-A-latitude" name="point-A-latitude">
                <label for="point-A">Longitude: </label>
                <input type="text" id="point-A-longitude" name="point-A-longitude">
            </div>
            <br>
            <div id="point-B">
                <p><strong>Point B:</strong></p>
                <label for="point-B">Latitude: </label>
                <input type="text" id="point-B-latitude" name="point-B-latitude">
                <label for="point-B">Longitude: </label>
                <input type="text" id="point-B-longitude" name="point-B-longitude">
            </div>
            <br>
            <br>
            <div>
                <input type="submit" name="submit" value="Calculate">
            </div>
        </form>

    </div>
    <br>
    <br>
    <div id="results">
        <div>
            2.
            <br>
            Point A: <?php emptyOrNot($a1, $a2) ?>
            <br>
            Point B: <?php emptyOrNot($b1, $b2) ?>
            <br>
            Point C: <?php emptyOrNot($c1, $c2) ?>
            <br>
            Point D: <?php emptyOrNot($d1, $d2) ?>
        </div>
        <br>
        <div>
            3. Perimeter: <?php echo perimeter($a1, $a2, $d1, $d2, $c1, $c2) . " meter" ?>
            <br>
        </div>
        <br>
        <div>
            4. Area: <?php echo area($a1, $a2, $d1, $d2, $c1, $c2) . " squaremeter" ?>
            <br>
        </div>
        <br>
        <div>
            5. Total cost: <?php if ($eur == "") {
                                echo "empty value";
                            } else {
                                echo $eur . " EUR<br>"; //. 4 * $door_price . " door price<br>" . 4 * $corner_element_price . " corner element price<br>" . (8 + $ceil_wire_pillar) * $pillar_price . " pillar price<br>" . $ceil_wire_pillar * $wire_price . " wire price";
                            } ?>
            <br>
        </div>
    </div>
</body>

</html>