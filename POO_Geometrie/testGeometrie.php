<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test géométie</title>
</head>
<body>
<?php
include_once "Polygone.php";
use \Geometrie\{Point, Polygone};

$p1=new Point(2, 5);
$p2=new Point(4, 3);
$p3=new Point(6, 1);

$poly=new Polygone($p1,$p2,$p3); //avec le ... je peux en passer autant que je veux

echo $poly;

?>
</body>
</html>