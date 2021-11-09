<?php
require("includes/common.inc.php");

$breite_neu = 800;
$pfad = "./images/slide2.jpg";

// Schritt 1: Bild- und Dateiinformationen einholen, ggf. Zielverzeichnis anlegen, etc.
$bildinfos = getimagesize($pfad); //liefert ein Array an Informationen zu diesem Bild
$breite_orig = $bildinfos[0];
$hoehe_orig = $bildinfos[1];
$seitenverhaeltnis_orig = $breite_orig/$hoehe_orig;
$typ_orig = $bildinfos["mime"];
ta($bildinfos);

$hoehe_neu = $breite_neu/$seitenverhaeltnis_orig; //Höhe wird auf Basis des bestehenden Seitenverhältnisses berechnet

$dateiinfos = pathinfo($pfad); //liefert ein Array an Informationen zu dieser Datei
$dateiname_orig = $dateiinfos["basename"];
$thumbnaildir = $breite_neu . "x" . $breite_neu . "/";
$zielverzeichnispfad = $dateiinfos["dirname"] . "/" . $thumbnaildir;
ta($dateiinfos);

if(!file_exists($zielverzeichnispfad)) {
    mkdir($zielverzeichnispfad,0755,true);
}

// Schritt 2: das Bild in den Hauptspeicher des Servers laden --> Erzeugen einer sog. "Resource"
switch($typ_orig) {
    case "image/jpeg":
        $resource_orig = imagecreatefromjpeg($pfad); //imagecreatefromgif, imagecreatefrompng
        break;
        
    case "image/gif":
         $resource_orig = imagecreatefromgif($pfad);
       break;
        
    case "image/png":
         $resource_orig = imagecreatefrompng($pfad);
        break;
}

// Schritt 3: neues, leeres Bild anlegen
$resource_neu = imagecreatetruecolor($breite_neu,$breite_neu); //hier: 800x800 Pixel, also quadratisch; imagecreate: 8Bit Farbtiefe, imagecreatetruecolor: 24Bit Farbtiefe

// Schritt 4: Ausschnitt des bestehenden Bildes in das neue, noch leere Bild kopieren
if($seitenverhaeltnis_orig>1) {
    //Querformatbild
    $x_orig = ($breite_orig-$hoehe_orig)/2;
    $y_orig = 0;
    $ausschnitt_x = $hoehe_orig;
    $ausschnitt_y = $hoehe_orig;
}
else {
    //Hochformatbild
    $x_orig = 0;
    $y_orig = ($hoehe_orig-$breite_orig)/2;
    $ausschnitt_x = $breite_orig;
    $ausschnitt_y = $breite_orig;
}

imagecopyresampled($resource_neu,$resource_orig,0,0,$x_orig,$y_orig,$breite_neu,$breite_neu,$ausschnitt_x,$ausschnitt_y);

// Schritt 5: neues Bild speichern
imagejpeg($resource_neu,$zielverzeichnispfad . $dateiname_orig,80); //imagegif, imagepng
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Bildgenerierung</title>
    <link rel="stylesheet" href="css/common.css">
</head>

<body>
</body>
</html>