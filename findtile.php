<?php

define("EPS", 0.0818191908426);
define("Z", 19);

$lat = ($_POST['latitude']);
$long = ($_POST['longitude']);

if (!is_numeric($lat) || !is_numeric($long)) {
    die("Given coords ar not numbers");
}

$pixelCoords = fromGeoToPixels($lat, $long, EPS, Z);
$tileCoords = fromPixelsToTileNumber($pixelCoords[0], $pixelCoords[1]);

echo 'Tile x: ' . $tileCoords[0] . ', y: ' . $tileCoords[1];

function fromGeoToPixels($lat, $long, $eccentricity, $z) {
    $rho = pow(2, $z + 8) / 2;
    $beta = $lat * pi() / 180;
    $s1 = 1 - $eccentricity * sin($beta);
    $s2 = 1 + $eccentricity * sin($beta);
    $phi = $s1 / $s2;
    $theta = tan(pi() / 4 + $beta / 2) * pow($phi, $eccentricity / 2);

    $x_p = $rho * (1 + $long / 180);
    $y_p = $rho * (1 - log($theta) / pi());

    return [$x_p, $y_p];
}

function fromPixelsToTileNumber($x, $y) {
    return [floor($x / 256), floor($y / 256)];
}
