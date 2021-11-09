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

$breite_neu = 600;

$dateiinfos = pathinfo($pfad); //liefert ein Array an Informationen zu dieser Datei
ta($dateiinfos);
$dateiname_orig = $dateiinfos["basename"];
$thumbnaildir = $breite_neu . "/";
$zielverzeichnispfad = $dateiinfos["dirname"] . "/" . $thumbnaildir;
echo($zielverzeichnispfad);

if(!file_exists($zielverzeichnispfad)) {
    mkdir($zielverzeichnispfad,0755,true);
}

// Schritte 2-4:
switch($typ_orig) {
    case "image/jpeg":
        $resource_orig = imagecreatefromjpeg($pfad); //imagecreatefromgif, imagecreatefrompng
        $resource_neu = imagescale($resource_orig,$breite_neu);
        imagejpeg($resource_neu,$zielverzeichnispfad . $dateiname_orig,80); //imagegif, imagepng
        break;
        
    case "image/gif":
        $resource_orig = imagecreatefromgif($pfad);
        $resource_neu = imagescale($resource_orig,$breite_neu);
        imagegif($resource_neu,$zielverzeichnispfad . $dateiname_orig);
      break;
        
    case "image/png":
        $resource_orig = imagecreatefrompng($pfad);
        $resource_neu = imagescale($resource_orig,$breite_neu);
        imagepng($resource_neu,$zielverzeichnispfad . $dateiname_orig);
       break;
}
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