<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test géométrie</title>
</head>
<body>
<?php
//au lieu de faire plein d'include_once, je fais un autoloader qui va aller chercher les classes tout seul
//en fonction de celle qu'on appelle et de la correspondance dossier/fichier namespace/class
spl_autoload_register(function ($class_name) {
    include_once $class_name . '.php';
});

use \Geometrie\{Point, Quadrilatere, Triangle, GenerateurCanvas, Cercle};

$q=new Quadrilatere(new Point(10,10), new Point(10,100), new Point(100,100), new Point(100,10));
$t=new Triangle(new Point(200,100), new Point(200,200), new Point(300,300));
$c=new Cercle(new Point(400,400), 50);

$liste=new GenerateurCanvas(500, 500);
$liste->AjouterFigure($q);
$liste->AjouterFigure($t);
$liste->AjouterFigure($c);

$liste->GenererHTMLEtJS();
$liste->GenererTableauAireEtPerimetre();

?>
</body>
</html>
