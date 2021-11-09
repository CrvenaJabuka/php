<?php
require("includes/common.inc.php");

// Schritt 1: Pfadinformationen bereitstellen, Bildinformationen einholen
$pfad = "./images/slide0.jpg";
$bildinfos = getimagesize($pfad); //liefert ein Array an Informationen zu diesem Bild
ta($bildinfos);
$breite_orig = $bildinfos[0];
$hoehe_orig = $bildinfos[1];
$seitenverhaeltnis_orig = $breite_orig/$hoehe_orig;
$typ_orig = $bildinfos["mime"];

// Schritt 2: das Bild in den Hauptspeicher des Servers laden --> Erzeugen einer sog. "Resource"
$resource_orig = imagecreatefromjpeg($pfad); //imagecreatefromgif, imagecreatefrompng

// Schritt 3: das Verkleinern des (eingelesenen) Bildes
$breite_neu = 800;
//$hoehe_neu = $breite_neu/$seitenverhaeltnis_orig; //Höhe wird auf Basis des bestehenden Seitenverhältnisses berechnet
$resource_neu = imagescale($resource_orig,$breite_neu);

// Schritt 4: neues Bild speichern
imagejpeg($resource_neu,"./images/800/slide0.jpg",80); //imagegif, imagepng
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